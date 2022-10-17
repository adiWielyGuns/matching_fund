<?php

namespace App\Http\Controllers;

use App\Interfaces\ScheduleRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeCmsController extends Controller
{
    private ScheduleRepositoryInterface $scheduleRepository;

    public function __construct(ScheduleRepositoryInterface $scheduleRepository)
    {
        $this->scheduleRepository = $scheduleRepository;
    }

    public function index()
    {
        // Auth::logout();
        $data = $this->scheduleRepository->getAllSchedules();

        return view('dashboard_cms', compact('data'));
    }
}
