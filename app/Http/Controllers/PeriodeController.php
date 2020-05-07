<?php

namespace App\Http\Controllers;

use App\Periode;
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
        $periode = new Periode;
        $periode->periode = $request->periode;
        $periode->save();

        return redirect()->route('periodeIndex')->with('success', 'Data berhasil disimpan');
    }
}
