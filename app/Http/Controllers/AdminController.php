<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // admin dashboard 
    public function index()
    {
        return view('admin.index');
    }

    // bpk data view
    public function bpkIndex()
    {
        return view('admin.bpk.index');
    }
}
