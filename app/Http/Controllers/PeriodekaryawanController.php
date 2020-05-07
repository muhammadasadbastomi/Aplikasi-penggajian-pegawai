<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gajiperiode;
use App\Gaji;
use App\Pegawai;
use App\Jabatan;

class PeriodekaryawanController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexgaji()
    {
        $gaji = Gaji::orderBy('id', 'Desc')->get();

        return view('admin.gaji.gajikaryawan.index', compact('gaji'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexperiode()
    {
        $periode = Gajiperiode::orderBy('id', 'Desc')->get();

        return view('admin.gaji.periodekaryawan.index', compact('periode'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.gaji.periodekaryawan.create');
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
            'periode' => 'required',
            'keterangan' => 'required',
        ]);

        $periode = new Gajiperiode();
        $periode->periode = $request->periode;
        $periode->keterangan = $request->keterangan;
        $periode->save();


        return redirect('admin/gaji/periodekaryawan/index')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $periode = Gajiperiode::where('uuid', $id)->first();
        $periode1 = Gajiperiode::where('uuid', $id)->get();
        $jabatan = Jabatan::orderBy('id', 'Desc')->get();
        $pegawai = Pegawai::where('status', 'aktif')->get();
        $gaji = Gaji::where('periode_id', $periode->id)->get();

        if ($gaji->count() == 0) {
            $total = 0;
        } else {

            foreach ($gaji as $data) {

                $total = $data->pegawai->jabatan->gaji_pokok + $data->pegawai->jabatan->tunjangan;
            }
        }
        $gaji = $gaji->map(function ($item) use ($total) {
            $item['total'] = $total;
            // dd($item);
            return $item;
        });


        return view('admin.gaji.periodekaryawan.show', compact('gaji', 'periode', 'pegawai', 'item', 'periode1'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tambah($id)
    {
        $pegawai = Pegawai::where('status', 'aktif')->get();
        return view('admin/gaji/periodekaryawan/tambah', compact('pegawai', 'periode'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function stambah(Request $request, $id)
    {
        $request->validate([
            'pegawai' => 'required',
            'keterangan' => 'required',
        ]);
        $periode = Gajiperiode::where('uuid', $id)->first();
        $gaji = new gaji;

        $gaji->pegawai_id = $request->pegawai;
        $gaji->periode_id = $periode->id;
        $gaji->keterangan = $request->keterangan;
        $gaji->save();

        return redirect('admin/gaji/periodekaryawan/show/' . $id . '')->with('success', 'Data berhasil disimpan');
    }

    public function stambahaktif($id)
    {
        $periode = Gajiperiode::where('uuid', $id)->first();
        $pegawai = Pegawai::where('status', 'aktif')->get();
        $gaji = new gaji;
        $gaji->pegawai_id = $pegawai->id;
        $gaji->periode_id = $periode->id;
        $gaji->save();

        return redirect('admin/gaji/periodekaryawan/show/' . $id . '')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $periode = Gajiperiode::where('uuid', $id)->first();

        $periode->delete();

        return redirect()->route('periodekaryawanIndex');
    }
}
