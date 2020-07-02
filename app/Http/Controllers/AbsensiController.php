<?php

namespace App\Http\Controllers;

use App\Absensi;
use App\Pegawai;
use App\Periode;
use App\Kinerja;
use Illuminate\Support\Facades\Auth;
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
        $pegawai = Pegawai::all();
        $periode = Periode::where('uuid', $id)->first();
        $start_date = Carbon::now()->subDays(7)->format('Y-m-d');
        $end_date = Carbon::now()->format('Y-m-d');

        $absensi = Absensi::orderBy('tanggal', 'desc')->where('periode_id', $periode->id)->whereBetween('tanggal', [$start_date, $end_date])->get();

        return view('admin.absensi.index', compact('absensi', 'periode', 'pegawai'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function kinerjaindex(Request $request)
    {
        $periode = Periode::orderBy('periode', 'desc')->first();
        $id = Auth::user()->pegawai->id;
        $dateNow = Carbon::now()->format('Y-m-d');
        $data = Absensi::where('periode_id', $periode->id)->where('pegawai_id', $id)->where('tanggal', $dateNow)->first();

        $data->waktu = $request->waktu;
        $data->penyelesaian = $request->penyelesaian;
        $data->inisiatif = $request->inisiatif;
        $data->keterangankinerja = $request->keterangankinerja;
        $data->update();

        // $absensi = Absensi::orderBy('tanggal', 'desc')->where('periode_id', $periode->id)->whereBetween('tanggal', [$start_date, $end_date])->get();

        return back()->withSuccess('Hasil kinerja hari ini berhasil tersimpan');
        // return view('admin.absensi.index', compact('absensi', 'periode', 'pegawai'));
    }

    public function verifikasi($id)
    {
        $absensi = Absensi::where('uuid', $id)->first();
        $absensi->status = 1;
        $absensi->update();

        return redirect()->back()->with('success', 'Berhasil verifikasi');
    }

    public function hadir()
    {
        $id = Auth::user()->pegawai->id;
        $now = Carbon::now()->format('m');
        $dateNow = Carbon::now()->format('Y-m-d');
        $periode = Periode::orderBy('created_at', 'desc')->first();
        $month = carbon::parse($periode->periode)->format('m');

        if ($now == $month) {
            $absensi = Absensi::where('tanggal', $dateNow)->where('pegawai_id', $id)->first();
            if (
                $absensi->hadir == 1
                || $absensi->izin == 1
                || $absensi->sakit == 1
            ) {
                return redirect()->route('adminIndex')->with('warning', 'Anda sudah melakukan absen hari ini');
            } else {
                $absensi->hadir = 1;
                $absensi->update();
                return redirect()->route('adminIndex')->with('success', 'Berhasil absen hari ini, silahkan tunggu verifikasi admin');
            }
        }
    }

    public function izin()
    {
        $id = Auth::user()->pegawai->id;
        $dateNow = Carbon::now()->format('Y-m-d');

        $absensi = Absensi::where('tanggal', $dateNow)->where('pegawai_id', $id)->first();

        if (
            $absensi->hadir == 1
            || $absensi->izin == 1
            || $absensi->sakit == 1
        ) {
            return redirect()->route('adminIndex')->with('warning', 'Anda sudah melakukan absen hari ini');
        } elseif ($absensi->alfa == 1) {
            return redirect()->route('adminIndex')->with('warning', 'Anda sudah telat melakukan absen hari ini');
        } else {
            $keterangan = 'Izin';
            return view('admin.absensi.edit', compact('absensi', 'keterangan'));
        }
    }

    public function izinStore(Request $request)
    {
        $id = Auth::user()->pegawai->id;
        $dateNow = Carbon::now()->format('Y-m-d');

        $absensi = Absensi::where('tanggal', $dateNow)->where('pegawai_id', $id)->first();

        $absensi->izin = 1;
        $absensi->keterangan = $request->keterangan;

        $absensi->update();

        return redirect()->route('adminIndex')->with('success', 'Berhasil absen hari ini, silahkan tunggu verifikasi admin');
    }

    public function sakit()
    {
        $id = Auth::user()->pegawai->id;
        $dateNow = Carbon::now()->format('Y-m-d');

        $absensi = Absensi::where('tanggal', $dateNow)->where('pegawai_id', $id)->first();
        if (
            $absensi->hadir == 1
            || $absensi->izin == 1
            || $absensi->sakit == 1
        ) {
            return redirect()->route('adminIndex')->with('warning', 'Anda sudah melakukan absen hari ini');
        } elseif ($absensi->alfa == 1) {
            return redirect()->route('adminIndex')->with('warning', 'Anda sudah telat melakukan absen hari ini');
        } else {
            $keterangan = 'Sakit';
            return view('admin.absensi.edit', compact('absensi', 'keterangan'));
        }
    }

    public function sakitStore(Request $request)
    {
        $id = Auth::user()->pegawai->id;
        $dateNow = Carbon::now()->format('Y-m-d');

        $absensi = Absensi::where('tanggal', $dateNow)->where('pegawai_id', $id)->first();

        $absensi->sakit = 1;
        $absensi->keterangan = $request->keterangan;

        $absensi->update();

        return redirect()->route('adminIndex')->with('success', 'Berhasil absen hari ini, silahkan tunggu verifikasi admin');
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
    public function update(Request $request, $id)
    {

        // get data by id
        $absensi = absensi::where('uuid', $id)->first();
        // dd($absensi);
        if (isset($request->absensi)) {
            if ($request->absensi == 1) {
                $absensi->hadir = 1;
            } elseif ($request->absensi == 2) {
                $absensi->izin = 1;
            } elseif ($request->absensi == 3) {
                $absensi->sakit = 1;
            } elseif ($request->absensi == 4) {
                $absensi->alfa = 1;
            }
            if (isset($request->keterangan)) {
                $absensi->keterangan = $request->keterangan;
            }

            $absensi->status = 1;
        }
        $absensi->update();

        return redirect()->route('absensiIndex', ['id' => $absensi->periode->uuid])->with('success', 'Data Berhasil Diubah');
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
