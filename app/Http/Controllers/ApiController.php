<?php

namespace App\Http\Controllers;

use App\Interfaces\ReservationRepositoryInterface;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    private ReservationRepositoryInterface $reservationRepository;

    public function __construct(ReservationRepositoryInterface $reservationRepository)
    {
        $this->reservationRepository = $reservationRepository;
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
            $id = '';
            dd(Carbon::parse($req->tanggal)->format('H:i'));
            Reservation::create([
                'id' => $this->reservationRepository->getIdReservation(),
                'kode' => $this->reservationRepository->getKodeReservation(),
                'tanggal' => Carbon::parse($req->tanggal)->format('Y-m-d'),
                'jam' => Carbon::parse($req->tanggal)->format('H:i'),
                'pax' => $req->pax,
                'nominal_transfer' => $id,
                'nama' => $id,
                'telpon' => $id,
                'bank' => $id,
                'no_rekening' => $id,
                'bukti_transfer' => $id,
                'order_id' => $id,
                'table_id' => $id,
                'status' => $id,
                'created_by' => $id,
                'updated_by' => $id,
                'created_at' => $id,
                'updated_at'
            ]);
        });
    }
}
