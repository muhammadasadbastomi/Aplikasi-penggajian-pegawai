<?php

namespace App\Http\Controllers;

use App\Absensi;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $absensi = Absensi::orderBy('id', 'Desc')->get();

        return view('admin.absensi.index', compact('absensi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.absensi.create');
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
            'izin' => 'required',
            'sakit' => 'required',
            'alfa' => 'required',
            'hadir' => 'required',
            'periode' => 'required'
        ]);

        // create new object
        $absensi = new absensi;
        $absensi->izin = $request->izin;
        $absensi->sakit = $request->sakit;
        $absensi->alfa = $request->alfa;
        $absensi->hadir = $request->hadir;
        $absensi->periode = $request->periode;
        $absensi->save();

        return redirect('admin/absensi/index')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function show(Absensi $absensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function edit(Absensi $absensi, $id)
    {
        $absensi = absensi::where('uuid', $id)->first();

        return view('admin.absensi.edit', compact('absensi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Absensi $absensi, $id)
    {
        $request->validate([
            'izin' => 'required',
            'sakit' => 'required',
            'alfa' => 'required',
            'hadir' => 'required',
            'periode' => 'required'
        ]);

        // get data by id
        $absensi = absensi::where('uuid', $id)->first();
        $absensi->izin = $request->izin;
        $absensi->sakit = $request->sakit;
        $absensi->alfa = $request->alfa;
        $absensi->hadir = $request->hadir;
        $absensi->periode = $request->periode;
        $absensi->update();

        return redirect()->route('absensiIndex')->with('success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Absensi $absensi, $id)
    {
        $absensi = absensi::where('uuid', $id)->first();

        $absensi->delete();

        return redirect()->route('absensiIndex');
    }
}
