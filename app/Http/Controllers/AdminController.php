<?php

namespace App\Http\Controllers;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){
        $buku = Book::all();
        return view('admin',[
            'buku'=> $buku
        ]);
    }
    public function add(){
        return view('addBuku');
    }
    public function insert(Request $r){
        $cek = $r->validate([
            'judul' => 'required|unique:books|max:255',
            'penulis' => 'required|max:255',
            'deskripsi'=> 'required|max:1000'
        ],[
            'judul.required' => 'Judul buku wajib diisi.',
            'judul.unique' => 'Judul buku sudah ada.',
            'judul.max' => 'Judul buku maksimal 255 karakter.',
            'penulis.required' => 'Penulis wajib diisi.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'deskripsi.max' => 'Deskripsi maksimal 1000 karakter.',
        ]);
        Book::create($cek);
       $buku = Book::all();
        return redirect()->route('admin',['buku'=> $buku]);
    }

    public function edit(Request $r){
        $validatedData = $r->validate([
            'judul' => 'required|string|max:255', 
            'penulis' => 'required|string|max:255', 
            'deskripsi' => 'nullable|string|max:1000', 
        ]);
        // dd($r->all());
        
        $buku = Book::find($r->id);
        $buku->judul = $validatedData['judul'];
        $buku->penulis = $validatedData['penulis'];
        $buku->deskripsi = $validatedData['deskripsi'];
        $buku->save();

        return redirect()->route("admin")->with("success", "Data updated successfully.");
    }
}
