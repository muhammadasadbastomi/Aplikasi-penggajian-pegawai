<?php

namespace App\Http\Controllers;

use App\user;
use App\pegawai;
use Hash;
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
        $user = User::where('uuid', $id)->first();
        $pegawai = Pegawai::where('user_id', $user->id)->first();

        return view('admin.user.profile', compact('user', 'pegawai'));
    }
    public function update(Request $request, User $user, $id)
    {
        //dd($request->all());
        $messages = [
            'unique' => ':attribute sudah terdaftar.',
            'required' => ':attribute harus diisi.',
            'same' => 'Masukkan :attribute dengan benar.',
            'file' => 'photo harus berupa :attribute.',
            'image' => 'file harus berupa :attribute.',
            'mimes' => 'photo berupa :attribute.'


        ];
        //dd($request->all());
        $request->validate([
            'nama' => 'required',
            'email' => 'unique:users',
            "konfirmasi_password" => "same:password",
            'photos' => 'file|image|mimes:jpeg,png,gif',
        ], $messages);

        // get data by id
        $user = User::where('uuid', $id)->first();

        //get pegawai
        $pegawai = Pegawai::where('user_id', $user->id)->first();

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
        $user->photos = $request->photos;
        if ($request->hasfile('photos')) {
            $request->file('photos')->move('images/user/', $request->file('photos')->getClientOriginalName());
            $user->photos = $request->file('photos')->getClientOriginalName();
            $user->save();
        }
        $user->update();

        if ($user->role == 'Pegawai') {
            $pegawai->nama = $request->nama;
            $pegawai->update();
        }

        return redirect('/admin/user/profile/' . $id . '')->with('success', 'Data Berhasil Diubah!');
    }

    public function slipgaji()
    {
        $data = Pegawai::all();

        return view('/admin/slipgaji', compact('data'));
    }
}
