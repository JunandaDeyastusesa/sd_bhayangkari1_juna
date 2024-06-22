<?php

namespace App\Http\Controllers;
//kelas
use App\Models\Kelas;
use App\Models\Guru;


use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Data Kelas";
        $kelas = DB::table('kelas')
                ->select('kelas.*', 'kelas.id as kelas_id')
                ->get();

        return view('dashboard.Operational.Kelas.DataKelas',[
            'title'=>$title,
            'kelas'=>$kelas,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah Data Kelas";
        $guru = DB::table('guru')->select('guru.*', 'guru.id,guru.nama_guru')->get();
        $Kelas = "";
        return view('dashboard.Operational.Kelas.TambahDataKelas',[
            'title'=>$title,
            'DataGuru'=>$guru,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'angka_kelas.required' => 'Kelas harus dipilih.',
            'angka_kelas.unique' => 'Angka sudah dipilih... Tidak bisa duplikat',
        ];

        $validator = Validator::make($request->all(), [
            'angka_kelas' => 'required|unique:kelas,angka_kelas',
        ],[ ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // ELOQUENT
        $kelas = New kelas;
        $kelas->nama_kelas = $request->nama_kelas;
        $kelas->wali_kelas = $request->wali_kelas;
        $kelas->save();

        return redirect()->route('kelas.index')->with('Success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = 'Data Siswa Kelas :';
        $DataSiswa = DB::table('siswas')
        ->join('kelas', 'siswa.kelas_id', '=', 'kelas.id')
        ->select('siswa.*', 'kelas.angka_kelas')
        ->where('kelas.id', $id)
        ->first();

        return view('dashboard.Operational.Kelas.TambahDataKelas',[
            'title'=>$title,
            // 'guru'=>$guru,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = "Edit Data Kelas";
        $guru = Guru::all();
        // $kelas = Kelas::find($id);
        $kelas = DB::table('kelas')
            ->select('kelas.*')->where('kelas.id',$id)
            ->first();

        return view('dashboard.Operational.Kelas.EditDataKelas',[
            'title'=>$title,
            'guru'=>$guru,
            'kelas'=>$kelas
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $messages = [
            'angka_kelas.required' => 'Kelas harus dipilih.',
            'angka_kelas.unique' => 'Angka sudah dipilih... Tidak bisa duplikat',
        ];

        $validator = Validator::make($request->all(), [
            'angka_kelas' => 'required|unique:kelas,angka_kelas',
        ],[ ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // ELOQUENT
        $kelas = Kelas::findOrFail($id);
        $kelas->angka_kelas = $request->angka_kelas;
        $kelas->save();

        return redirect()->route('kelas.index')->with('Success','Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
