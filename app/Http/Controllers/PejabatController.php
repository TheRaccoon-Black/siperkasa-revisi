<?php

namespace App\Http\Controllers;

use App\Models\Pejabat;
use Illuminate\Http\Request;

class PejabatController extends Controller
{
    //

    public function index()
    {
        $pejabats = Pejabat::all();
        return view('pejabats.index', compact('pejabats'));
    }

    public function create()
    {
        return view('pejabats.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'jabatan' => 'required|string|max:255',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $photoPath = null;
    if ($request->hasFile('photo')) {
        $photo = $request->file('photo');
        $photoName = time() . '_' . $photo->getClientOriginalName();
        $photo->move(public_path('img'), $photoName);
        $photoPath = 'img/' . $photoName;
    }

    Pejabat::create([
        'nama' => $request->nama,
        'jabatan' => $request->jabatan,
        'photo' => $photoPath,
    ]);

    return redirect()->route('pejabats.index')->with('success', 'Pejabat berhasil ditambahkan.');
}

    public function show(Pejabat $pejabat)
    {
        return view('pejabats.show', compact('pejabat'));
    }

    public function edit(Pejabat $pejabat)
    {
        return view('pejabats.edit', compact('pejabat'));
    }

    public function update(Request $request, Pejabat $pejabat)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'jabatan' => 'required|string|max:255',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->hasFile('photo')) {
        // Hapus foto lama jika ada
        if ($pejabat->photo && file_exists(public_path($pejabat->photo))) {
            unlink(public_path($pejabat->photo));
        }

        $photo = $request->file('photo');
        $photoName = time() . '_' . $photo->getClientOriginalName();
        $photo->move(public_path('img'), $photoName);
        $pejabat->photo = 'img/' . $photoName;
    }

    $pejabat->update([
        'nama' => $request->nama,
        'jabatan' => $request->jabatan,
        'photo' => $pejabat->photo,
    ]);

    return redirect()->route('pejabats.index')->with('success', 'Pejabat berhasil diperbarui.');
}


    public function destroy(Pejabat $pejabat)
    {
        if ($pejabat->photo && file_exists(public_path('storage/' . $pejabat->photo))) {
            unlink(public_path('storage/' . $pejabat->photo));
        }

        $pejabat->delete();
        return redirect()->route('pejabats.index')->with('success', 'Pejabat berhasil dihapus.');
    }
}
