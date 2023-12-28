<?php

namespace App\Http\Controllers;

use App\Models\late;
use Illuminate\Http\Request;
use App\Models\students;

class LateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        // $students = students::all();
        $lates = late::with('students')->orderBy('student_id')->get();
        return view('keterlambatan.index', compact('lates'));
    }

    public function students(){
        return $this->belongsTo( students::class, 'student_id', 'id');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = students::all();
        return view('keterlambatan.create', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'date_time_late' => 'required',
            'information' => 'required',
            'bukti' => 'required'
        ]);
        $data = late::create([
            'student_id' => $request->student_id,
            'date_time_late' => $request->date_time_late,
            'information' => $request->information,
            'bukti' => $request->bukti,
        ]);
        if($request->hasFile('bukti')){
            $request->file('bukti')->move('storage/images/', $request->file('bukti')->getClientOriginalName());
            $data->bukti = $request->file('bukti')->getClientOriginalName();
            $data->save();
        }
        return redirect()->route('keterlambatan.index')->with('success', 'Success add data');

    }

    /**
     * Display the specified resource.
     */
    public function show(late $late)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(late $late, $id)
    {
        $lates = late::where('id', $id)->first();
        $students = students::all();
        return view('keterlambatan.edit', compact('lates', 'students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, late $late, $id)
    {
        $request->validate([
            'nama' => 'required',
            'date_time_late' => 'required',
            'information' => 'required',
            'bukti' => 'required'
        ]);

        late::where('id', $id)->update([
            'nama' => $request->nama,
            'date_time_late' => $request->date_time_late,
            'information' => $request->information,

            'bukti' => $request->file('bukti')->move('storage/images/', $request->file('bukti')->getClientOriginalName()),
        ]);
        return redirect()->route('keterlambatan.index')->with('success', 'Success edit data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(late $late, $id)
    {
        $user = late::find($id);

        $user->delete();


        return redirect()->back()->with('deleted', 'Berhasil menghapus obat!');
    }
}
