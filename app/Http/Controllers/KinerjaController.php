<?php

namespace App\Http\Controllers;

use App\Absensi;
use App\Disiplin_detail;
use App\Gajiperiode;
use App\kinerja;
use App\Pegawai;
use App\Periode;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KinerjaController extends Controller
{

    // public function periode()
    // {
    //     $data = Gajiperiode::orderBy('id', 'Desc')->get();

    //     return view('admin/kinerja/periode/index', compact('data'));
    // }

    // public function tambah(Request $request)
    // {
    //     $messages = [
    //         'unique' => ':attribute sudah ada.',
    //         'required' => ':attribute harus diisi.',
    //     ];
    //     //dd($request->all());
    //     $request->validate([
    //         'periode' => 'required|unique:gajiperiodes',
    //     ], $messages);

    //     $data = new Gajiperiode();
    //     $data->periode = $request->periode;
    //     $data->keterangan = $request->keterangan;
    //     $data->save();

    //     return redirect('admin/kinerja/periode/index')->with('success', 'Data berhasil disimpan');
    // }

    // public function ubah($id)
    // {
    //     $periode = Gajiperiode::where('uuid', $id)->first();
    //     return view('admin/kinerja/periode/edit', compact('periode'));
    // }

    // public function ubahp(Request $request, $id)
    // {
    //     $messages = [
    //         'required' => ':attribute harus diisi.',
    //     ];
    //     //dd($request->all());
    //     $request->validate([
    //         'periode' => 'required',
    //     ], $messages);

    //     // get data by id
    //     $periode = Gajiperiode::where('uuid', $id)->first();
    //     $periode->periode = $request->periode;
    //     $periode->keterangan = $request->keterangan;
    //     $periode->update();

    //     return redirect()->route('kinerjaperiodeIndex')->with('success', 'Data Berhasil Diubah');
    // }

    // public function hapus($id)
    // {
    //     $data = Gajiperiode::where('uuid', $id)->first();

    //     $data->delete();

    //     return redirect()->route('kinerjaperiodeIndex');
    // }

    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function index($id)
    // {

    //     $periode = Gajiperiode::where('uuid', $id)->first();
    //     $data = kinerja::orderBy('id', 'Desc')->where('gajiperiode_id', $periode->id)->get();
    //     $karyawan = Pegawai::orderBy('id', 'Desc')->get();
    //     $count_days = carbon::parse($periode->id)->daysInMonth;

    //     $data = $data->map(function ($item) use ($count_days) {
    //         $nilai = $count_days - $item->disiplin_detail->alfa;
    //         $persentase = ($nilai * 100) / $count_days;
    //         $item->disiplin = ceil($persentase);
    //         $item['total'] = ($item->waktu + $item->inisiatif + $item->penyelesaian + ceil($persentase)) / 4;
    //         // dd($item);
    //         return $item;
    //     });

    //     // dd($data);

    //     return view('admin.kinerja.index', compact('data', 'karyawan', 'periode'));
    // }

    public function kinerjaindex($id)
    {
        $periode = Periode::where('uuid', $id)->first();
        $end =  Carbon::parse($periode->periode)->endOfMonth()->toDateString();
        $count_days = carbon::parse($periode->periode)->daysInMonth;
        $data = Absensi::orderBy('id', 'asc')->where('periode_id', $periode->id)->where('tanggal', $end)->get();


        // dd($alfa);
        $data = $data->map(function ($item) use ($count_days) {
            $nilai = $count_days - $item->where('alfa', 1)->sum('alfa');
            $persentase1 = ($nilai * 100) / $count_days;

            $nilaiwaktu = $item->sum('waktu');
            $persentase2 = ($nilaiwaktu / $count_days);

            $nilaiinisiatif = $item->sum('inisiatif');
            $persentase3 = ($nilaiinisiatif / $count_days);

            $nilaipenyelesaian = $item->sum('penyelesaian');
            $persentase4 = ($nilaipenyelesaian / $count_days);
            $item->disiplin = ceil($persentase1);
            $item->waktu = ceil($persentase2);
            $item->inisiatif = ceil($persentase3);
            $item->penyelesaian = ceil($persentase4);

            $pegawai = Pegawai::orderBy('id', 'asc')->get();
            foreach ($pegawai as $d) {
                $item['totalalfa'] = $item->where('alfa', 1)->where('pegawai_id', $d->id)->get('alfa');
                $item['totalhadir'] = $item->where('hadir', 1)->sum('hadir');
                $item['totalsakit'] = $item->where('sakit', 1)->sum('sakit');
                $item['totalizin'] = $item->where('izin', 1)->sum('izin');
            }


            $item['total'] = (ceil($persentase1) + ceil($persentase2) + ceil($persentase3) + ceil($persentase4)) / 4;

            // dd($item);
            return $item;
        });

        // dd($data);

        return view('admin.kinerja.index', compact('data', 'pegawai', 'periode'));
    }

    public function gajiindex($id)
    {
        $periode = periode::where('uuid', $id)->first();
        $end =  Carbon::parse($periode->periode)->endOfMonth()->toDateString();
        $data = Absensi::orderBy('id', 'Desc')->where('periode_id', $periode->id)->where('tanggal', $end)->get();
        $count_days = carbon::parse($periode->periode)->daysInMonth;

        // $alfa = Absensi::where('periode_id', $periode_id)->where('tanggal', $end)->where('alfa', 1)->sum();

        $data = $data->map(function ($item) use ($count_days) {
            $nilai = $count_days - $item->where('alfa', 1)->sum('alfa');
            $persentase1 = ($nilai * 100) / $count_days;

            $nilaiwaktu = $item->sum('waktu');
            $persentase2 = ($nilaiwaktu / $count_days);

            $nilaiinisiatif = $item->sum('inisiatif');
            $persentase3 = ($nilaiinisiatif / $count_days);

            $nilaipenyelesaian = $item->sum('penyelesaian');
            $persentase4 = ($nilaipenyelesaian / $count_days);

            $item->disiplin = ceil($persentase1);
            $item->waktu = ceil($persentase2);
            $item->inisiatif = ceil($persentase3);
            $item->penyelesaian = ceil($persentase4);
            $item['total'] = (ceil($persentase1) + ceil($persentase2) + ceil($persentase3) + ceil($persentase4)) / 4;

            // dd($item);
            return $item;
        });

        return view('admin.kinerja.gaji.index', compact('periode', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {

        $periode = Periode::where('uuid', $id)->first();
        $monthgaji = Carbon::parse($periode->periode)->format('m');
        $periodeTomi = Periode::whereMonth('periode', $monthgaji)->first();
        if (!$periodeTomi) {
            return redirect()->back()->withWarning('Periode absensi belum dibuat');
        }
        $alfa = Absensi::where('periode_id', $periodeTomi->id)->where('alfa', 1)->get()->count();
        $izin = Absensi::where('periode_id', $periodeTomi->id)->where('izin', 1)->get()->count();
        $sakit = Absensi::where('periode_id', $periodeTomi->id)->where('sakit', 1)->get()->count();
        $hadir = Absensi::where('periode_id', $periodeTomi->id)->where('hadir', 1)->get()->count();
        $count_days = carbon::parse($periodeTomi->periode)->daysInMonth;

        $disiplinKinerja = $count_days - $alfa;

        //dd($request->all());
        $request->validate([
            'karyawan' => 'unique:kinerjas,pegawai_id,null,id,periode_id,' . $request->periode_id . '',
        ]);

        $data = new Kinerja;
        $data->pegawai_id = $request->karyawan;
        $data->periode_id = $periode->id;
        $data->waktu = $request->waktu;
        $data->penyelesaian = $request->penyelesaian;
        $data->inisiatif = $request->inisiatif;
        $data->keterangan = $request->keterangan;
        $data->save();

        $disiplin = new Disiplin_detail;
        $disiplin->kinerja_id = $data->id;
        $disiplin->alfa = $alfa;
        $disiplin->izin = $izin;
        $disiplin->sakit = $sakit;
        $disiplin->hadir = $hadir;

        $disiplin->save();

        $data->disiplin = $disiplinKinerja;
        $data->update();

        return redirect()->back()->with('success', 'Data berhasil disimpan');
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
