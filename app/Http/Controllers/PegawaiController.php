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
        $pegawai = Pegawai::orderBy('id', 'Desc')->get();

        return view('admin.pegawai.index', compact('pegawai'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jabatan = Jabatan::orderBy('id', 'asc')->get();
        $golongan = Golongan::orderBy('id', 'asc')->get();
        return view('admin.pegawai.create', compact('jabatan', 'golongan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'nik' => 'required',
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'tgl_masuk' => 'required',
        ]);

        //insert ke table users
        $user = new User;
        $user->role = 'pegawai';
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        //insert ke table pegawai
        $request->request->add(['user_id' => $user->id]);
        $pegawai = pegawai::create($request->all());
        if ($request->hasfile('photos')) {
            $request->file('photos')->move('images/pegawai/', $request->file('photos')->getClientOriginalName());
            $pegawai->photos = $request->file('photos')->getClientOriginalName();
            $pegawai->save();
        }

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
        return view('admin.pegawai.show', compact('pegawai', 'total_members', 'members'));
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
        $jabatan = \App\Jabatan::orderBy('id', 'asc')->get();
        $pegawai = pegawai::where('uuid', $id)->first();

        return view('admin.pegawai.edit', compact('pegawai', 'jabatan'));
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
        // get data by id
        $pegawai = pegawai::where('uuid', $id)->first();

        //get user
        $user = User::where('id', $pegawai->id)->first();

        $user->name = $request->nama;
        $user->email = $request->email;

        //cek if exist input password
        if (!$request->password) {
            $user->password = $user->password;
        } else {
            $user->password = Hash::make($request->password);
        }

        $user->update();

        $pegawai->nik = $request->nik;
        $pegawai->nama = $request->nama;
        $pegawai->jabatan_id = $request->jabatan_id;
        $pegawai->tempat_lahir = $request->tempat_lahir;
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
        $user = User::where('id', $pegawai->id)->first();

        $user->delete();

        return redirect()->route('pegawaiIndex');
    }
    public function cetak_pdf()
    {
        $pegawai = Pegawai::all();

        $pdf = PDF::loadview('admin.pegawai.cetak_pdf', compact('pegawai'));
        return $pdf->stream('laporan-pegawai-pdf');
    }
}
