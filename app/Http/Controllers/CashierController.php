<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\PaymentDetail;
use App\Models\PaymentMethod;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use DB;
class CashierController extends Controller
{

    public function index()
    {
        $paymentMethod = PaymentMethod::where('status',true)->get();
        $data = Order::with('table','order_detail')
                    ->wherehas('order_detail',function($q){
                        $q->where('status','Menunggu Pembayaran');
                        $q->orWhere('status','Sedang Disiapkan');
                    })
                    ->withCount(['order_detail as belumBayarTotal' => function ($query) {
                        $query->where('status','Menunggu Pembayaran');
                    }])
                    ->get();
        return view('transaction/cashier/cashier',compact('data','paymentMethod'));
    }
    public function loadData(Request $req)
    {
        $data = Order::with('table','order_detail')
                    ->wherehas('order_detail',function($q){
                        $q->where('status','Menunggu Pembayaran');
                        $q->orWhere('status','Sedang Disiapkan');
                    })
                    ->withCount(['order_detail as belumBayarTotal' => function ($query) {
                        $query->where('status','Menunggu Pembayaran');
                    }])->where('name','like','%'.$req->id.'%')->get();
        return view('transaction/cashier/load_cashier',compact('data'));
    }
    public function getDataDetail(Request $req)
    {
        // return $req->all();
        $data = Order::with('table','order_detail','order_detail.master_menu')->where('id',$req->id)->orderBy('created_at','DESC')->first();
        return response()->json(
                    [
                        'status' => 1,
                        'message' => 'Berhasil Mengambil data',
                        'data' => $data
                    ],
                    Response::HTTP_CREATED
                );
    }
    public function store(Request $req)
    {
        return DB::transaction(function () use ($req) {
            // return $req->all();

            if ($req->method_payment == 'Cash') {
                $methodPayment = 1;
                $totalPrice = $req->total_price_cash;
                $totalPayment = $req->total_payment_cash;
                $totalChange = $req->total_change_cash;
            }else{
                $methodPayment = $req->payment_method_id;
                $totalPrice = $req->total_price_transfer;
                $totalPayment = $req->total_payment_transfer;
                $totalChange = $req->total_change_transfer;
            }


            $id = Payment::max('id')+1;
            Payment::create([
                'id'=>$id,
                'orders_id'=>$req->id,
                'payment_method_id'=>$methodPayment,
                'total_price'=>str_replace(',', '', $totalPrice),
                'total_payment'=>str_replace(',', '', $totalPayment),
                'total_change'=>str_replace(',', '', $totalChange),
                'created_by' => me(),
                'updated_by' => me(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            for ($i=0; $i <count($req->product_id) ; $i++) { 
                $dt = PaymentDetail::max('id')+1;
                PaymentDetail::create([
                    'id'=>$dt,
                    'product_id'=>$req->product_id[$i],
                    'payment_id'=>$id,
                    'total_price'=>str_replace(',', '', $req->product_price[$i]),
                    'created_by' => me(),
                    'updated_by' => me(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                OrderDetail::where('order_id',$req->id)->where('status','Menunggu Pembayaran')->update(['status'=>'Sedang Disiapkan']);

            }
                
            return response()->json(
                    [
                        'status' => 1,
                        'message' => 'Berhasil merubah data',
                    ],
                );
        });
    }
}
