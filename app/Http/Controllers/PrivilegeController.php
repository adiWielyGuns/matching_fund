<?php

namespace App\Http\Controllers;

use App\Interfaces\PrivilegeRepositoryInterface;
use App\Models\GroupMenu;
use App\Models\Privilege;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PrivilegeController extends Controller
{
    private PrivilegeRepositoryInterface $privilegeRepository;

    public function __construct(PrivilegeRepositoryInterface $privilegeRepository)
    {
        $this->privilegeRepository = $privilegeRepository;
    }

    public function index()
    {

        return view('privileges/privilege/privilege');
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
            if ($data->group_menu->count() == 0) {
                $delete = '<a class="dropdown-item text-danger" href="javascript:;" onclick="hapus(\'' . $data->id . '\')">' .
                    '<i class="fa fa-trash"></i>&nbsp;&nbsp;&nbsp;Delete' .
                    '</a>';
            }
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
        $data = Privilege::get();
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
            ->addColumn('sequence', function ($data) {
                return '<input type="number" value="' . $data->sequence . '" class="form-control border bg-white text-center" style="color:#c70039" onchange="gantiSequence(\'' . $data->id . '\',this)">';
            })
            ->rawColumns(['aksi', 'status', 'icon', 'sequence'])
            ->addIndexColumn()
            ->make(true);
    }


    public function store(Request $req): JsonResponse
    {

        return DB::transaction(function () use ($req) {
            if ($req->jenis == 'GLOBAL') {
                $groupItem = GroupMenu::findOrFail($req->groupItemId);

                foreach ($groupItem->Menu as $i => $d) {
                    $check = Privilege::where('role_id', $req->roleId)
                        ->where('menu_id', $d->id)
                        ->first();
                    if (is_null($check)) {
                        $id = $this->privilegeRepository->getIdPrivilege();

                        $privilegeDetails = [
                            'id' => $id,
                            'role_id' => $req->roleId,
                            'menu_id' => $d->id,
                            $req->column => $req->param,
                            'created_by' => me(),
                            'updated_by' => me(),
                        ];

                        $this->privilegeRepository->createPrivilege($privilegeDetails);
                    } else {
                        Privilege::where('role_id', $req->roleId)
                            ->where('menu_id', $d->id)
                            ->update([
                                $req->column => $req->param,
                                'updated_by' => me(),
                            ]);
                    }
                }
            } else if ($req->jenis == 'MENU') {
                $hakAkses = Privilege::where('role_id', $req->roleId)
                    ->where('menu_id', $req->menuId)
                    ->first();
                if (is_null($hakAkses)) {
                    $id = $this->privilegeRepository->getIdPrivilege();
                    Privilege::create([
                        'id' => $id,
                        'role_id' => $req->roleId,
                        'menu_id' => $req->menuId,
                        $req->column => $req->param,
                        'created_by' => me(),
                        'updated_by' => me(),
                    ]);
                } else {
                    Privilege::where('role_id', $req->roleId)
                        ->where('menu_id', $req->menuId)
                        ->update([
                            $req->column => $req->param,
                            'updated_by' => me(),
                        ]);
                }
            }
            return Response()->json(['status' => 1, 'message' => 'Berhasil merubah data']);
        });
    }

    public function edit(Request $req)
    {
        if (!isset($req->param)) {
            Auth::user()->akses('edit', null, true);
        }

        $groupMenu = GroupMenu::where('status', 1)
            ->orderBy('sequence', 'ASC')
            ->get();

        return view('privileges/privilege/table_privilege', compact('groupMenu', 'req'));
    }

    public function destroy(Request $request): JsonResponse
    {
        $orderId = $request->id;

        $this->privilegeRepository->deletePrivilege($orderId);

        return response()->json(['status' => 1], 200);
    }

    public function gantiStatus(Request $req): JsonResponse
    {
        $orderId = $req->id;
        $privilegeDetails = [
            'status' => $req->param,
            'updated_by' => me(),
        ];


        return response()->json([
            'data' => $this->privilegeRepository->updatePrivilege($orderId, $privilegeDetails),
            'message' => 'Berhasil merubah status data',
        ]);
    }

    public function sequence(Request $req)
    {
        Auth::user()->akses('edit', null, true);
        return DB::transaction(function () use ($req) {
            $orderId = $req->id;
            $privilegeDetails = [
                'sequence' => $req->sequence,
                'updated_by' => me(),
            ];


            return response()->json([
                'data' => $this->privilegeRepository->updatePrivilege($orderId, $privilegeDetails),
                'message' => 'Berhasil merubah urutan data',
            ]);
        });
    }
}
