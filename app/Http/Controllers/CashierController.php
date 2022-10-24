<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CashierController extends Controller
{

    public function index()
    {

        $data = Order::with('table')->get();
        return view('transaction/cashier/cashier',compact('data'));
    }
    public function loadData(Request $req)
    {

        $data = Order::with('table')->get();
        return view('transaction/cashier/load_cashier',compact('data'));
    }
    public function getDataDetail(Request $req)
    {
        // return $req->all();
        $data = Order::with('table','order_detail','order_detail.master_menu')->first();
        return response()->json(
                    [
                        'status' => 1,
                        'message' => 'Berhasil Mengambil data',
                        'data' => $data
                    ],
                    Response::HTTP_CREATED
                );
    }
}
