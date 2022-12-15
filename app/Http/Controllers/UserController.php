<?php

namespace App\Http\Controllers;

use App\Interfaces\UserRepositoryInterface;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class UserController extends Controller
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $role = Role::where('status', 1)
            ->where('name', '!=', 'Superuser')
            ->get();
        return view('cms/user/user', compact('role'));
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
        $data = User::whereHas('role', function ($q) {
            $q->where('name', '!=', 'Superuser');
        })->get();

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
            ->addColumn('image', function ($data) {
                return '<img class="rounded" width="75" height="75" src="' . $data->image . '"></img>';
            })
            ->addColumn('role', function ($data) {
                return $data->role->name;
            })
            ->addColumn('price', function ($data) {
                $html = '<div class="bg-white rounded p-2">' .
                    '<div class="d-flex justify-content-between">Bento mealbox ' . '<b>' . number_format($data->price_bento_mealbox) . '</b>' . '</div>'  .
                    '<div class="d-flex justify-content-between">Value box ' . '<b>' . number_format($data->price_value_box) . '</b>' . '</div>'  .
                    '<div class="d-flex justify-content-between">Family pack ' . '<b>' . number_format($data->price_family_pack) . '</b>' . '</div></div>';

                return $html;
            })
            ->rawColumns(['aksi', 'status', 'icon', 'sequence', 'image', 'price'])
            ->addIndexColumn()
            ->make(true);
    }

    public function store(Request $req): JsonResponse
    {
        return DB::transaction(function () use ($req) {
            $id = $req->id;
            $input = $req->all();
            if ($id == '' or $id == null) {

                $validator = Validator::make(
                    $input,
                    [
                        'email'       => 'unique:users' . ($req->id == null ? '' : ",email,$req->id"),
                    ],
                    [
                        'email.unique'        => 'Email already exist',
                    ]
                );

                if ($validator->fails()) {
                    return response()->json($validator->getMessageBag(), Response::HTTP_BAD_REQUEST);
                }

                $file = $req->file('image');
                if ($file != null) {
                    $path = 'image/user';
                    $id = Str::uuid($req->id)->toString();
                    $name = $id . '.' . str_replace('image/', '', $file->getClientOriginalExtension());
                    $foto = $path . '/' . $name;
                    if (is_file($foto)) {
                        unlink($foto);
                    }

                    if (!file_exists($path)) {
                        $oldmask = umask(0);
                        mkdir($path, 0777, true);
                        umask($oldmask);
                    }

                    $img = Image::make(file_get_contents($file))->encode(str_replace('image/', '', $file->getMimeType()), 12);
                    $img->save($foto);
                    $foto = url('/') . '/' . $foto;
                } else {
                    $foto = null;
                }

                $userDetails = [
                    'id' => $this->userRepository->getIdUser(),
                    'image' => $foto,
                    'name' => $req->name,
                    'email' => $req->email,
                    'password' => Hash::make($req->password),
                    'role_id' => $req->role_id,
                    'status' => 1,
                ];
                return response()->json(
                    [
                        'status' => 1,
                        'message' => 'Berhasil menyimpan data',
                        'data' => $this->userRepository->createUser($userDetails)
                    ],
                    Response::HTTP_CREATED
                );
            } else {
                $file = $req->file('image');
                if ($file != null) {
                    $path = 'image/user';
                    $uuid = Str::uuid($req->id)->toString();
                    $name = $uuid . '.' . str_replace('image/', '', $file->getClientOriginalExtension());
                    $foto = $path . '/' . $name;
                    if (is_file($foto)) {
                        unlink($foto);
                    }

                    if (!file_exists($path)) {
                        $oldmask = umask(0);
                        mkdir($path, 0777, true);
                        umask($oldmask);
                    }

                    $img = Image::make(file_get_contents($file))->encode(str_replace('image/', '', $file->getMimeType()), 12);
                    $img->save($foto);
                    $foto = url('/') . '/' . $foto;
                } else {
                    $foto = $this->userRepository->getUserById($id)->image;
                }

                $userDetails = [
                    'image' => $foto,
                    'name' => $req->name,
                    'password' => Hash::make($req->password),
                    'role_id' => $req->role_id,
                ];

                return response()->json(
                    [
                        'status' => 1,
                        'message' => 'Berhasil merubah data',
                        'data' => $this->userRepository->updateUser($id, $userDetails)
                    ],
                    Response::HTTP_CREATED
                );
            }
        });
    }

    public function edit(Request $request): JsonResponse
    {
        $id = $request->id;

        return response()->json([
            'data' => $this->userRepository->getUserById($id),
            'message' => 'Berhasil merubah status data',
        ]);
    }

    public function destroy(Request $request): JsonResponse
    {
        $id = $request->id;

        $this->userRepository->deleteUser($id);

        return response()->json(['status' => 1], 200);
    }

    public function gantiStatus(Request $req): JsonResponse
    {
        $id = $req->id;
        $roleDetails = [
            'status' => $req->param,
        ];


        return response()->json([
            'data' => $this->userRepository->updateUser($id, $roleDetails),
            'message' => 'Berhasil merubah status data',
        ]);
    }

    public function sequence(Request $req)
    {
        Auth::user()->akses('edit', null, true);
        return DB::transaction(function () use ($req) {
            $id = $req->id;
            $roleDetails = [
                'sequence' => $req->sequence,
                'updated_by' => me(),
            ];


            return response()->json([
                'data' => $this->userRepository->updateUser($id, $roleDetails),
                'message' => 'Berhasil merubah urutan data',
            ]);
        });
    }
}
