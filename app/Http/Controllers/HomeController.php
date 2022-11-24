<?php

namespace App\Http\Controllers;

use App\Interfaces\BlogRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\ReservationRepositoryInterface;
use App\Interfaces\TableRepositoryInterface;
use App\Models\MasterMenu;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Inertia\Inertia;

class HomeController extends Controller
{
    private TableRepositoryInterface $tableRepository;
    private CategoryRepositoryInterface $categoryRepository;
    private BlogRepositoryInterface $blogRepository;
    private ReservationRepositoryInterface $reservationRepository;

    public function __construct(TableRepositoryInterface $tableRepository, CategoryRepositoryInterface $categoryRepository, BlogRepositoryInterface $blogRepository, ReservationRepositoryInterface $reservationRepository)
    {
        $this->tableRepository = $tableRepository;
        $this->categoryRepository = $categoryRepository;
        $this->blogRepository = $blogRepository;
        $this->reservationRepository = $reservationRepository;
    }

    public function index()
    {
        return Inertia::render('Welcome', [
            'now' => Carbon::now()->format('l, d-m-Y'),
            'table' => $this->tableRepository->getAllTablesActive('id, name as text'),
            'blogs' => $this->blogRepository->getAllBlogsActive('id, title, image as url'),
        ]);
    }

    public function order(Request $req)
    {
        $table = $this->tableRepository->getTableById($req->table_id);
        $categories = $this->categoryRepository->getAllCategoryActive('id, name as text');
        $menu = MasterMenu::where('status', true)->get();
        if (isset($req->reservation_id)) {
            $reservation_id = Crypt::decrypt($req->reservation_id);
        } else {
            $reservation_id = null;
        }

        return Inertia::render('Order', [
            'now' => Carbon::now()->format('l, d-m-Y'),
            'req' => $req->all(),
            'table' => $table,
            'categories' => $categories,
            'menu' => $menu,
            'reservation_id' => $reservation_id,
        ]);
    }

    public function receipt(Request $req)
    {
        $req->id = Crypt::decrypt($req->id);
        $data = Reservation::with(['meja'])->find($req->id);

        return Inertia::render('Receipt', [
            'date' => CarbonParseISO($data->tanggal . ' ' . $data->jam, 'DD MMMM Y, H:mm'),
            'data' => $data,
            'telpon' => cms('telphone'),
        ]);
    }
}
