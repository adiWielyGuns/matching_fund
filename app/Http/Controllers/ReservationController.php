<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class ReservationController extends Controller
{
    public function index()
    {
        return view('transaction/reservation/reservation');
    }

    public function aksi($data)
    {
        $buktiTranfer = '';
        $edit = '';
        $cancel = '';
        $abandon = '';
        $delete = '';
        if (Auth::user()->akses('edit')) {
            // $edit = '<a class="dropdown-item text-info" href="javascript:;" onclick="edit(\'' . $data->id . '\')">' .
            //     '<i class="fa fa-edit"></i>&nbsp;&nbsp;&nbsp;Edit' .
            //     '</a>';

            $edit = '<a class="dropdown-item text-info" href="javascript:;" onclick="edit(\'' . $data->id . '\')">' . '<i class="fa fa-edit"></i>&nbsp;&nbsp;&nbsp;Upload Bukti Transfer' . '</a>';

            $cancel = '<a class="dropdown-item text-warning" href="javascript:;" onclick="changeStatus(\'' . $data->id . '\')">' . '<i class="fa fa-trash"></i>&nbsp;&nbsp;&nbsp;Tidak Jadi' . '</a>';

            $abandon = '<a class="dropdown-item text-danger" href="javascript:;" onclick="changeStatus(\'' . $data->id . '\')">' . '<i class="fa fa-times"></i>&nbsp;&nbsp;&nbsp;Tidak Datang' . '</a>';
        }

        // if (Auth::user()->akses('delete')) {
        //     $delete = '<a class="dropdown-item text-danger" href="javascript:;" onclick="hapus(\'' . $data->id . '\')">' .
        //         '<i class="fa fa-trash"></i>&nbsp;&nbsp;&nbsp;Delete' .
        //         '</a>';
        // }

        return '<div class="dropdown show">' .
            '  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' .
            '<i class="fa fa-bars"></i>' .
            '  </a>' .
            '<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">' .
            $edit .
            $cancel .
            $abandon .
            // $delete .
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
            $cancel .
            $abandon .
            // $delete .
            '</ul>' .
            '</div>' .
            '</div>';
    }

    public function datatable(Request $req): JsonResponse
    {
        $data = Reservation::get();
        return DataTables::of($data)
            ->addColumn('aksi', function ($data) {
                return $this->aksi($data);
            })
            ->addColumn('status', function ($data) {
                // 'Waiting For Payment','Paid','Done','Canceled','Abandoned'
                if ($data->status == 'Waiting For Payment') {
                    return '<span class="btn btn-warning"> Menunggu Pembayaran </span>';
                }elseif ($data->status == 'Paid') {
                    return '<span class="btn btn-success"> Terbayar DP </span>';
                }
            })
            ->addColumn('Pelanggan', function ($data) {
                $table = '<table class="table">' . '<tr>' . '<td>' . 'Nama' . '</td>' . '<td>' . $data->nama . '</td>' . '</tr>' . '<tr>' . '<td>' . 'Tanggal / Jam' . '</td>' . '<td>' . $data->tanggal . ' , ' . $data->jam . '</td>' . '</tr>' . '<tr>' . '<td>' . 'Total Pelng.' . '</td>' . '<td>' . $data->pax . '</td>' . '</tr>' . '<tr>' . '<td>' . 'Meja' . '</td>' . '<td>' . $data->meja->name . '</td>' . '</tr>' . '<tr>' . '<td>' . 'Tlp' . '</td>' . '<td>' . $data->telpon . '</td>' . '</tr>' . '</table>';
                return $table;
            })
            ->addColumn('BuktiTf', function ($data) {
                if ($data->bukti_transfer == null) {
                    $html = 'Belum Transfer';
                } else {
                    return '<img class="rounded" width="75" height="75" src="' . $data->bukti_transfer . '"></img>';
                }

                return $html;
            })
            ->rawColumns(['aksi', 'status', 'BuktiTf', 'Pelanggan'])
            ->addIndexColumn()
            ->make(true);
    }
    public function edit(Request $request): JsonResponse
    {
        $id = $request->id;

        return response()->json([
            'data' => Reservation::find($id),
            'message' => 'Berhasil merubah status data',
        ]);
    }
    public function store(Request $req)
    {
        return DB::transaction(function () use ($req) {
            $file = $req->file('image');
            if ($file != null) {
                $path = 'image/reservation';
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
                $foto = Reservation::where('id',$req->id)->first()->bukti_transfer;
            }
            $categoryDetails = [
                // 'name' => convertSlug($req->name, 'Capital'),
                // 'category_id' => $req->category_id,
                'bukti_transfer' => $foto,
                'status' => 'Paid',
                // 'slug' => $req->slug,
                'no_rekening' => $req->no_rekening,
                'bank' => $req->bank,
                'nominal_transfer' => convertNumber($req->nominal_transfer),
                // 'price_after_discount' => 0,
                'updated_by' => me(),
            ];

            return response()->json(
                [
                    'status' => 1,
                    'message' => 'Berhasil merubah data',
                    'data' => Reservation::where('id',$req->id)->update($categoryDetails),
                ],
                Response::HTTP_CREATED,
            );
        });
    }
}
