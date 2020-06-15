<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Golongan;
use App\Jabatan;
use App\Pegawai;
use App\User;
use Hash;
use PDF;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $karyawan = Pegawai::whereIn('pekerja', ['karyawan'])->orderBy('id', 'Desc')->get();
        $karyawan = Pegawai::orderBy('id', 'Desc')->get();
        return view('admin.karyawan.index', compact('karyawan'));
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
        $karyawan = Pegawai::orderBy('id', 'asc')->get();
        return view('admin.karyawan.create', compact('karyawan'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
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
        Pegawai::create($request->all());

        return redirect()->route('karyawanIndex')->with('success', 'Data berhasil disimpan');
    }

    public function show(Pegawai $pegawai)
    {
        //
    }

    public function edit(Pegawai $pegawai, $id)
    {
        // get karyawan by id
        $karyawan = Pegawai::where('uuid', $id)->first();
        $karyawan1 = Pegawai::where('uuid', $id)->get();
        // dd($golongan);

        return view('admin.karyawan.edit', compact('karyawan', 'jabatan', 'golongan', 'karyawan1'));
    }

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
        $karyawan = pegawai::where('uuid', $id)->first();

        //get user
        $user = User::where('id', $karyawan->user_id)->first();

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

        $karyawan->nik = $request->nik;
        $karyawan->nama = $request->nama;
        $karyawan->status = $request->status;
        $karyawan->alamat = $request->alamat;
        $karyawan->tempat_lahir = $request->tempat_lahir;
        $karyawan->tgl_lahir = $request->tgl_lahir;
        $karyawan->tgl_masuk = $request->tgl_masuk;
        $karyawan->update();

        return redirect()->route('karyawanIndex')->with('success', 'Data Berhasil Diubah');
    }

    public function destroy(Pegawai $karyawan, $id)
    {
        $karyawan = pegawai::where('uuid', $id)->first();

        // get user by id
        $user = User::where('id', $karyawan->user_id)->delete();

        return redirect()->route('karyawanIndex');
    }
    public function cetak_pdf()
    {
        $karyawan = Pegawai::all();

        $pdf = PDF::loadview('laporan.cetak_karyawan', compact('karyawan'));
        return $pdf->stream('laporan-karyawan-pdf');
    }
    public function filter()
    {
        return view('admin.karyawan.filter');
    }
}
