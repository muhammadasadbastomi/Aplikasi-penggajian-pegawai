<?php

namespace App\Http\Controllers;

use App\Pegawai;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class KaryawanController extends Controller
{
    public function index()
    {
        $data = Pegawai::orderBy('id', 'Desc')->get();

        return view('admin.pegawai.index', compact('data'));
    }

    public function store(Request $request)
    {
        $messages = [
            'unique' => 'Email Sudah Terdaftar.',
            'email' => 'Email Harus Benar.',
            'required' => ':attribute harus diisi.',
            'confirmed' => 'Password Salah.',
            'min' => 'Password Minimal 5 Karakter.'
        ];
        $validator = Validator::make($request->all(), [
            'nik' => 'required',
            'nama' => 'required',
            'email' => 'email|unique:users',
            'password' => 'required|confirmed|min:5',
            'tempat_lahir' => 'required',
            'alamat' => 'required',
            'tgl_lahir' => 'required',
            'tgl_masuk' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return back()->with('warning', $validator->errors()->all()[0])->withInput();
        }

        //insert ke table users
        $user = new User;
        $user->role = 'pegawai';
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        //insert ke table pegawai
        $request->request->add(['user_id' => $user->id]);
        Pegawai::create($request->all());

        return back()->with('success', 'Data berhasil disimpan');
    }

    public function update(Request $request)
    {
        $messages = [
            'email' => 'Email Harus Benar.',
            'required' => ':attribute harus diisi.',
            'confirmed' => 'Password yang anda Masukkan Salah.',
            'min' => 'Password Minimal 5 Karakter.'
        ];
        $validator = Validator::make($request->all(), [
            'nik' => 'required',
            'email' => 'required|email',
            'nama' => 'required',
            'password' => 'confirmed|min:5',
            'tempat_lahir' => 'required',
            'alamat' => 'required',
            'tgl_lahir' => 'required',
            'tgl_masuk' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return back()->with('warning', $validator->errors()->all()[0])->withInput();
        }


        $pegawai = pegawai::where('id', $request->id)->first();
        $user = User::where('id', $pegawai->user_id)->first();

        //user
        $user->name = $request->nama;
        //cek if exist input password
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

        //karywan
        $pegawai->nik = $request->nik;
        $pegawai->nama = $request->nama;
        $pegawai->status = $request->status;
        $pegawai->alamat = $request->alamat;
        $pegawai->tempat_lahir = $request->tempat_lahir;
        $pegawai->tgl_lahir = $request->tgl_lahir;
        $pegawai->tgl_masuk = $request->tgl_masuk;
        $pegawai->update();

        return back()->with('success', 'Data Berhasil Diubah');
    }

    public function destroy($uuid, $id)
    {
        $pegawai = pegawai::where('uuid', $uuid)->first();
        $pegawai->delete();

        $user = User::where('uuid', $id)->first();
        $user->delete();

        return back()->with('success', 'Data Berhasil Dihapus');
    }
}
