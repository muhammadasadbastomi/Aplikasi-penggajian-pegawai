<?php

namespace App\Http\Controllers;

use Alert;
use App\jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $jabatan = jabatan::orderBy('id', 'Desc')->get();

        return view('admin.jabatan.index', compact('jabatan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.jabatan.create');
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
            'jabatan' => 'required',
            'gaji_pokok' => 'required',
            'tunjangan' => 'required'
        ]);

        // create new object
        $jabatan = new jabatan;
        $jabatan->jabatan = $request->jabatan;
        $jabatan->gaji_pokok = $request->gaji_pokok;
        $jabatan->tunjangan = $request->tunjangan;
        $jabatan->save();

        return redirect('admin/jabatan/index')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get jabatan by id
        // $jabatan = jabatan::where('uuid', $id)->first();
        // $total_members = $jabatan->members()->count();
        // $members = Member::where('jabatan_id',$jabatan->id)->get();
        // dd($members);

        return view('admin.jabatan.show', compact('jabatan', 'total_members', 'members'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // get jabatan by id
        $jabatan = jabatan::where('uuid', $id)->first();

        return view('admin.jabatan.edit', compact('jabatan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'jabatan' => 'required',
            'gaji_pokok' => 'required',
            'tunjangan' => 'required'
        ]);

        // get data by id
        $jabatan = jabatan::where('uuid', $id)->first();
        $jabatan->jabatan = $request->jabatan;
        $jabatan->gaji_pokok = $request->gaji_pokok;
        $jabatan->tunjangan = $request->tunjangan;
        $jabatan->update();

        return redirect()->route('jabatanIndex')->with('success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jabatan = jabatan::where('uuid', $id)->first();

        $jabatan->delete();

        return redirect()->route('jabatanIndex');
    }
}
