<?php

namespace App\Http\Controllers;

use App\Imports\DosensImport;
use App\Models\User;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class MasterController extends Controller
{
    public function add(Request $request){
        User::create([
            'name'      => $request['name'],
            'email'     => $request['email'],
            'password'  => bcrypt($request['password']),
        ]);
        // Alert::success('Berhasil', 'Master Berhasil Ditambahkan');
        return redirect(route('dashboard'))->withSuccess('Berhasil Menambah Master');
    }

    public function tahun()
    {
        return view('pages.tahun');
    }

    public function dosen()
    {
        return view('pages.dosen');
    }

    public function koorkp()
    {
        return view('pages.koorkp');
    }

    public function koorta()
    {
        return view('pages.koorta');
    }

    public function import(Request $request){
        $request->validate([
            'file'  => 'required|mimes:xlsx, xls, xlm, xla, xlc, xlt, xlw, xlsb, xlsm'
        ],
        [
            'file.required' => 'Tolong Disis',
            'file.mimes' => 'Hanya bisa file excel(.xlsx/.xls/.xlsb/.xlsm/.xlm/.xla/.xlc)',
        ]);
        Excel::import(new DosensImport, request()->file('file'));
        Alert::success('Success', 'Berhasil Import Data');
        return redirect(route('dosen'))->with('success', 'Berhasil Import Data');
    }

}
