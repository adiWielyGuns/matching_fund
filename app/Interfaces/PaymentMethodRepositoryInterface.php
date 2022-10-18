<?php

namespace App\Interfaces;

interface PaymentMethodRepositoryInterface
{
    public function getAllPaymentMethods();
    public function getIdPaymentMethod();
    public function getPaymentMethodById($titleMenuId);
    public function deletePaymentMethod($titleMenuId);
    public function createPaymentMethod(array $titleMenuDetails);
    public function updatePaymentMethod($titleMenuId, array $newDetails);
    public function getPaymentMethodWithEloquent($relation);
}
