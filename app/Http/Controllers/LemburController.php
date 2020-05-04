<?php

namespace App\Http\Controllers;

use App\lembur;
use Illuminate\Http\Request;

class LemburController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lembur = Lembur::orderBy('id', 'Desc')->get();

        return view('admin.lembur.index', compact('lembur'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.lembur.create');
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
            'jumlah' => 'required'
        ]);

        // create new object
        $lembur = new Lembur;
        $lembur->jumlah = $request->jumlah;
        $lembur->save();

        return redirect('admin/lembur/index')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\lembur  $lembur
     * @return \Illuminate\Http\Response
     */
    public function show(lembur $lembur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\lembur  $lembur
     * @return \Illuminate\Http\Response
     */
    public function edit(lembur $lembur, $id)
    {
        // get by id
        $lembur = lembur::where('uuid', $id)->first();

        return view('admin.lembur.edit', compact('lembur'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\lembur  $lembur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, lembur $lembur, $id)
    {
        $request->validate([
            'jumlah' => 'required',
        ]);

        // get data by id
        $lembur = Lembur::where('uuid', $id)->first();
        $lembur->jumlah = $request->jumlah;
        $lembur->update();

        return redirect()->route('lemburIndex')->with('success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\lembur  $lembur
     * @return \Illuminate\Http\Response
     */
    public function destroy(lembur $lembur, $id)
    {
        $lembur = Lembur::where('uuid', $id)->first();

        $lembur->delete();

        return redirect()->route('lemburIndex');
    }
}
