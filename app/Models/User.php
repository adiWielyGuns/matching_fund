<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'image',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function akses($column, $param = null, $abort = false)
    {
        $hakAkses = new Privilege();
        $menu = null;
        if (is_null($param)) {
            if (request()->segment(3) == null) {
                $slug = request()->segment(2);
                $menu = \App\Models\Menu::where('slug', 'like', $slug . '%')->first();
            } elseif (request()->segment(4) == null) {
                $slug = request()->segment(3);
                $menu = \App\Models\Menu::where('slug', 'like', $slug . '%')->first();
            } else {
                $slug = request()->segment(4);
                $menu = \App\Models\Menu::where('slug', 'like', $slug . '%')->first();
            }
        } else {
            $menu = \App\Models\Menu::where('name', 'like', $param . '%')->first();
        }

        if (!is_null($menu)) {
            $data = $hakAkses
                ->where(function ($q) use ($menu, $param) {
                    $q->where('menu_id', $menu->id);
                })
                ->where('role_id', Auth::user()->role_id)
                ->where($column, true)
                ->first();
        } else {
            $hak_akses = new Privilege();
            $data = $hak_akses
                ->where(function ($q) {
                    $q->where('menu_id', 1);
                })
                ->where($column, true)
                ->where('role_id', Auth::user()->role_id)
                ->first();
        }

        if (is_null($data)) {
            if (Auth::user()->role_id != 1) {
                if ($abort) {
                    abort(403, 'Anda tidak memiliki akses untuk fitur ini.');
                }
                $validation = false;
            } else {
                $validation = true;
            }
        } else {
            $validation = true;
        }


        return $validation;
    }

    public function aksesMenu($column, $param = null)
    {
        $hakAkses = new Privilege();
        $menu = null;
        $subMenu = null;

        $menu = \App\Models\Menu::where('slug', 'like', $param . '%')->first();

        $data = $hakAkses
            ->where(function ($q) use ($menu, $subMenu, $param) {
                $q->where('menu_id', $menu->id);
            })
            ->where('role_id', Auth::user()->role_id)
            ->where($column, true)
            ->first();

        if (is_null($data)) {
            $validation = false;
        } else {
            $validation = true;
        }

        if (Auth::user()->role_id == 1) {
            $validation = true;
        }

        return $validation;
    }
}
