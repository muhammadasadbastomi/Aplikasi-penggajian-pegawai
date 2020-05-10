<?php

namespace App\Http\Controllers;

use App\Absensi;
use App\Pegawai;
use App\Periode;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    public function index()
    {
        $periode = Periode::orderBy('id', 'desc')->get();

        return view('admin.periode.index', compact('periode'));
    }

    public function create()
    {
        return view('admin.periode.create');
    }

    public function store(Request $request)
    {
        $nextMonth = carbon::now()->addMonth()->translatedFormat('F Y');
        $nowMonth = carbon::now()->translatedFormat('F Y');
        $now = carbon::now()->format('mY');
        $pegawai = Pegawai::where('status', 'aktif')->get();
        $count_days = carbon::parse($request->periode)->daysInMonth;
        $periode = Periode::orderBy('id', 'desc')->first();

        // if (carbon::parse($request->periode)->format('m') < $now) {
        //     return redirect()->route('periodeIndex')->with('warning', 'Periode Harus Setelah Bulan ' . $month . '');

        // } elseif (carbon::parse($request->periode)->format('m') == $now) {
        //     return redirect()->route('periodeIndex')->with('warning', 'Periode Bulan ' . $month . ' Sudah Dibuat');

        // } else {
        //}
        if (isset($periode)) {

            if (carbon::parse($request->periode)->format('mY') > $now) {
                return redirect()->route('periodeIndex')->with('warning', 'Periode Harus Sebelum Bulan ' . $nextMonth . '');
            } elseif (carbon::parse($periode->periode)->format('mY') == $now) {
                return redirect()->route('periodeIndex')->with('warning', 'Periode Bulan ' . $nowMonth . ' Sudah Dibuat');
            } else {
                $tahun = carbon::parse($request->periode)->format('Y');
                $bulan = carbon::parse($request->periode)->format('m');

                $periode = new Periode;

                $periode->periode = $request->periode;
                $periode->save();
                foreach ($pegawai as $d) {
                    for ($i = 1; $i < $count_days; $i++) {
                        $absensi = new Absensi;
                        $absensi->periode_id = $periode->id;
                        $absensi->pegawai_id = $d->id;
                        $absensi->hadir = 3;
                        $absensi->izin = 3;
                        $absensi->sakit = 3;
                        $absensi->alfa = 3;
                        $absensi->status = 3;
                        if ($i < 10) {
                            $absensi->tanggal = $tahun . '-' . $bulan . '-0' . $i;
                        } else {
                            $absensi->tanggal = $tahun . '-' . $bulan . '-' . $i;
                        }

                        $absensi->save();
                    }
                }
                return redirect()->route('periodeIndex')->with('success', 'Data berhasil disimpan');

            }
        }
        $tahun = carbon::parse($request->periode)->format('Y');
        $bulan = carbon::parse($request->periode)->format('m');

        $periode = new Periode;

        $periode->periode = $request->periode;
        $periode->save();
        foreach ($pegawai as $d) {
            for ($i = 1; $i <= $count_days; $i++) {
                $absensi = new Absensi;
                $absensi->periode_id = $periode->id;
                $absensi->pegawai_id = $d->id;
                $absensi->hadir = 3;
                $absensi->izin = 3;
                $absensi->sakit = 3;
                $absensi->alfa = 3;
                $absensi->status = 3;
                if ($i < 10) {
                    $absensi->tanggal = $tahun . '-' . $bulan . '-0' . $i;
                } else {
                    $absensi->tanggal = $tahun . '-' . $bulan . '-' . $i;
                }

                $absensi->save();
            }
        }
        return redirect()->route('periodeIndex')->with('success', 'Data berhasil disimpan');

    }

    public function destroy($id)
    {
        $periode = Periode::where('uuid', $id)->first();
        $absensi = Absensi::where('periode_id', $periode->id)->delete();
        $periode->delete();

        return redirect()->route('periodeIndex');

    }
}
