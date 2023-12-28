<?php


namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function loginAuth(Request $request){
        // validasi
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = $request->only(['email', 'password']);

        if(Auth::attempt($user)){
            return redirect('/dashboard');
        }else{
            return redirect()->back()->with('failed', 'Email dan password tidak sesuai. Silahkan coba lagi');
        }
    }

    public function index(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            $users = User::where('name', 'LIKE', '%' . $search . '%')->orderBy('name', 'ASC')->simplePaginate(5);
        } else {
            $users = User::orderBy('name', 'ASC')->simplePaginate(5);
        }
        return view('dashboard.user.index',compact('users')) ;
    }

    public function create()
    {
        return view('dashboard.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required',
            'role' => 'required',
        ]);

        $defaultPassword = Str::substr($request->email, 0, 3) . Str::substr($request->name, 0, 3);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt($defaultPassword),
        ]);

        return redirect()->back()->with('success', 'Berhasil menambahkan Akun!');
    }

    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        // atau bisa dengan Medicine::find($id) kalau yang dicari berdasarkan id nya
        return view('dashboard.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required',
            'role' => 'required',
            'password' => 'required',
        ]);

        User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt($request->password),
        ]);

        //redicrect route akan mengmbalikan halaman ke route dengan name terkait
        return redirect()->route('user.index')->with('success', 'Berhasil mengubah data obat!');
    }

    public function destroy($id)
    {

        $user = User::find($id);

        $user->delete();


        return redirect()->back()->with('deleted', 'Berhasil menghapus obat!');
    }



    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }

}
