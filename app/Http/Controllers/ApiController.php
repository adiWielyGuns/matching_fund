<?php

namespace App\Http\Controllers;

use App\Events\OrderEvent;
use App\Interfaces\OrderRepositoryInterface;
use App\Interfaces\ReservationRepositoryInterface;
use App\Models\MasterMenu;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Reservation;
use App\Models\User;
use App\Notifications\OrderNotification;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;

class ApiController extends Controller
{
    private ReservationRepositoryInterface $reservationRepository;
    private OrderRepositoryInterface $orderRepository;

    public function __construct(ReservationRepositoryInterface $reservationRepository, OrderRepositoryInterface $orderRepository)
    {
        $this->reservationRepository = $reservationRepository;
        $this->orderRepository = $orderRepository;
    }

    public function checkIfCodeExist(Request $req)
    {
        $check = Reservation::where('kode', $req->kode)
            ->where('status', 'Paid')
            ->first();
        if ($check) {
            return Response()->json(['status' => 1, 'message' => 'Reservasi tersedia', 'data' => $check]);
        } else {
            return Response()->json(['status' => 0, 'message' => 'Kode reservasi tidak tersedia']);
        }
    }

    public function submitReservasi(Request $req)
    {
        return DB::transaction(function () use ($req) {
            $data = [
                'id' => $this->reservationRepository->getIdReservation(),
                'kode' => $this->reservationRepository->getKodeReservation(),
                'tanggal' => Carbon::parse($req->tanggal)->format('Y-m-d'),
                'jam' => Carbon::parse($req->tanggal)->format('H:i'),
                'pax' => $req->pax,
                'nama' => $req->nama,
                'telpon' => $req->telpon,
                'status' => 'Waiting For Payment',
                'created_by' => $req->nama,
                'updated_by' => $req->nama,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            return Response()->json([
                'status' => 1,
                'message' => 'Berhasil melakukan reservasi',
                'data' => $this->reservationRepository->createReservation($data),
            ]);
        });
    }

    public function processOrder(Request $req)
    {
        return DB::transaction(function () use ($req) {
            $check = $this->orderRepository->getOrderById($req->order_id);
            if (!$check) {
                $id = $this->orderRepository->getIdOrder();
                $data = [
                    'id' => $id,
                    'kode' => $this->orderRepository->getKodeOrder(),
                    'name' => $req->name,
                    'telpon' => $req->telpon,
                    'pax' => $req->pax,
                    'table_id' => $req->table_id,
                    'jenis' => 'langsung',
                    'created_by' => $req->name,
                    'updated_by' => $req->name,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                $this->orderRepository->createOrder($data);

                foreach ($req->item as $key => $value) {
                    OrderDetail::create([
                        'order_id' => $id,
                        'id' => $key + 1,
                        'price' => $value['price'],
                        'qty' => $value['jumlah'],
                        'sub_total' => $value['price'] * $value['jumlah'],
                        'master_menu_id' => $value['id'],
                        'status' => 'Menunggu Pembayaran',
                        'created_by' => $req->name,
                        'updated_by' => $req->name,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                $total = OrderDetail::where('order_id', $id)->sum('sub_total');

                $this->orderRepository->updateOrder($id, ['total_price' => $total]);
            } else {
                $id = $req->order_id;

                $data = [
                    'name' => $req->name,
                    'telpon' => $req->telpon,
                    'pax' => $req->pax,
                    'table_id' => $req->table_id,
                    'jenis' => 'langsung',
                    'updated_by' => $req->name,
                    'updated_at' => now(),
                ];

                $this->orderRepository->updateOrder($id, $data);

                foreach ($req->item as $key => $value) {
                    OrderDetail::create([
                        'order_id' => $id,
                        'id' => OrderDetail::where('order_id', $id)->max('id') + 1,
                        'price' => $value['price'],
                        'qty' => $value['jumlah'],
                        'sub_total' => $value['price'] * $value['jumlah'],
                        'master_menu_id' => $value['id'],
                        'status' => 'Menunggu Pembayaran',
                        'created_by' => $req->name,
                        'updated_by' => $req->name,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                $total = OrderDetail::where('order_id', $id)->sum('sub_total');

                $this->orderRepository->updateOrder($id, ['total_price' => $total]);
            }


            return Response()->json([
                'status' => 1,
                'message' => 'Berhasil melakukan pesanan',
                'order_id' => $id,
            ]);
        });
    }

    public function orderNotifier(Request $req)
    {

        $pesanan['progress'] = MasterMenu::take(3)->get();
        $order = OrderDetail::where('order_id', $req->order_id)
            ->with(['master_menu'])
            ->get()->toArray();
        
        event(new OrderEvent($req->order_id));

        return 'success';
    }

    public function checkTransaction(Request $req)
    {
        $check = Order::find($req->order_id);
        if ($check) {
            $check = OrderDetail::where('order_id', $req->order_id)
                ->whereIn('status', ['Menunggu Pembayaran', 'Sedang Disiapkan'])
                ->get();
            if (count($check) == 0) {
                return Response()->json(['status' => 1, 'message' => 'Reset Cookies']);
            }
        }
        return Response()->json(['status' => 0, 'message' => 'Not Ordering']);
    }

    public function progressMenu(Request $req)
    {
        $check = OrderDetail::where('order_id', $req->order_id)->with(['master_menu'])->get();
        return Response()->json(['status' => 1, 'message' => 'Berhasil fetching data', 'data' => $check]);
    }
}
