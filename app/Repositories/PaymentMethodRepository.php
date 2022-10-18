<?php

namespace App\Repositories;

use App\Interfaces\PaymentMethodRepositoryInterface;
use App\Models\PaymentMethod;

class PaymentMethodRepository implements PaymentMethodRepositoryInterface
{
    public function getAllPaymentMethods()
    {
        return PaymentMethod::all();
    }

    public function getPaymentMethodById($orderId)
    {
        return PaymentMethod::findOrFail($orderId);
    }

    public function deletePaymentMethod($orderId)
    {
        PaymentMethod::destroy($orderId);
    }

    public function createPaymentMethod(array $orderDetails)
    {
        return PaymentMethod::create($orderDetails);
    }

    public function updatePaymentMethod($orderId, array $newDetails)
    {
        return PaymentMethod::whereId($orderId)->update($newDetails);
    }

    public function getIdPaymentMethod()
    {
        return PaymentMethod::max('id') + 1;
    }

    public function getPaymentMethodWithEloquent($relation)
    {
        return PaymentMethod::with($relation)->get();
    }
}
