<?php

namespace App\Http\Controllers;

use App\Models\late;
use Illuminate\Http\Request;
use App\Models\students;
use App\Models\Rayon;
use Illuminate\Support\Facades\Auth;
use PDF;
use Excel;
use App\Exports\PrintLate;
use App\Exports\PrintLatePs;
class LateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{   
    $search = $request->input('search');
    if(Auth::user()->role == "admin") {
        $lates = late::with('students')
        ->when($search, function ($query) use ($search) {
            $query->whereHas('students', function ($subquery) use ($search) {
                $subquery->where('name', 'like', '%' . $search . '%');
            });
        })
        ->orderBy('student_id')
        ->paginate(10);

    $rekap = late::selectRaw('student_id, count(*) as total')
        ->groupBy('student_id')
        ->get();

    return view('keterlambatan.index', compact('lates', 'rekap'));
    } else {
        $ps = Rayon::select('id')->where('user_id', Auth::user()->id)->get();
        $students = students::wherein('rayon_id', $ps)->get();

        foreach($students as $item) {
            $studentlate = late::where('student_id', $item['id'])->get();
            $studentgroup = late::select('student_id')->where('student_id', $item['id'])->groupBy('student_id')->get();
            return view('keterlambatan.index', compact('students', 'studentlate', 'studentgroup'));
        }
    }
}

    public function students(){
        return $this->belongsTo( students::class, 'student_id', 'id');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Students::all();
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
    public function show($id)
    {
        $student = Students::findOrFail($id);

        $lates = late::where('student_id', $id)->get();
        
        return view('keterlambatan.show', compact('lates', 'student'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(late $late, $id)
    {
        $lates = late::where('id', $id)->first();
        $students = Students::all();
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
        late::where('id', $id)->delete();

        return redirect()->back()->with('deleted', 'Berhasil menghapus data!');
    }
    public function print($id)
    {
        $student = students::find($id);
        $late = Late::with('students')->where('student_id', $id)->first();
        $rekap = Late::selectRaw('student_id, count(*) as total')
                ->where('student_id', $id)
                ->groupBy('student_id')
                ->get();
        $pdf = PDF::loadView('keterlambatan.export', compact('late', 'rekap', 'student'));
        return $pdf->download($student->name . '_surat_pernyataan.pdf');
    }

    public function exportExcel(){
        $file_name = 'Data_Siswa' . '.xls';
        if(Auth::user()->role == "Admin") {
            return Excel::download(new PrintLate, $file_name);
        } else {
            $ps = Rayon::select('id')->where('user_id', Auth::user()->id);
            return Excel::download(new PrintLatePs($ps), $file_name);
        }
        
    }
}
