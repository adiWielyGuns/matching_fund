<?php

namespace App\Interfaces;

interface ReservationRepositoryInterface
{
    public function getAllReservations();
    public function getIdReservation();
    public function getKodeReservation();
    public function getReservationById($titleMenuId);
    public function deleteReservation($titleMenuId);
    public function createReservation(array $titleMenuDetails);
    public function updateReservation($titleMenuId, array $newDetails);
    public function getReservationWithEloquent($relation);
}
