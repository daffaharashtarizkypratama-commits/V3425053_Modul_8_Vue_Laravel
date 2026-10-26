<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    // Menampilkan seluruh data siswa
    public function index()
    {
        $siswas = Siswa::all();

        return response()->json($siswas);
    }

    // Menampilkan formulir tambah data (tidak digunakan pada API)
    public function create()
    {
        //
    }

    // Menyimpan data siswa
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'provinsi' => 'required',
            'email' => 'required|email',
        ]);

        $siswa = Siswa::create($request->all());

        return response()->json([
            'message' => 'Data siswa berhasil ditambahkan',
            'data' => $siswa,
        ], 201);
    }

    // Menampilkan satu data siswa
    public function show(string $id)
    {
        $siswa = Siswa::findOrFail($id);

        return response()->json($siswa);
    }

    // Menampilkan formulir edit data (tidak digunakan pada API)
    public function edit(string $id)
    {
        //
    }

    // Memperbarui data siswa
    public function update(Request $request, string $id)
    {
        $siswa = Siswa::findOrFail($id);

        $request->validate([
            'nama' => 'sometimes|required',
            'alamat' => 'sometimes|required',
            'kota' => 'sometimes|required',
            'provinsi' => 'sometimes|required',
            'email' => 'sometimes|required|email',
        ]);

        $siswa->update($request->all());

        return response()->json([
            'message' => 'Data siswa berhasil diperbarui',
            'data' => $siswa,
        ]);
    }

    // Menghapus data siswa
    public function destroy(string $id)
    {
        $siswa = Siswa::findOrFail($id);

        $siswa->delete();

        return response()->json([
            'message' => 'Data siswa berhasil dihapus',
        ]);
    }
}
