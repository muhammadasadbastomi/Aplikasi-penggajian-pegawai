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
        $pegawai = pegawai::where('uuid', $id)->first();

        return view('admin.user.profile', compact('user', 'pegawai'));
    }
    public function update(Request $request, $id)
    {
        //dd($request->all());
        $messages = [
            'unique' => ':attribute sudah terdaftar.',
            'required' => ':attribute harus diisi.'
        ];
        //dd($request->all());
        $request->validate([
            'nama' => 'required',
            'email' => 'unique:users',
            'tempat_lahir' => 'required',
        ], $messages);
        // get data by id
        $user = User::where('uuid', $id)->first();

        //get pegawai
        $pegawai = Pegawai::where('id', $user->id)->first();

        $user->name = $request->nama;
        //cek if exist input email
        if (!$request->email) {
            $user->email = $user->email;
        } else {
            $user->email = $request->email;
        }
        //cek if exist input password
        if (!$request->password) {
            $user->password = $user->password;
        } else {
            $user->password = Hash::make($request->password);
        }
        $user->update();

        $pegawai->nama = $request->nama;
        $pegawai->tempat_lahir = $request->tempat_lahir;
        $pegawai->tgl_lahir = $request->tgl_lahir;
        $pegawai->tgl_masuk = $request->tgl_masuk;
        $pegawai->update();

        return redirect()->route('userShow')->with('success', 'Data Berhasil Diubah');
    }
}
