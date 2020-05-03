<?php

namespace App\Http\Controllers;

Use Alert;
use App\golongan;
use Illuminate\Http\Request;

class GolonganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        // $golongan = golongan::orderBy('id', 'Desc')->get();
        
        // return view('admin.golongan.index',compact('golongan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.golongan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // create new object
        $golongan = new golongan;

        $golongan->name     = $request->name;
        $golongan->date_est = $request->date_est;
        $golongan->address  = $request->address;
        $golongan->save();
        
        
        return redirect('admin/golongan/index')->with('success', 'Data berhasil disimpan');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\golongan  $golongan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get golongan by id
        $golongan = golongan::where('uuid', $id)->first();

        return view('admin.golongan.show',compact('golongan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\golongan  $golongan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // get golongan by id
        $golongan = golongan::where('uuid', $id)->first();
        
        return view('admin.golongan.edit',compact('golongan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\golongan  $golongan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // get data by id
        $golongan = golongan::where('uuid', $id)->first();

        $golongan->name     = $request->name;
        $golongan->date_est = $request->date_est;
        $golongan->address  = $request->address;
        $golongan->update();
        
        return redirect()->route('golonganIndex')->with('success','Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\golongan  $golongan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $golongan = golongan::where('uuid', $id)->first();
    
        $golongan->delete();

        return redirect()->route('golonganIndex');
    }
}
