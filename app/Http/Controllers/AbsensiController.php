<?php

namespace App\Http\Controllers;

use App\Absensi;
use App\Pegawai;
use App\Periode;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $periode = Periode::where('uuid', $id)->first();
        $pegawai = Pegawai::orderBy('id', 'Desc')->get();
        $absensi = Absensi::orderBy('id', 'Desc')->get();

        return view('admin.absensi.index', compact('absensi', 'pegawai', 'periode'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    public function hadir()
    {
        $id = Auth::user()->pegawai->id;
        $now = Carbon::now()->format('m');
        $day = Carbon::now()->format('d');
        $periode = Periode::orderBy('created_at', 'desc')->first();
        $month = carbon::parse($periode->periode)->format('m');

        $absensi = Absensi::where('periode_id', $periode->id)->where('pegawai_id', $id)->first();
        // dd($absensi);
        if (!$absensi) {
            if ($now == $month) {
                $absensi = new Absensi;
                $absensi->pegawai_id = $id;
                $absensi->periode_id = $periode->id;
                $absensi->hadir = 1;
                $absensi->save();
                return redirect()->route('adminIndex')->with('success', 'Berhasil absen hari ini, silahkan tunggu verifikasi admin');

            } else {
                return redirect()->route('adminIndex')->with('warning', 'Periode belum dibuat');
            }

        } else {
            $cek_absensi = carbon::parse($absensi->created_at)->format('d');
            if ($now == $month && $cek_absensi != $day) {
                $absensi = new Absensi;
                $absensi->pegawai_id = $id;
                $absensi->periode_id = $periode->id;
                $absensi->hadir = 1;
                $absensi->save();

                return redirect()->route('adminIndex')->with('success', 'Berhasil absen hari ini, silahkan tunggu verifikasi admin');
            } elseif ($now == $month && $cek_absensi == $day) {
                return redirect()->route('adminIndex')->with('warning', 'Anda sudah melakukan absensi');

            } elseif ($month != $now) {
                return redirect()->route('adminIndex')->with('warning', 'Periode belum dibuat');
            }

        }

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
            'periode' => 'required',
        ]);

        // create new object
        $absensi = new absensi;
        $absensi->pegawai_id = $request->pegawai_id;
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
        $pegawai = \App\Pegawai::orderBy('id', 'asc')->get();
        $absensi = absensi::where('uuid', $id)->first();

        return view('admin.absensi.edit', compact('absensi', 'pegawai'));
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
            'periode' => 'required',
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
    public function cetak_pdf()
    {
        $absensi = Absensi::all();
        $pegawai = Pegawai::orderBy('id', 'Desc')->get();
        $pdf = PDF::loadview('laporan.cetak_absensi', compact('absensi', 'pegawai'));
        return $pdf->stream('laporan-absensi-pdf');
    }
}
