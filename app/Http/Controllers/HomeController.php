<?php

namespace App\Http\Controllers;

use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\TableRepositoryInterface;
use App\Models\MasterMenu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    private TableRepositoryInterface $tableRepository;
    private CategoryRepositoryInterface $categoryRepository;

    public function __construct(TableRepositoryInterface $tableRepository, CategoryRepositoryInterface $categoryRepository)
    {
        $this->tableRepository = $tableRepository;
        $this->categoryRepository = $categoryRepository;
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
        $table = $this->tableRepository->getTableById($req->table_id);
        $categories = $this->categoryRepository->getAllCategoryActive('id, name as text');
        $menu = MasterMenu::where('status', true)->get();

        return Inertia::render('Order', [
            'now' => Carbon::now()->format('l, d-m-Y'),
            'req' => $req->all(),
            'table' => $table,
            'categories' => $categories,
            'menu' => $menu,
        ]);
    }
}
