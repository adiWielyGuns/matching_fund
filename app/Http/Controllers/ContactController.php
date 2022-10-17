<?php

namespace App\Http\Controllers;

use App\Interfaces\ContactRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class ContactController extends Controller
{
    private ContactRepositoryInterface $contactRepository;

    public function __construct(ContactRepositoryInterface $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    public function index()
    {

        return view('cms/contact/contact');
    }


    public function datatable(Request $req): JsonResponse
    {
        $data = $this->contactRepository->getAllContacts();

        return DataTables::of($data)
            ->addColumn('aksi', function ($data) {
                return '<button class="btn btn-primary" onclick="reply(\'' . $data->email . '\')"><i class="fas fa-envelope"></i></button>';
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
            ->addColumn('data_diri', function ($data) {
                $html = '<div class="bg-white rounded p-2">' .
                    '<div class="d-flex justify-content-between">Nama ' . '<b>' . $data->name . '</b>' . '</div>'  .
                    '<div class="d-flex justify-content-between">Email ' . '<b>' . $data->email . '</b>' . '</div>'  .
                    '<div class="d-flex justify-content-between">Phone ' . '<b>' . $data->phone . '</b>' . '</div></div>';

                return $html;
            })
            ->rawColumns(['aksi', 'status', 'data_diri'])
            ->addIndexColumn()
            ->make(true);
    }
}
