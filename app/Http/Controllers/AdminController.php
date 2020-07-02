<?php

namespace App\Http\Controllers;

use App\Absensi;
use App\Periode;
use Auth;
use Carbon\Carbon;

class AdminController extends Controller
{
    // admin dashboard
    public function index()
    {
        $cek_periode = Periode::orderBy('periode', 'desc')->first();
        if (isset($cek_periode)) {
            $month = carbon::parse($cek_periode->periode)->format('m');
            $now = carbon::now()->format('m');

            if (Auth::user()->role == 'pegawai') {
                if ($month == $now) {
                    $cek = 1;
                } else {
                    $cek = 0;
                }
            } else {
                $cek = 2;
            }

            if (Auth::user()->role == 'pegawai') {
                $id = Auth::user()->pegawai->id;
                $dateNow = Carbon::now()->format('Y-m-d');
                $absensi = Absensi::where('periode_id', $cek_periode->id)->where('pegawai_id', $id)->where('tanggal', $dateNow)->first();
                // dd($absensi);

                if (isset($absensi)) {
                    $cek_absensi = carbon::parse($absensi->tanggal)->format('d');
                    // dd($cek_absensi);
                    // dd($cek_periode);
                    $day = carbon::now()->format('d');

                    if ($cek_absensi == $day) {
                        if (
                            $absensi->hadir == 1 && $absensi->status == 3
                            || $absensi->izin == 1 && $absensi->status == 3
                            || $absensi->sakit == 1 && $absensi->status == 3
                        ) {
                            $kinerja = 0;
                            $keterangan = 'Menunggu konfirmasi admin.';
                        } elseif (
                            $absensi->hadir == 3 && $absensi->status == 3
                            || $absensi->izin == 3 && $absensi->status == 3
                            || $absensi->sakit == 3 && $absensi->status == 3
                        ) {
                            $kinerja = 0;
                            $keterangan = 'Anda belum melakukan absensi';
                        } elseif ($absensi->hadir == 1 && $absensi->status == 1) {
                            $keterangan = 'Anda sudah melakukan absensi.';
                            if ($absensi->waktu == null) {
                                $kinerja = 1;
                                $keterangankinerja = 'Silahkan memasukkan nilai kinerja hari ini.';
                            } else {
                                $kinerja = 2;
                                $keterangankinerja = 'Anda sudah memasukkan kinerja.';
                            }
                        } else {
                            $kinerja = 0;
                            $keterangan = 'Anda belum melakukan absensi.';
                        }
                    }
                    return view('admin.index', compact('cek', 'keterangan', 'absensi', 'kinerja', 'keterangankinerja'));
                }
            } else {
                return view('admin.index', compact('cek'));
            }
        }
        $cek = 2;
        $keterangan = 'periode belum dibuat';
        $kinerja = '2';
        $absensi = null;
        return view('admin.index', compact('cek', 'keterangan', 'absensi', 'kinerja', 'keterangankinerja'));
    }
}
