@extends('base')
@section('konten')
    <div class="flex justify-center">
        <h5>{{$buku->judul}}</h5>
    </div>
    <div class="flex justify-center">
        <h2>{{$buku->penulis}}</h2>
    </div>
    <div class="flex justify-center">
        <p>{{$buku->deskripsi}}</p>
    </div>
    <a href="{{route('user')}}">back to home</a>
@endsection