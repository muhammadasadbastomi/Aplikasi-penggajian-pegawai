<?php

namespace App\Http\Controllers;

use App\Absensi;
use App\Periode;
use Carbon\Carbon;

class KinerjaController extends Controller
{
    public function kinerjaindex($id)
    {
        $periode = Periode::where('uuid', $id)->first();
        $end =  Carbon::parse($periode->periode)->endOfMonth()->toDateString();
        $count_days = carbon::parse($periode->periode)->daysInMonth;
        $data = Absensi::orderBy('id', 'desc')->where('periode_id', $periode->id)->where('tanggal', $end)->get();

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

            return $item;
        });

        return view('admin.kinerja.index', compact('data', 'periode'));
    }



    public function gajiindex($id)
    {
        $periode = periode::where('uuid', $id)->first();
        $end =  Carbon::parse($periode->periode)->endOfMonth()->toDateString();
        $data = Absensi::orderBy('id', 'Desc')->where('periode_id', $periode->id)->where('tanggal', $end)->get();
        $count_days = carbon::parse($periode->periode)->daysInMonth;


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

            return $item;
        });

        return view('admin.kinerja.gaji.index', compact('periode', 'data'));
    }
}
