<?php

namespace App\Interfaces;

interface OrderRepositoryInterface
{
    public function getAllOrders();
    public function getIdOrder();
    public function getKodeOrder();
    public function getOrderById($titleMenuId);
    public function deleteOrder($titleMenuId);
    public function createOrder(array $titleMenuDetails);
    public function updateOrder($titleMenuId, array $newDetails);
    public function getOrderWithEloquent($relation);
}
