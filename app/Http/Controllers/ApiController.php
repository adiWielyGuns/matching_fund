<?php

namespace App\Http\Controllers;

use App\Events\OrderEvent;
use App\Interfaces\ReservationRepositoryInterface;
use App\Models\Reservation;
use App\Models\User;
use App\Notifications\OrderNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;

class ApiController extends Controller
{
    private ReservationRepositoryInterface $reservationRepository;

    public function __construct(ReservationRepositoryInterface $reservationRepository)
    {
        $this->reservationRepository = $reservationRepository;
    }


    public function authenticate(Request $req)
    {
        $pusher = new Pusher(
            '54492e6a46bf5094ea6e',
            'c876f62937490efa9375',
            '1494700'
        );

        return $pusher->socket_auth($req->channel_name, $req->socket_id);
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

    public function orderNotifier()
    {
        event(new OrderEvent('hello world'));

        return 'success';
    }
}
