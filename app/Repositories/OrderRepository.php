<?php

namespace App\Repositories;

use App\Interfaces\OrderRepositoryInterface;
use App\Models\Order;
use Carbon\Carbon;

class OrderRepository implements OrderRepositoryInterface
{
    public function getAllOrders()
    {
        return Order::all();
    }

    public function getOrderById($orderId)
    {
        return Order::findOrFail($orderId);
    }

    public function deleteOrder($orderId)
    {
        Order::destroy($orderId);
    }

    public function createOrder(array $orderDetails)
    {
        return Order::create($orderDetails);
    }

    public function updateOrder($orderId, array $newDetails)
    {
        return Order::whereId($orderId)->update($newDetails);
    }

    public function getIdOrder()
    {
        return Order::max('id') + 1;
    }

    public function getKodeOrder()
    {
        $tanggal = Carbon::now()->format('Ym');
        $kode =   $tanggal;
        $sub = strlen($kode) + 1;
        $index = Order::selectRaw('max(substring(kode,' . $sub . ')) as id')
            ->where('kode', 'like', $kode . '%')
            ->first();

        $collect = Order::selectRaw('substring(kode,' . $sub . ') as id')
            ->get();
        $count = (int)$index->id;
        $collect_id = [];
        for ($i = 0; $i < count($collect); $i++) {
            array_push($collect_id, (int)$collect[$i]->id);
        }

        $flag = 0;
        for ($i = 0; $i < $count; $i++) {
            if ($flag == 0) {
                if (!in_array($i + 1, $collect_id)) {
                    $index = $i + 1;
                    $flag = 1;
                }
            }
        }

        if ($flag == 0) {
            $index = (int)$index->id + 1;
        }


        $index = str_pad($index, 4, '0', STR_PAD_LEFT);

        return $kode = $kode . $index;
    }

    public function getOrderWithEloquent($relation)
    {
        return Order::with($relation)->get();
    }
}
