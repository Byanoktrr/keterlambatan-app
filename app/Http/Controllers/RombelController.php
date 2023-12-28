<?php

namespace App\Http\Controllers;

use App\Models\rombel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RombelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            $rombles = rombel::where('rombles', 'LIKE', '%' . $search . '%')->orderBy('rombles', 'ASC')->simplePaginate(5);
        } else {
            $rombles = rombel::orderBy('rombles', 'ASC')->simplePaginate(5);
        }
        return view('dashboard.Rombel.index', compact('rombles', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.rombel.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rombles' => 'required',
        ]);

        Rombel::create([
            'rombles' => $request->rombles,
        ]);

        return redirect()->back()->with('success', 'Berhasil menambahkan Rombel!');
    }

    /**
     * Display the specified resource.
     */
    public function show(rombel $rombel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(rombel $rombel, $id)
    {
        $rombel = rombel::where('id', $id)->first();
        return view('dashboard.rombel.edit', compact('rombel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'rombles' => 'required',
        ]);

        rombel::where('id', $id)->update([
            'rombles' => $request->rombles,
        ]);

        return redirect()->route('rombel.index')->with('success', 'Berhasil mengubah data data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(rombel $rombel, $id)
    {
        rombel::where('id', $id)->delete();

        return redirect()->back()->with('deleted', 'Berhasil menghapus data!');
    }
}
