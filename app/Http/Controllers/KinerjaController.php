<?php

namespace App\Http\Controllers;

use App\kinerja;
use App\Gajiperiode;
use App\Pegawai;
use Illuminate\Http\Request;

class KinerjaController extends Controller
{

    public function periode()
    {
        $data = Gajiperiode::orderBy('id', 'Desc')->get();

        return view('admin/kinerja/periode/index', compact('data'));
    }

    public function tambah(Request $request)
    {
        $messages = [
            'unique' => ':attribute sudah ada.',
            'required' => ':attribute harus diisi.'
        ];
        //dd($request->all());
        $request->validate([
            'periode' => 'required|unique:gajiperiodes'
        ], $messages);

        $data = new Gajiperiode();
        $data->periode = $request->periode;
        $data->keterangan = $request->keterangan;
        $data->save();


        return redirect('admin/kinerja/periode/index')->with('success', 'Data berhasil disimpan');
    }

    public function ubah($id)
    {
        $periode = Gajiperiode::where('uuid', $id)->first();
        return view('admin/kinerja/periode/edit', compact('periode'));
    }

    public function ubahp(Request $request, $id)
    {
        $messages = [
            'required' => ':attribute harus diisi.'
        ];
        //dd($request->all());
        $request->validate([
            'periode' => 'required'
        ], $messages);

        // get data by id
        $periode = Gajiperiode::where('uuid', $id)->first();
        $periode->periode = $request->periode;
        $periode->keterangan = $request->keterangan;
        $periode->update();

        return redirect()->route('kinerjaperiodeIndex')->with('success', 'Data Berhasil Diubah');
    }

    public function hapus($id)
    {
        $data = Gajiperiode::where('uuid', $id)->first();

        $data->delete();

        return redirect()->route('kinerjaperiodeIndex');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

        $periode = Gajiperiode::where('uuid', $id)->first();
        $data = kinerja::orderBy('id', 'Desc')->where('gajiperiode_id', $periode->id)->get();
        $karyawan = Pegawai::orderBy('id', 'Desc')->get();

        $data = $data->map(function ($item) {
            $item['total'] = $item->waktu + $item->inisiatif + $item->penyelesaian;
            // dd($item);
            return $item;
        });

        // dd($data);

        return view('admin.kinerja.index', compact('data', 'karyawan', 'periode', 'total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {

        $periode = Gajiperiode::where('uuid', $id)->first();

        //dd($request->all());
        $request->validate([
            'karyawan' => 'unique:kinerjas,pegawai_id,null,id,gajiperiode_id,' . $request->gajiperiode_id . ''
        ]);



        $data = new Kinerja;
        $data->pegawai_id = $request->karyawan;
        $data->gajiperiode_id = $periode->id;
        $data->waktu = $request->waktu;
        $data->penyelesaian = $request->penyelesaian;
        $data->inisiatif = $request->inisiatif;
        $data->keterangan = $request->keterangan;
        $data->save();

        return redirect('admin/kinerja/index/' . $id . '')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\kinerja  $kinerja
     * @return \Illuminate\Http\Response
     */
    public function show(kinerja $kinerja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\kinerja  $kinerja
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     $data = kinerja::where('uuid', $id)->first();
    //     return view('admin/kinerja/edit', compact('data'));
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\kinerja  $kinerja
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // get data by id
        $data = Kinerja::findOrFail($request->id);
        // $data->disiplin = $request->disiplin;
        $data->waktu = $request->waktu;
        $data->penyelesaian = $request->penyelesaian;
        $data->inisiatif = $request->inisiatif;
        $data->keterangan = $request->keterangan;
        $data->update();

        return back()->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\kinerja  $kinerja
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Kinerja::where('uuid', $id)->first();

        $data->delete();

        return back();
    }
}
