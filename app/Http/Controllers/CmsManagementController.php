<?php

namespace App\Http\Controllers;


use App\Models\CmsManagement;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use App\Interfaces\CmsManagementRepositoryInterface;

class CmsManagementController extends Controller
{
    private CmsManagementRepositoryInterface $cmsManagementRepository;

    public function __construct(CmsManagementRepositoryInterface $cmsManagementRepository)
    {
        $this->cmsManagementRepository = $cmsManagementRepository;
    }

    public function index()
    {
        $cms = $this->cmsManagementRepository->getAllCmsManagements();
        return view('cms/cms_management/cms_management', compact('cms'));
    }

    public function store(Request $req): JsonResponse
    {
        return DB::transaction(function () use ($req) {
            $id = $req->id;
            $input = $req->all();

            $file = $req->file('value');

            if ($file) {
                $path = 'image/cms';
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
                $value = url('/') . '/' . $foto;
            } else {
                if ($req->type == 'IMAGE') {
                    $value = $this->cmsManagementRepository->getCmsManagementById($id)->image;
                } else {
                    $value = $req->value;
                }
            }
            $cmsManagementDetails = [
                'value' => $value,
            ];
            return response()->json(
                [
                    'status' => 1,
                    'message' => 'Berhasil merubah data',
                    'data' => $this->cmsManagementRepository->updateCmsManagement($req->id, $cmsManagementDetails)
                ],
                Response::HTTP_CREATED
            );
        });
    }

    public function edit(Request $request)
    {
        $data = $this->cmsManagementRepository->getCmsManagementById($request->id);
        return view('cms/cms_management/content_cms_management', compact('data'));
    }

    public function destroy(Request $request): JsonResponse
    {
        $id = $request->id;

        $this->cmsManagementRepository->deleteCmsManagement($id);

        return response()->json(['status' => 1], 200);
    }

    public function gantiStatus(Request $req): JsonResponse
    {
        $id = $req->id;
        $roleDetails = [
            'status' => $req->param,
            'updated_by' => me(),
        ];


        return response()->json([
            'data' => $this->cmsManagementRepository->updateCmsManagement($id, $roleDetails),
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
                'data' => $this->cmsManagementRepository->updateCmsManagement($id, $roleDetails),
                'message' => 'Berhasil merubah urutan data',
            ]);
        });
    }
}
