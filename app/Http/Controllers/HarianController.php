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
        $pegawai = Pegawai::all();

        $harian = Absensi::orderBy('tanggal', 'desc')->where('periode_id', $periode->id)->whereBetween('tanggal', [$start_date, $end_date])->get();

        return view('admin.harian.index', compact('harian', 'periode', 'pegawai'));
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
        // $data->keterangankinerja = $request->keterangan;
        $data->update();

        return redirect()->back()->with('success', 'Kinerja ' . $request->nama . ' Pada ' . $request->tgl . ' Berhasil Di Input');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //show kinerja
    public function show($id, $uuid, $periode)
    {
        $data = Absensi::where('pegawai_id', $id)->where('periode_id', $periode)->orderBy('tanggal', 'Desc')->get();

        return view('admin.harian.detail', compact('data'));
    }
}
