<?php

namespace App\Http\Controllers;

use App\Interfaces\TableRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    private TableRepositoryInterface $tableRepository;

    public function __construct(TableRepositoryInterface $tableRepository)
    {
        $this->tableRepository = $tableRepository;
    }

    public function index()
    {

        return Inertia::render('Welcome', [
            'now' => Carbon::now()->format('l, d-m-Y'),
            'table' => $this->tableRepository->getAllTablesActive('id, name as text'),
        ]);
    }

    public function order(Request $req)
    {
        return Inertia::render('Order', [
            'now' => Carbon::now()->format('l, d-m-Y'),
            'req' => $req->all()
        ]);
    }
}
