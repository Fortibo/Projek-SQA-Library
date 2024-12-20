<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function tampil($id){
       $buku =  Book::findOrFail($id);
   
       return view('detailBuku',[
        'buku'=> $buku
       ]);
    }

    public function editBuku($id){
        $buku = Book::findOrFail($id);
        
        return view('editBuku', compact('buku'));
    }

    public function delete($id){
        $buku =  Book::findOrFail($id);
        $buku->delete();
        $book = Book::all();
        return redirect()->route('admin',['buku' => $book]);
    }
}
