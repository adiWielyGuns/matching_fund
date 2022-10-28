<?php

namespace App\Http\Controllers;

use App\Events\CashierEvent;
use App\Events\OrderEvent;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\PaymentDetail;
use App\Models\PaymentMethod;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use DB;

class UpdateStatusController extends Controller
{
    public function index()
    {
        $paymentMethod = PaymentMethod::where('status', true)->get();
        // $data = Order::with('table','order_detail')
        //             ->wherehas('order_detail',function($q){
        //                 $q->where('status','Menunggu Pembayaran');
        //                 $q->orWhere('status','Sedang Disiapkan');
        //             })
        //             ->withCount(['order_detail as belumBayarTotal' => function ($query) {
        //                 $query->where('status','Menunggu Pembayaran');
        //             }])
        //             ->get();
        $data = OrderDetail::with('order', 'order.table', 'master_menu')
            ->where('status', 'Sedang Disiapkan')
            ->get();
        // return $data;
        return view('transaction/update_status_menu/updateStatusMenu', compact('data', 'paymentMethod'));
    }
    public function loadData(Request $req)
    {
        $data = OrderDetail::with('order', 'order.table', 'master_menu')
            ->wherehas('master_menu', function ($q) use ($req) {
                $q->where('name', 'like', '%' . $req->id . '%');
            })
            ->where('status', 'Sedang Disiapkan')
            ->get();
        return view('transaction/update_status_menu/updateStatusMenuLoadData', compact('data'));
    }
    public function getDataDetail(Request $req)
    {
        // return $req->all();
        $data = Order::with('table', 'order_detail', 'order_detail.master_menu')
            ->where('id', $req->id)
            ->orderBy('created_at', 'DESC')
            ->first();
        return response()->json(
            [
                'status' => 1,
                'message' => 'Berhasil Mengambil data',
                'data' => $data,
            ],
            Response::HTTP_CREATED,
        );
    }
    public function store(Request $req)
    {
        return DB::transaction(function () use ($req) {

            OrderDetail::where('id', $req->id)->where('order_id', $req->dt)
                ->update(['status' => 'Selesai']);

            event(new OrderEvent($req->dt));
            event(new CashierEvent());

            return response()->json([
                'status' => 1,
                'message' => 'Berhasil merubah data',
            ]);
        });
    }
}
