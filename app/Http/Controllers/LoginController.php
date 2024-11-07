<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function auth(Request $r){
        $cred = $r->validate([
            'name'=> 'required',
            'password'=>'required'
        ]);
        if(Auth::attempt($cred)){
            $r->session()->regenerate();
           $user =  Auth::user();
           
           $userData = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            // tambahkan data lain yang kamu perlukan
        ];
          $buku =  Book::get();
            return redirect()->route('user')->with('buku', $buku);
            // return view('user',[
            //     'user'=>$userData,
            //     'buku'=>$buku
            // ]);
        }
        return back()->with('error',"Login Failed");
    }
    public function create(Request $r){
     
        $data =  User::create([
            'name'=> $r->username,
            'email'=> $r->email,
            'password'=> Hash::make($r->password)

        ]);
        $userId = $data->id;
        Role::create([
            "user_id"=> $userId,
            "role"=>"user"
        ]);
        return redirect()->route('login.show');
        
    }
    public function logout(Request $r){
        Auth::logout();
        $r->session()->invalidate();
        $r->session()->regenerateToken();
        return redirect()->route('login');

    }
    public function dashboard()
{
    // Ambil data user dan books dari session
    $user = session('user');
    // $books = session('books');

    // Kirim data ke view
    return view('user', compact('user'));
}
}
