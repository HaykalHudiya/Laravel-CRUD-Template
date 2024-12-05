<?php

namespace App\Http\Controllers;

use App\Models\Mhs;
use Illuminate\Http\Request;

class MhsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahasiswas = Mhs::all();
        return view('mahasiswas.home', compact('mahasiswas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mahasiswas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'nim' => 'required|numeric|digits:9',
            'jurusan' => 'required|string|max:50',
            'tempat' => 'required|string|max:15',
            'tanggal_lahir' => 'required|date|before:today',
            'hobi' => 'required|string|max:255',
            'alamat' => 'required|string',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $fileName = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);
        }

        Mhs::create([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'jurusan' => $request->jurusan,
            'tempat' => $request->tempat,
            'tanggal_lahir' => $request->tanggal_lahir,
            'hobi' => $request->hobi,
            'alamat' => $request->alamat,
            'foto' => $fileName,
        ]);

        return redirect()->route('mhs.index')->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mhs $mhs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $mahasiswa = Mhs::find($id);
        return view('mahasiswas.edit', compact('mahasiswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $mahasiswa = Mhs::find($id);
        $request->validate([
            'nama' => 'required|string|max:100',
            'nim' => 'required|numeric|digits:9',
            'jurusan' => 'required|string|max:50',
            'tempat' => 'required|string|max:15',
            'tanggal_lahir' => 'required|date|before:today',
            'hobi' => 'required|string|max:255',
            'alamat' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);
        } else {
            $fileName = $mahasiswa->foto;
        }

        $mahasiswa->update([
            'nama' => $request->input('nama'),
            'nim' => $request->input('nim'),
            'jurusan' => $request->input('jurusan'),
            'tempat' => $request->input('tempat'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'hobi' => $request->input('hobi'),
            'alamat' => $request->input('alamat'),
            'foto' => $fileName,  // Update foto
        ]);

        return redirect()->route('mhs.index')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $mahasiswa = Mhs::find($id);
        if ($mahasiswa->foto) {
            $filePath = public_path('uploads/' . $mahasiswa->foto);

            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        $mahasiswa->delete();
        return redirect()->route('mhs.index')->with('success', 'Data Berhasil di Hapus');
    }
}
