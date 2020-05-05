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

        return view('admin.user.index', compact('user'));
    }

    public function show($id)
    {
        $user = user::orderBy('id', 'Desc')->get();
        $pegawai = Pegawai::where('uuid', $id)->first();
        return view('admin.user.detail', compact('user', 'pegawai'));
    }
}
