<?php

namespace App\Http\Controllers;

use App\Interfaces\MenuRepositoryInterface;
use App\Models\Menu;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class MenuController extends Controller
{
    private MenuRepositoryInterface $menuRepository;

    public function __construct(MenuRepositoryInterface $menuRepository)
    {
        $this->menuRepository = $menuRepository;
    }

    public function index()
    {

        return view('settings/menu/menu');
    }

    public function aksi($data)
    {
        $edit = '';
        $delete = '';
        if (Auth::user()->akses('edit')) {

            $edit = '<a class="dropdown-item text-info" href="javascript:;" onclick="edit(\'' . $data->id . '\')">' .
                '<i class="fa fa-edit"></i>&nbsp;&nbsp;&nbsp;Edit' .
                '</a>';
        }

        if (Auth::user()->akses('delete')) {
            $delete = '<a class="dropdown-item text-danger" href="javascript:;" onclick="hapus(\'' . $data->id . '\')">' .
                '<i class="fa fa-trash"></i>&nbsp;&nbsp;&nbsp;Delete' .
                '</a>';
        }


        return '<div class="dropdown show">' .
            '  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' .
            '<i class="fa fa-bars"></i>' .
            '  </a>' .

            '<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">' .
            $edit .
            $delete .
            '  </div>' .
            '</div>';

        return '<div class="dropdown">' .
            '<button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">' .
            '<span class="w-5 h-5 flex items-center justify-center">' .
            '<i class="fa fa-bars"></i>' .
            '</span>' .
            '</button>' .
            '<div class="dropdown-menu w-52 ">' .
            '<ul class="dropdown-content">' .
            $edit .
            $delete .
            '</ul>' .
            '</div>' .
            '</div>';
    }


    public function datatable(Request $req): JsonResponse
    {
        $data = Menu::get();
        return DataTables::of($data)
            ->addColumn('aksi', function ($data) {
                return $this->aksi($data);
            })
            ->addColumn('status', function ($data) {
                if ($data->status == true) {
                    return '<button class="btn btn-success btn-round btn-xs" onclick="gantiStatus(0,\'' . $data->id . '\')"><i class="fa fa-check-circle"></i></button>';
                } else {
                    return '<button class="btn btn-danger btn-round btn-xs" onclick="gantiStatus(1,\'' . $data->id . '\')"><i class="fa fa-check-circle"></i></button>';
                }
            })
            ->addColumn('icon', function ($data) {
                return '<i class="' . $data->icon . ' text-2xl"></i>';
            })
            ->addColumn('group_menu', function ($data) {
                return $data->group_menu->name;
            })
            ->addColumn('sequence', function ($data) {
                return '<input type="number" value="' . $data->sequence . '" class="form-control border bg-white text-center" style="color:#c70039" onchange="gantiSequence(\'' . $data->id . '\',this)">';
            })
            ->rawColumns(['aksi', 'status', 'icon', 'sequence', 'icon'])
            ->addIndexColumn()
            ->make(true);
    }


    public function store(Request $req): JsonResponse
    {

        return DB::transaction(function () use ($req) {
            $orderId = $req->id;
            if ($orderId == '' or $orderId == null) {
                $menuDetails = [
                    'id' => $this->menuRepository->getIdMenu(),
                    'icon' => $req->icon,
                    'name' => convertSlug($req->name, 'Capital'),
                    'group_menu_id' => $req->group_menu_id,
                    'slug' => $req->slug,
                    'type' => $req->type,
                    'created_by' => me(),
                    'updated_by' => me(),
                ];

                return response()->json(
                    [
                        'status' => 1,
                        'message' => 'Berhasil menyimpan data',
                        'data' => $this->menuRepository->createMenu($menuDetails)
                    ],
                    Response::HTTP_CREATED
                );
            } else {
                $menuDetails = [
                    'name' => convertSlug($req->name, 'Capital'),
                    'group_menu_id' => $req->group_menu_id,
                    'slug' => $req->slug,
                    'type' => $req->type,
                    'updated_by' => me(),
                ];
                return response()->json(
                    [
                        'status' => 1,
                        'message' => 'Berhasil merubah data',
                        'data' => $this->menuRepository->updateMenu($orderId, $menuDetails)
                    ],
                    Response::HTTP_CREATED
                );
            }
        });
    }

    public function edit(Request $request): JsonResponse
    {
        $orderId = $request->id;

        return response()->json([
            'data' => $this->menuRepository->getMenuById($orderId),
            'message' => 'Berhasil merubah status data',
        ]);
    }

    public function destroy(Request $request): JsonResponse
    {
        Auth::user()->akses('delete', null, true);
        $orderId = $request->id;

        $this->menuRepository->deleteMenu($orderId);

        return response()->json(['status' => 1], 200);
    }

    public function gantiStatus(Request $req): JsonResponse
    {
        $orderId = $req->id;
        $menuDetails = [
            'status' => $req->param,
            'updated_by' => me(),
        ];


        return response()->json([
            'data' => $this->menuRepository->updateMenu($orderId, $menuDetails),
            'message' => 'Berhasil merubah status data',
        ]);
    }

    public function sequence(Request $req)
    {
        Auth::user()->akses('edit', null, true);
        return DB::transaction(function () use ($req) {
            $orderId = $req->id;
            $menuDetails = [
                'sequence' => $req->sequence,
                'updated_by' => me(),
            ];


            return response()->json([
                'data' => $this->menuRepository->updateMenu($orderId, $menuDetails),
                'message' => 'Berhasil merubah urutan data',
            ]);
        });
    }
}
