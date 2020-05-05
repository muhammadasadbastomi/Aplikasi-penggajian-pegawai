<?php

namespace App\Http\Controllers;

use App\Gaji;
use App\Pegawai;
use App\Jabatan;
use PDF;
use Illuminate\Http\Request;

class GajiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gaji = Gaji::orderBy('id', 'Desc')->get();
        $pegawai = Pegawai::orderBy('id', 'Desc')->get();
        $jabatan = Jabatan::orderBy('id', 'Desc')->get();
        return view('admin.gaji.index', compact('gaji', 'pegawai', 'jabatan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.gaji.create');
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
            'potongan' => 'required',
            'keterangan' => 'required',
        ]);

        $jabatan = new Gaji();
        $jabatan->potongan = $request->potongan;
        $jabatan->keterangan = $request->keterangan;
        $jabatan->save();


        return redirect('admin/gaji/index')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gaji  $gaji
     * @return \Illuminate\Http\Response
     */
    public function show(Gaji $gaji)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gaji  $gaji
     * @return \Illuminate\Http\Response
     */
    public function edit(Gaji $gaji, $id)
    {
        $gaji = gaji::where('uuid', $id)->first();

        return view('admin.gaji.edit', compact('gaji'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gaji  $gaji
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gaji $gaji, $id)
    {
        // get data by id
        $gaji = gaji::where('uuid', $id)->first();
        $gaji->potongan = $request->potongan;
        $gaji->keterangan = $request->keterangan;
        $gaji->update();

        return redirect()->route('gajiIndex')->with('success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gaji  $gaji
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gaji $gaji, $id)
    {
        $gaji = gaji::where('uuid', $id)->first();

        $gaji->delete();

        return redirect()->route('gajiIndex');
    }
    public function cetak_pdf()
    {
        $gaji = Gaji::all();
        $pegawai = Pegawai::orderBy('id', 'Desc')->get();
        $pdf = PDF::loadview('laporan.cetak_gaji', compact('gaji', 'pegawai'));
        return $pdf->stream('laporan-gaji-pdf');
    }
}
