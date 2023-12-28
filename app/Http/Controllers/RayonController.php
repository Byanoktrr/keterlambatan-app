<?php

namespace App\Http\Controllers;

use App\Models\rayon;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;

class RayonController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function user(){

    }
    public function index(Request $request)
    {
        
        $rayons = Rayon::all();
        $users = User::where('role', 'ps')->get();

        $search = $request->input('search');

        if ($search) {
            $rayons = rayon::where('rayon', 'LIKE', '%' . $search . '%')->orderBy('rayon', 'ASC')->simplePaginate(5);
        } else {
            $rayons = rayon::orderBy('rayon', 'ASC')->simplePaginate(5);
        }
        return view('dashboard.rayon.index', compact('rayons', 'search'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('role', 'ps')->get();
        return view('dashboard.Rayon.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rayon' => 'required',
            'user_id' => 'required',
        ]);

        Rayon::create([
            'rayon' => $request->rayon,
            'user_id' => $request->user_id,
        ]);

        return redirect()->back()->with('success', 'Berhasil menambahkan Akun!');
    }

    /**
     * Display the specified resource.
     */
    public function show(rayon $rayon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $rayon = Rayon::where('id', $id)->first();
        $users = User::where('role', 'ps')->get();
        return view('dashboard.rayon.edit', compact('rayon', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'rayon' => 'required',
            'user_id' => 'required',
        ]);

        Rayon::where('id', $id)->update([
            'rayon' => $request->rayon,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('rayon.index')->with('success', 'Berhasil mengubah data obat!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(rayon $rayon)
    {
        //
    }
}
