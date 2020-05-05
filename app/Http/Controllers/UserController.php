<?php

namespace App\Http\Controllers;

use App\user;
use App\pegawai;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = user::orderBy('id', 'Desc')->get();

        return view('admin.admin.index', compact('user'));
    }

    public function show()
    {
        $user = user::orderBy('id', 'Desc')->get();
        $pegawai = Pegawai::orderBy('id', 'Desc')->get();
        return view('admin.admin.detail', compact('user', 'pegawai'));
    }
}
