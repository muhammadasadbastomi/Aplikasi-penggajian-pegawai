<?php

namespace App\Http\Controllers;

use App\Golongan;
use App\Jabatan;
use App\Pegawai;
use App\User;
use Hash;
use PDF;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pegawai = Pegawai::whereIn('pekerja', ['pegawai'])->orderBy('id', 'Desc')->get();

        return view('admin.pegawai.index', compact('pegawai'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $jabatan = Jabatan::orderBy('id', 'asc')->get();
        // $golongan = Golongan::orderBy('id', 'asc')->get();
        return view('admin.pegawai.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $messages = [
            'unique' => ':attribute sudah terdaftar.',
            'email' => ':attribute harus benar.',
            'required' => ':attribute harus diisi.',
            'confirmed' => ':attribute salah.',
            'min' => ':attribute minimal 5 karakter.'
        ];
        //dd($request->all());
        $request->validate([
            'nik' => 'required',
            'nama' => 'required',
            'email' => 'email|unique:users',
            'password' => 'required|confirmed|min:5',
            'tempat_lahir' => 'required',
        ], $messages);

        //insert ke table users
        $user = new User;
        $user->role = 'pegawai';
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        //insert ke table pegawai
        $request->request->add(['user_id' => $user->id]);
        pegawai::create($request->all());

        return redirect('/admin/pegawai/index')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function show(Pegawai $pegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function edit(Pegawai $pegawai, $id)
    {
        // get jabatan by id
        $jabatan = Jabatan::orderBy('id', 'asc')->get();
        $golongan = Golongan::orderBy('id', 'asc')->get();
        $pegawai = Pegawai::where('uuid', $id)->first();
        $pegawai1 = Pegawai::where('uuid', $id)->get();
        // dd($golongan);

        return view('admin.pegawai.edit', compact('pegawai', 'jabatan', 'golongan', 'pegawai1'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request->all());
        $messages = [
            'unique' => ':attribute sudah terdaftar.',
            'required' => ':attribute harus diisi.',
            'confirmed' => ':attribute salah.',
        ];
        //dd($request->all());
        $request->validate([
            'nik' => 'required',
            'nama' => 'required',
            'email' => 'unique:users',
            'tempat_lahir' => 'required',
            'password' => 'confirmed',
        ], $messages);
        // get data by id
        $pegawai = pegawai::where('uuid', $id)->first();

        //get user
        $user = User::where('id', $pegawai->user_id)->first();

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

        $pegawai->nik = $request->nik;
        $pegawai->nama = $request->nama;
        $pegawai->status = $request->status;
        $pegawai->jabatan_id = $request->jabatan_id;
        $pegawai->golongan_id = $request->golongan_id;
        $pegawai->tempat_lahir = $request->tempat_lahir;
        $pegawai->alamat = $request->alamat;
        $pegawai->tgl_lahir = $request->tgl_lahir;
        $pegawai->tgl_masuk = $request->tgl_masuk;
        $pegawai->update();

        return redirect()->route('pegawaiIndex')->with('success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pegawai $pegawai, $id)
    {
        $pegawai = pegawai::where('uuid', $id)->first();

        // get user by id
        $user = User::where('id', $pegawai->user_id)->delete();

        return redirect()->route('pegawaiIndex');
    }
}
