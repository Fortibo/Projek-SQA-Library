@extends('base')
@section('konten')
<div>
    
</div>
    <div class="flex justify-center mt-4">
        <h5 class="text-4xl font-bold">{{$buku->judul}}</h5>
    </div>
    <div class="flex justify-center mb-4">
        <h2 class="text-blue-500">{{$buku->penulis}}</h2>
    </div>
    <div class=" flex justify-center mx-4 border-2 text-white rounded-b-2xl p-4 bg-blue-950 border-blue-900">
        <p class="indent-8">{{$buku->deskripsi}}</p>
    </div>
    <div class="ms-4 mt-4">
        <a href="{{route('user')}}"     class="text-white rounded-full bg-blue-900 px-4 py-2" ><- back to home</a>
        
    </div>
@endsection