<?php

namespace App\Http\Controllers;

use App\Models\students;
use Illuminate\Http\Request;
use App\Models\rayon;
use App\Models\rombel;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            $students = students::where('name', 'LIKE', '%' . $search . '%')->orderBy('name', 'ASC')->simplePaginate(5);
        } else {
            $students = students::orderBy('name', 'ASC')->simplePaginate(5);
        }
        $rayons = rayon::all();
        $rombels = rombel::all();
        return view('dashboard.siswa.index', compact('rayons', 'rombels', 'students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rayons = rayon::all();
        $rombels = rombel::all();
        return view('Dashboard.Siswa.create', compact('rayons', 'rombels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'nis' => 'required',
            'name' => 'required',
            'rombel_id' => 'required',
            'rayon_id' => 'required',
        ]);

        students::create([
            'nis' => $request->nis,
            'name' => $request->name,
            'rombel_id' => $request->rombel_id,
            'rayon_id' => $request->rayon_id,
        ]);

        return redirect()->back()->with('success', 'Berhasil Menambahkan Siswa!');
    }

    /**
     * Display the specified resource.
     */
    public function show(students $students)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(students $students, $id)
    {
        $rayons = rayon::all();
        $rombels = rombel::all();
        $students = students::where('id', $id)->first();
        return view('Dashboard.Siswa.edit', compact('rayons', 'rombels', 'students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, students $students, $id)
    {
        $request->validate([
            'nis' => 'required',
            'name' => 'required',
            'rombel_id' => 'required',
            'rayon_id' => 'required',
        ]);

        students::where('id', $id)->update([
            'nis' => $request->nis,
            'name' => $request->name,
            'rombel_id' => $request->rombel_id,
            'rayon_id' => $request->rayon_id,
        ]);

        return redirect()->back()->with('success', 'Berhasil Mengubah Data Siswa!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(students $students)
    {
        //
    }
}
