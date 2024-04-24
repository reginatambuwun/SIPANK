@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Detail Berkas</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Detail Berkas</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row justify-content-center">
                <div class="col-12">
                    <a href="{{ route('arsip.index') }}" class="btn btn-primary mb-4"><i class="fas fa-arrow-left"></i></a>
                    <div class="card">
                        <div class="card-header">
                            <h4>{{$arsip->nama}}</h4>
                        </div>
                        <div class="card-body">
                            <iframe src="{{ asset('berkas/'.$arsip->berkas.'') }}" style="width: 100%; height: 100vh" frameborder="0"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection