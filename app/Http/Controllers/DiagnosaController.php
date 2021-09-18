<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diagnosa;
use App\Models\Tanya;
use App\Models\Jawab;

class DiagnosaController extends Controller
{

    public function index()
    {
        $diag = Diagnosa::all();
        return view('list_diag', compact('diag'));
    }

    public function store(Request $request)
    {

        $diag = Diagnosa::create();

        return redirect()->route('diagnosa.edit', $diag->id);
    }

    public function edit($id)
    {
        $diag = Diagnosa::find($id);
        $tanya = Tanya::all();
        $jawab = Jawab::all();
        return view('diagnosa', compact('diag','tanya','jawab'));
    }

    public function show($id)
    {
        $diag = Diagnosa::with('hasil.rule.solusi.item')->find($id);
        if (empty($diag->hasil)) {
            return "Rule tidak ditemukan, silahkan diagnosis lagi";
        } else {
            return $diag;
        }
    }
}
