<?php

use App\Models\CmsManagement;
use App\Models\TitleMenu;
use Illuminate\Support\Facades\Auth;

function dateStore($param = null)
{
    if ($param != null) {
        return \carbon\carbon::parse(str_replace('/', '-', $param))->format('Y-m-d');
    } else {
        return \carbon\carbon::now()->format('Y-m-d');
    }
}

function dateShow($date = null)
{
    if ($date != null) {
        return \carbon\carbon::parse($date)->format('d F Y');
    } else {
        return \carbon\carbon::now()->format('d F Y');
    }
}

function kekata($x)
{
    $x = abs($x);
    $angka = array(
        "", "satu", "dua", "tiga", "empat", "lima",
        "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"
    );
    $temp = "";
    if ($x < 12) {
        $temp = " " . $angka[$x];
    } else if ($x < 20) {
        $temp = kekata($x - 10) . " belas";
    } else if ($x < 100) {
        $temp = kekata($x / 10) . " puluh" . kekata($x % 10);
    } else if ($x < 200) {
        $temp = " seratus" . kekata($x - 100);
    } else if ($x < 1000) {
        $temp = kekata($x / 100) . " ratus" . kekata($x % 100);
    } else if ($x < 2000) {
        $temp = " seribu" . kekata($x - 1000);
    } else if ($x < 1000000) {
        $temp = kekata($x / 1000) . " ribu" . kekata($x % 1000);
    } else if ($x < 1000000000) {
        $temp = kekata($x / 1000000) . " juta" . kekata($x % 1000000);
    } else if ($x < 1000000000000) {
        $temp = kekata($x / 1000000000) . " milyar" . kekata(fmod($x, 1000000000));
    } else if ($x < 1000000000000000) {
        $temp = kekata($x / 1000000000000) . " trilyun" . kekata(fmod($x, 1000000000000));
    }
    return $temp;
}

function terbilang($x, $style = 4)
{
    if ($x < 0) {
        $hasil = "minus " . trim(kekata($x));
    } else {
        $hasil = trim(kekata($x));
    }
    switch ($style) {
        case 1:
            $hasil = strtoupper($hasil);
            break;
        case 2:
            $hasil = strtolower($hasil);
            break;
        case 3:
            $hasil = ucwords($hasil);
            break;
        default:
            $hasil = ucfirst($hasil);
            break;
    }
    return $hasil;
}

function CarbonParse($format)
{
    return \carbon\carbon::parse($date)->format($format);
}

function me()
{
    if (Auth::user() != null) {
        return Auth::user()->name;
    }
}

function dokter($status = null)
{
    return \App\Models\User::whereHas('role', function ($q) use ($status) {
        $q->where('type_role', 'DOKTER');
        if ($status != null) {
            $q->where('status', $status);
        }
    })->get();
}

function convertNumber($nominal, $decimal = false)
{
    if ($nominal == '') {
        return 0;
    }
    return $decimal ? filter_var($nominal, FILTER_SANITIZE_NUMBER_INT) / 100 :
        filter_var($nominal, FILTER_SANITIZE_NUMBER_INT);
}

function hari()
{
    return ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu'];
}

function day()
{
    return ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
}

function bulan()
{
    return ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
}

function month()
{
    return ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
}

function convertDayToHari($day)
{
    $index = array_search($day, day());

    return hari()[$index];
}

function convertMonthToBulan($month)
{
    $date = carbon\carbon::parse($month)->format('d F Y');
    $month = explode(' ', $date);

    $index = array_search($month[1], month());

    $bulan = bulan()[$index];

    return $month[0] . ' ' . $bulan . ' ' . $month[2];
}

function urlToSlug($string)
{
    $url = explode('/', $string);
    return $url[0];
}

function convertSlug($value, $param = 'Capital')
{

    switch ($param) {
        case 'Capital':
            $string = str_replace('-', ' ', $value);
            $string = str_replace('_', ' ', $string);
            $string =   ucwords(strtolower($string));
            return $string;
            break;
        case 'Camel Case':
            $string = str_replace('-', ' ', $value);
            $string = str_replace('_', ' ', $string);

            $string = explode(' ', $string);
            $temp = '';

            foreach ($string as  $i => $value) {
                if ($i == 0) {
                    $temp .= strtolower($value);
                } else {
                    $temp .= ucwords(strtolower($value));
                }
            }

            return $temp;
            break;
        case 'Lower Case':
            return str_replace(' ', '', strtolower($value));
            break;
        case 'Upper Case':
            return str_replace(' ', '', strtoupper($value));
            break;
        default:
            break;
    }
}

function romawi($angka)
{

    $hsl = "";
    if ($angka < 1 || $angka > 3999) {
        $hsl = "Batas Angka 1 s/d 3999";
    } else {
        while ($angka >= 1000) {
            $hsl .= "M";
            $angka -= 1000;
        }
        if ($angka >= 500) {
            if ($angka > 500) {
                if ($angka >= 900) {
                    $hsl .= "M";
                    $angka -= 900;
                } else {
                    $hsl .= "D";
                    $angka -= 500;
                }
            }
        }
        while ($angka >= 100) {
            if ($angka >= 400) {
                $hsl .= "CD";
                $angka -= 400;
            } else {
                $angka -= 100;
            }
        }
        if ($angka >= 50) {
            if ($angka >= 90) {
                $hsl .= "XC";
                $angka -= 90;
            } else {
                $hsl .= "L";
                $angka -= 50;
            }
        }
        while ($angka >= 10) {
            if ($angka >= 40) {
                $hsl .= "XL";
                $angka -= 40;
            } else {
                $hsl .= "X";
                $angka -= 10;
            }
        }
        if ($angka >= 5) {
            if ($angka == 9) {
                $hsl .= "IX";
                $angka -= 9;
            } else {
                $hsl .= "V";
                $angka -= 5;
            }
        }
        while ($angka >= 1) {
            if ($angka == 4) {
                $hsl .= "IV";
                $angka -= 4;
            } else {
                $hsl .= "I";
                $angka -= 1;
            }
        }
    }
    return ($hsl);
}

function dot()
{
    echo '<i class="text-danger">*</i>';
}

function queryStatus($code)
{
    switch ($code) {
        case '23505':
            return Response()->json(['status' => 2, 'message' => 'Data duplikasi'], 500);
            break;
        case '23500':
            return Response()->json(['status' => 2, 'message' => 'Data sudah memiliki relasi data'], 500);
            break;
        case '23503':
            return Response()->json(['status' => 2, 'message' => 'Data ini sudah memiliki relasi dengan data yang lain.'], 500);
            break;
        default:
            return Response()->json(['status' => 2, 'message' => $code->getMessage()], 500);
            break;
    }
}

function titleMenu()
{
    $titleMenu = TitleMenu::where('status', 1)->orderBy('sequence', 'ASC')->get();

    return $titleMenu;
}

function cms($name)
{
    $data = CmsManagement::where('name', $name)->first();

    if ($data) {
        return $data->value;
    } else {
        return null;
    }
}

function CarbonParseISO($date = null, $format, $locale = 'id')
{
    return \carbon\carbon::parse($date)->locale($locale)->isoFormat($format);
}

function distance($lat1, $lon1, $lat2, $lon2, $unit)
{
    if (($lat1 == $lat2) && ($lon1 == $lon2)) {
        return 0;
    } else {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
    }
}
