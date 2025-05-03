<?php

namespace App\Http\Controllers;

use App\Models\Bin;
use Illuminate\Http\Request;

class BinController extends Controller
{
    /**
     * Display a listing of the bins.
     */
    public function index()
    {
         // Ambil semua bin
         $bins = Bin::all();
         // Kirim ke view 'sampah'
         return view('sampah', [
             'title' => 'Sampah Page',
             'bins'  => $bins
         ]);
    }

    /**
     * Show the form for creating a new bin.
     */
    public function create()
    {
        return view('bins.create');
    }

    /**
     * Store a newly created bin in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'weight'    => 'required|numeric|min:0',
            'latitude'  => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'distance'  => 'required|integer|min:0',
        ]);

        Bin::create($data);

        return redirect()->route('bins.index')
                         ->with('success', 'Bin berhasil ditambahkan.');
    }

    /**
     * Display the specified bin.
     */
    public function show(Bin $bin)
    {
        return view('bins.show', compact('bin'));
    }

    /**
     * Show the form for editing the specified bin.
     */
    public function edit(Bin $bin)
    {
        return view('bins.edit', compact('bin'));
    }

    /**
     * Update the specified bin in storage.
     */
    public function update(Request $request, Bin $bin)
    {
        $data = $request->validate([
            'weight'    => 'required|numeric|min:0',
            'latitude'  => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'distance'  => 'required|integer|min:0',
        ]);

        $bin->update($data);

        return redirect()->route('bins.index')
                         ->with('success', 'Bin berhasil diupdate.');
    }

    /**
     * Remove the specified bin from storage.
     */
    public function destroy(Bin $bin)
    {
        $bin->delete();

        return redirect()->route('bins.index')
                         ->with('success', 'Bin berhasil dihapus.');
    }

    

}
