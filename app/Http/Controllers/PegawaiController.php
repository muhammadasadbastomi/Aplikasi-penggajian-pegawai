<?php

namespace App\Http\Controllers;

use App\Pegawai;
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

        return view('admin.pegawai.index', ['pegawai' => $pegawai]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        //dd($request->all());
        $request->validate([
            'nik' => 'required',
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'tgl_masuk' => 'required'
        ]);

        //insert ke table users
        $user = new \App\User;
        $user->role = 'pegawai';
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->password = bcrypt('admin123');
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
        $pegawai = pegawai::where('uuid', $id)->first();

        return view('admin.pegawai.edit', compact('pegawai'));
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
        $pegawai->nik = $request->nik;
        $pegawai->nama = $request->nama;
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

        $pegawai->delete();

        return redirect()->route('pegawaiIndex');
    }
}
