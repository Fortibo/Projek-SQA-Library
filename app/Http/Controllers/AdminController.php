<?php

namespace App\Http\Controllers;
use App\Models\Book;
use Illuminate\Http\Request;

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
        Book::create([
            'judul'=> $r->judul,
            'penulis'=> $r->penulis,
            'deskripsi'=> $r->deskripsi
        ]);
       $buku = Book::all();
        return redirect()->route('admin',['buku'=> $buku]);
    }
}
