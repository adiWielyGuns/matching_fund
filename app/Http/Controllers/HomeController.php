<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{

    public function index()
    {
        return Inertia::render('Welcome');
    }

    public function order(Request $req)
    {
        return Inertia::render('Order', [
            'now' => Carbon::now()->format('l, d-m-Y'),
            'req' => $req->all()
        ]);
    }
}
