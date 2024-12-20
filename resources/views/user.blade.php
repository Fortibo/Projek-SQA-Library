@extends('base')
@section('konten')
<div class="mt-8 flex justify-center">

<h5> Welcome  {{auth()->user()->name }}  </h5>
</div>
<div class="mt-8 grid grid-cols-2 md:grid-cols-4 gap-4 ms-4 me-4">


@foreach ($buku as $b)
    <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    <a href="#">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$b->judul}}</h5>
    </a>
    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{$b->deskripsi}}</p>
    <a href="{{route('detail.buku',$b->id)}}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        {{ $b->penulis }}
        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
        </svg>
    </a>
</div>
    @endforeach




</div>

@auth
<form action="{{route('logout')}}" method="post"  >
    @csrf
<button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Logout</button>
</form>
@endauth
@endsection