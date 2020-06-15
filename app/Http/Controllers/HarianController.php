<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Periode;
use App\Absensi;
use App\Pegawai;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HarianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $periode = Periode::where('uuid', $id)->first();
        $start_date = Carbon::now()->subDays(7)->format('Y-m-d');
        $end_date = Carbon::now()->format('Y-m-d');

        $harian = Absensi::orderBy('tanggal', 'desc')->where('periode_id', $periode->id)->whereBetween('tanggal', [$start_date, $end_date])->get();

        return view('admin.harian.index', compact('harian', 'periode'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = Absensi::where('uuid', $request->uuid)->first();
        $data->waktu = $request->waktu;
        $data->inisiatif = $request->inisiatif;
        $data->penyelesaian = $request->penyelesaian;
        $data->keterangankinerja = $request->keterangan;
        $data->update();

        return redirect()->back()->with('success', 'Kinerja ' . $request->nama . ' Pada Tanggal ' . $request->tgl . ' Berhasil Di Input');
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
     * @param  \App\Harian  $harian
     * @return \Illuminate\Http\Response
     */
    public function show(Harian $harian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Harian  $harian
     * @return \Illuminate\Http\Response
     */
    public function edit(Harian $harian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Harian  $harian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Harian $harian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Harian  $harian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Harian $harian)
    {
        //
    }
}
