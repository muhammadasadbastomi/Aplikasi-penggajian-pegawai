<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gajiperiode;
use App\Gaji;
use App\Pegawai;
use App\Jabatan;
use Illuminate\Support\Facades\DB;

class PeriodegajiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $periode = Gajiperiode::orderBy('id', 'Desc')->get();
        $gaji = Gaji::all();

        return view('admin/gaji/periode/index', compact('periode', 'gaji'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $messages = [
            'unique' => ':attribute sudah ada.',
            'required' => ':attribute harus diisi.'
        ];
        //dd($request->all());
        $request->validate([
            'periode' => 'required|unique:gajiperiodes'
        ], $messages);

        $periode = new Gajiperiode();
        $periode->periode = $request->periode;
        $periode->keterangan = $request->keterangan;
        $periode->save();


        return redirect('admin/gaji/periode/index')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $periode = Gajiperiode::where('uuid', $id)->first();
        return view('admin/gaji/periode/edit', compact('periode'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $messages = [
            'unique' => ':attribute sudah ada.'
        ];
        //dd($request->all());
        $request->validate([
            'periode' => 'unique:gajiperiodes'
        ], $messages);

        // get data by id
        $periode = Gajiperiode::where('uuid', $id)->first();
        $periode->periode = $request->periode;
        $periode->keterangan = $request->keterangan;
        $periode->update();

        return redirect()->route('GajiperiodeIndex')->with('success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $periode = Gajiperiode::where('uuid', $id)->first();

        $periode->delete();

        return redirect()->route('GajiperiodeIndex');
    }




    //-------------------------- Karyawan Controller --------------->





    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function karyawan($id)
    {
        $periode = Gajiperiode::where('uuid', $id)->first();
        $periode1 = Gajiperiode::where('uuid', $id)->get();
        // $karyawan = Pegawai::whereIn('pekerja', ['Karyawan'])->get();
        $karyawan = Pegawai::all();
        // $gaji = Gaji::where('periode_id', $periode->id)
        //     ->join('pegawais', 'pegawais.id', '=', 'gajis.pegawai_id')
        //     ->join('jabatans', 'jabatans.id', '=', 'pegawais.jabatan_id')
        //     ->select('gajis.uuid', 'gajis.keterangan', 'jabatans.gaji_pokok', 'jabatans.tunjangan', 'pegawais.nama', 'pegawais.status', 'pegawais.pekerja', 'jabatans.jabatan')
        //     ->whereIn('pekerja', ['Karyawan'])
        //     ->get();
        $gaji = Gaji::where('periode_id', $periode->id)
            ->join('pegawais', 'pegawais.id', '=', 'gajis.pegawai_id')
            ->select('gajis.uuid', 'gajis.keterangan', 'pegawais.nama', 'pegawais.status')
            ->get();

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

        return view('admin.gaji.periode.karyawan.index', compact('gaji', 'periode', 'karyawan', 'periode1'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createkaryawan(Request $request, $id)
    {
        $periode = Gajiperiode::where('uuid', $id)->first();

        $gaji = new gaji;
        $gaji->pegawai_id = $request->karyawan;
        $gaji->periode_id = $periode->id;
        $gaji->keterangan = $request->keterangan;
        $gaji->save();

        return redirect('admin/gaji/periode/karyawan/index/' . $id . '')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deletekaryawan($id)
    {

        $gaji = Gaji::where('uuid', $id)->first();

        $gaji->delete();

        return redirect()->route('GajiperiodeIndex');
    }




    //-------------------------- Karyawan Controller --------------->





    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pegawai($id)
    {
        $periode = Gajiperiode::where('uuid', $id)->first();
        $periode1 = Gajiperiode::where('uuid', $id)->get();
        $pegawai = Pegawai::whereIn('pekerja', ['Pegawai'])->get();
        $gaji = Gaji::where('periode_id', $periode->id)
            ->join('pegawais', 'pegawais.id', '=', 'gajis.pegawai_id')
            ->join('jabatans', 'jabatans.id', '=', 'pegawais.jabatan_id')
            ->join('golongans', 'golongans.id', '=', 'pegawais.golongan_id')
            ->select('gajis.uuid', 'gajis.keterangan', 'jabatans.gaji_pokok', 'jabatans.tunjangan', 'pegawais.nama', 'pegawais.status', 'pegawais.pekerja', 'jabatans.jabatan', 'golongans.golongan')
            ->whereIn('pekerja', ['Pegawai'])
            ->get();

        if ($gaji->count() == 0) {
            $total = 0;
        } else {

            foreach ($gaji as $data) {

                $total = $data->gaji_pokok + $data->tunjangan;
            }
        }
        $gaji = $gaji->map(function ($item) use ($total) {
            $item['total'] = $total;
            // dd($item);
            return $item;
        });

        return view('admin.gaji.periode.pegawai.index', compact('gaji', 'pegawai', 'periode1', 'periode'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createpegawai(Request $request, $id)
    {
        $periode = Gajiperiode::where('uuid', $id)->first();

        $gaji = new gaji;
        $gaji->pegawai_id = $request->pegawai;
        $gaji->periode_id = $periode->id;
        $gaji->keterangan = $request->keterangan;
        $gaji->save();

        return redirect('admin/gaji/periode/pegawai/index/' . $id . '')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createpegawaiaktif($id)
    {
        $periode = Gajiperiode::where('uuid', $id)->first();
        $pegawai = Pegawai::whereIn('status', ['aktif'])->get();

        $gaji = new gaji;
        $gaji->pegawai_id = $pegawai->id->all();
        $gaji->periode_id = $periode->id->all();
        $gaji->save();
        dd($gaji);
        return redirect('admin/gaji/periode/pegawai/index' . $id . '')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deletepegawai($id)
    {
        $gaji = Gaji::where('uuid', $id)->first();

        $gaji->delete();

        return redirect()->route('GajiperiodeIndex');
    }
}
