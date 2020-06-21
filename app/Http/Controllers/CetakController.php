<?php

namespace App\Http\Controllers;

use App\Pegawai;
use App\Absensi;
use App\Periode;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CetakController extends Controller
{
    public function pegawai()
    {
        $now = Carbon::now()->translatedFormat('d F Y');
        $data = Pegawai::all();

        $pdf = PDF::loadview('laporan.cetak_pegawai', compact('data', 'now'));
        return $pdf->stream('laporan-pegawai-pdf');
    }

    public function pegawaitgl(Request $request)
    {
        $start = $request->start;
        $end = $request->end;
        $now = Carbon::now()->translatedFormat('d F Y');

        $data = Pegawai::wherebetween('tgl_masuk', [$start, $end])->get();

        $pdf = PDF::loadview('laporan.cetak_pegawaitgl', compact('data', 'now', 'start', 'end'));
        return $pdf->stream('laporan-pegawai-tanggal-pdf');
    }

    public function kinerjabulan($periode_id, $periode)
    {
        $start = Carbon::parse($periode)->startOfMonth()->toDateString();
        $end = Carbon::parse($periode)->endOfMonth()->toDateString();
        $now = Carbon::now()->translatedFormat('d F Y');
        $noww = Carbon::parse($periode)->translatedFormat('F Y');
        $count_days = carbon::parse($periode)->daysInMonth;

        $data = Absensi::wherebetween('tanggal', [$start, $end])->where('tanggal', $end)->get();

        $data = $data->map(function ($item) use ($count_days) {

            $nilai = $count_days - $item->where('alfa', 1)->where('pegawai_id', $item->pegawai_id)->sum('alfa');
            $persentase1 = ($nilai * 100) / $count_days;

            $nilaiwaktu = $item->where('pegawai_id', $item->pegawai_id)->sum('waktu');
            $persentase2 = ($nilaiwaktu / $count_days);

            $nilaiinisiatif = $item->where('pegawai_id', $item->pegawai_id)->sum('inisiatif');
            $persentase3 = ($nilaiinisiatif / $count_days);

            $nilaipenyelesaian = $item->where('pegawai_id', $item->pegawai_id)->sum('penyelesaian');
            $persentase4 = ($nilaipenyelesaian / $count_days);
            $item->disiplin = ceil($persentase1);
            $item->waktu = ceil($persentase2);
            $item->inisiatif = ceil($persentase3);
            $item->penyelesaian = ceil($persentase4);

            $item['total'] = (ceil($persentase1) + ceil($persentase2) + ceil($persentase3) + ceil($persentase4)) / 4;

            // dd($item);
            return $item;
        });

        $pdf = PDF::loadview('laporan.cetak_kinerjabulan', compact('data', 'noww', 'now', 'start', 'end'));
        return $pdf->stream('laporan-kinerja-bulan-pdf');
    }

    public function gajibulan($periode_id, $periode)
    {
        $start = Carbon::parse($periode)->startOfMonth()->toDateString();
        $end = Carbon::parse($periode)->endOfMonth()->toDateString();
        $now = Carbon::now()->translatedFormat('d F Y');
        $noww = Carbon::parse($periode)->translatedFormat('F Y');
        $count_days = carbon::parse($periode)->daysInMonth;

        $data = Absensi::wherebetween('tanggal', [$start, $end])->where('tanggal', $end)->get();

        $data = $data->map(function ($item) use ($count_days, $start, $end) {

            $nilai = $count_days - $item->where('alfa', 1)->where('pegawai_id', $item->pegawai_id)->sum('alfa');
            $persentase1 = ($nilai * 100) / $count_days;

            $nilaiwaktu = $item->where('pegawai_id', $item->pegawai_id)->sum('waktu');
            $persentase2 = ($nilaiwaktu / $count_days);

            $nilaiinisiatif = $item->where('pegawai_id', $item->pegawai_id)->sum('inisiatif');
            $persentase3 = ($nilaiinisiatif / $count_days);

            $nilaipenyelesaian = $item->where('pegawai_id', $item->pegawai_id)->sum('penyelesaian');
            $persentase4 = ($nilaipenyelesaian / $count_days);
            $item->disiplin = ceil($persentase1);
            $item->waktu = ceil($persentase2);
            $item->inisiatif = ceil($persentase3);
            $item->penyelesaian = ceil($persentase4);

            $item['total'] = (ceil($persentase1) + ceil($persentase2) + ceil($persentase3) + ceil($persentase4)) / 4;

            // dd($item);
            return $item;
        });


        $pdf = PDF::loadview('laporan.cetak_gajibulan', compact('data', 'noww', 'now', 'start', 'end'));
        return $pdf->stream('laporan-gaji-bulan-pdf');
    }

    public function slipgaji($uuid, $id, $tgl, $pegawai_id)
    {
        $now = Carbon::now()->translatedFormat('d F Y');
        $noww = Carbon::now()->translatedFormat('F Y');
        $end =  Carbon::parse($tgl)->endOfMonth()->toDateString();
        $start =  Carbon::parse($tgl)->startOfMonth()->toDateString();
        $data = Absensi::where('periode_id', $id)->where('pegawai_id', $pegawai_id)->where('tanggal', $end)->get();
        $count_days = carbon::parse($tgl)->daysInMonth;

        $data = $data->map(function ($item) use ($count_days) {

            $nilai = $count_days - $item->where('alfa', 1)->where('pegawai_id', $item->pegawai_id)->sum('alfa');
            $persentase1 = ($nilai * 100) / $count_days;

            $nilaiwaktu = $item->where('pegawai_id', $item->pegawai_id)->sum('waktu');
            $persentase2 = ($nilaiwaktu / $count_days);

            $nilaiinisiatif = $item->where('pegawai_id', $item->pegawai_id)->sum('inisiatif');
            $persentase3 = ($nilaiinisiatif / $count_days);

            $nilaipenyelesaian = $item->where('pegawai_id', $item->pegawai_id)->sum('penyelesaian');
            $persentase4 = ($nilaipenyelesaian / $count_days);
            $item->disiplin = ceil($persentase1);
            $item->waktu = ceil($persentase2);
            $item->inisiatif = ceil($persentase3);
            $item->penyelesaian = ceil($persentase4);

            $item['total'] = (ceil($persentase1) + ceil($persentase2) + ceil($persentase3) + ceil($persentase4)) / 4;

            // dd($item);
            return $item;
        });

        $pdf = PDF::loadview('laporan.cetak_slipgaji', compact('data', 'now', 'start', 'end'))->setPaper('a4', 'landscape');;
        return $pdf->stream('laporan-slipgaji-pdf');
    }
}
