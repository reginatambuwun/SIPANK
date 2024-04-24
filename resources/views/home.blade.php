@extends('layouts.app')

@section('content')
{{-- <div class="container"> --}}
    @if(Auth::user()->role == 'pegawai')
        @include('pages.home.pegawai')
    @elseif(Auth::user()->role == 'admin')
        @include('pages.home.admin')
    @elseif(Auth::user()->role == 'bkpsdm')
        @include('pages.home.bkpsdm')
    @endif
{{-- </div> --}}
@endsection
