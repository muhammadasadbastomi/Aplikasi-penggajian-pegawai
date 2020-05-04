<?php

namespace App\Http\Controllers;

use App\rincian;
use Illuminate\Http\Request;

class RincianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rincian = rincian::orderBy('id', 'Desc')->get();

        return view('admin.rincian.index', compact('rincian'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.rincian.create');
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

        $rincian = new Rincian();
        $rincian->potongan = $request->potongan;
        $rincian->keterangan = $request->keterangan;
        $rincian->save();


        return redirect('admin/rincian/index')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\rincian  $rincian
     * @return \Illuminate\Http\Response
     */
    public function show(rincian $rincian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\rincian  $rincian
     * @return \Illuminate\Http\Response
     */
    public function edit(rincian $rincian, $id)
    {
        $rincian = rincian::where('uuid', $id)->first();

        return view('admin.rincian.edit', compact('rincian'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\rincian  $rincian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, rincian $rincian, $id)
    {
        // get data by id
        $rincian = Rincian::where('uuid', $id)->first();
        $rincian->potongan = $request->potongan;
        $rincian->keterangan = $request->keterangan;
        $rincian->update();

        return redirect()->route('rincianIndex')->with('success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\rincian  $rincian
     * @return \Illuminate\Http\Response
     */
    public function destroy(rincian $rincian, $id)
    {
        $rincian = Rincian::where('uuid', $id)->first();

        $rincian->delete();

        return redirect()->route('rincianIndex');
    }
}
