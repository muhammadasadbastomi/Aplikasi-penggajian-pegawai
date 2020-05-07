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
        $cek_periode = Periode::orderBy('created_at', 'desc')->first();
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

            $absensi = Absensi::where('periode_id', $cek_periode->id)->where('pegawai_id', $id)->first();
            // dd($absensi);

            if (isset($absensi)) {
                $cek_absensi = carbon::parse($absensi->created_at)->format('d');
                $day = carbon::now()->format('d');

                if ($cek_absensi == $day) {
                    $keterangan = 'Anda sudah melakukan absensi';
                } else {
                    $keterangan = 'Anda belum melakukan absensi';
                }
            } else {
                $keterangan = 'Anda belum melakukan absensi';
            }

            return view('admin.index', compact('cek', 'keterangan'));
        } else {

            return view('admin.index', compact('cek'));
        }
    }

    // bpk data view
    public function bpkIndex()
    {
        return view('admin.bpk.index');
    }
}
