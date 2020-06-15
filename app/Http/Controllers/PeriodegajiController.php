<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gajiperiode;
use App\Gaji;
use App\Pegawai;
use App\Kinerja;
use Carbon\Carbon;
use App\Jabatan;
use Illuminate\Support\Facades\DB;

class PeriodegajiController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $periode = Gajiperiode::where('uuid', $id)->first();
        $periode1 = Gajiperiode::where('uuid', $id)->get();

        $data = kinerja::orderBy('id', 'Desc')->where('gajiperiode_id', $periode->id)->get();
        $karyawan = Pegawai::orderBy('id', 'Desc')->get();

        $count_days = carbon::parse($periode->id)->daysInMonth;

        $data = $data->map(function ($item) use ($count_days) {
            $nilai = $count_days - $item->disiplin_detail->alfa;
            $persentase = ($nilai * 100) / $count_days;
            $item->disiplin = ceil($persentase);
            $item['total'] = ($item->waktu + $item->inisiatif + $item->penyelesaian + ceil($persentase)) / 4;
            // dd($item);
            return $item;
        });

        // $karyawan = Pegawai::whereIn('pekerja', ['Karyawan'])->get();
        // $karyawan = Pegawai::all();
        // $gaji = Gaji::where('periode_id', $periode->id)
        //     ->join('pegawais', 'pegawais.id', '=', 'gajis.pegawai_id')
        //     ->join('jabatans', 'jabatans.id', '=', 'pegawais.jabatan_id')
        //     ->select('gajis.uuid', 'gajis.keterangan', 'jabatans.gaji_pokok', 'jabatans.tunjangan', 'pegawais.nama', 'pegawais.status', 'pegawais.pekerja', 'jabatans.jabatan')
        //     ->whereIn('pekerja', ['Karyawan'])
        //     ->get();
        // $gaji = Gaji::where('periode_id', $periode->id)
        //     ->join('pegawais', 'pegawais.id', '=', 'gajis.pegawai_id')
        //     ->select('gajis.uuid', 'gajis.keterangan', 'pegawais.nama', 'pegawais.status')
        //     ->get();

        // if ($gaji->count() == 0) {
        //     $total = 0;
        // } else {

        //     foreach ($gaji as $data) {

        //         $total = $data->gaji_pokok + $data->tunjangan;
        //     }
        // }
        // $gaji = $gaji->map(function ($item) use ($total) {
        //     $item['total'] = $total;
        //     // dd($item);
        //     return $item;
        // });

        return view('admin.kinerja.gaji.index', compact('periode', 'karyawan', 'periode1', 'data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        $periode = Gajiperiode::where('uuid', $id)->first();

        $gaji = new gaji;
        $gaji->pegawai_id = $request->karyawan;
        $gaji->periode_id = $periode->id;
        $gaji->keterangan = $request->keterangan;
        $gaji->save();

        return redirect('admin.kinerja.gaji.index' . $id . '')->with('success', 'Data berhasil disimpan');
    }


    // public function delete($id)
    // {

    //     $gaji = Gaji::where('uuid', $id)->first();

    //     $gaji->delete();

    //     return redirect()->route('GajiperiodeIndex');
    // }




    //-------------------------- Pegawai Controller --------------->

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function pegawai($id)
    // {
    //     $periode = Gajiperiode::where('uuid', $id)->first();
    //     $periode1 = Gajiperiode::where('uuid', $id)->get();
    //     $pegawai = Pegawai::whereIn('pekerja', ['Pegawai'])->get();
    //     $gaji = Gaji::where('periode_id', $periode->id)
    //         ->join('pegawais', 'pegawais.id', '=', 'gajis.pegawai_id')
    //         ->join('jabatans', 'jabatans.id', '=', 'pegawais.jabatan_id')
    //         ->join('golongans', 'golongans.id', '=', 'pegawais.golongan_id')
    //         ->select('gajis.uuid', 'gajis.keterangan', 'jabatans.gaji_pokok', 'jabatans.tunjangan', 'pegawais.nama', 'pegawais.status', 'pegawais.pekerja', 'jabatans.jabatan', 'golongans.golongan')
    //         ->whereIn('pekerja', ['Pegawai'])
    //         ->get();

    //     if ($gaji->count() == 0) {
    //         $total = 0;
    //     } else {

    //         foreach ($gaji as $data) {

    //             $total = $data->gaji_pokok + $data->tunjangan;
    //         }
    //     }
    //     $gaji = $gaji->map(function ($item) use ($total) {
    //         $item['total'] = $total;
    //         // dd($item);
    //         return $item;
    //     });

    //     return view('admin.gaji.periode.pegawai.index', compact('gaji', 'pegawai', 'periode1', 'periode'));
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function createpegawai(Request $request, $id)
    // {
    //     $periode = Gajiperiode::where('uuid', $id)->first();

    //     $gaji = new gaji;
    //     $gaji->pegawai_id = $request->pegawai;
    //     $gaji->periode_id = $periode->id;
    //     $gaji->keterangan = $request->keterangan;
    //     $gaji->save();

    //     return redirect('admin/gaji/periode/pegawai/index/' . $id . '')->with('success', 'Data berhasil disimpan');
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function createpegawaiaktif($id)
    // {
    //     $periode = Gajiperiode::where('uuid', $id)->first();
    //     $pegawai = Pegawai::whereIn('status', ['aktif'])->get();

    //     $gaji = new gaji;
    //     $gaji->pegawai_id = $pegawai->id->all();
    //     $gaji->periode_id = $periode->id->all();
    //     $gaji->save();
    //     dd($gaji);
    //     return redirect('admin/gaji/periode/pegawai/index' . $id . '')->with('success', 'Data berhasil disimpan');
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function deletepegawai($id)
    // {
    //     $gaji = Gaji::where('uuid', $id)->first();

    //     $gaji->delete();

    //     return redirect()->route('GajiperiodeIndex');
    // }
}
