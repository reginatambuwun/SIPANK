@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tambah Arsip Berkas</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Tambah Arsip Berkas</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6 col-lg-6">
                    <a href="{{ route('arsip.index') }}" class="btn btn-primary mb-4"><i class="fas fa-arrow-left"></i></a>
                    <div class="card">
                        <form method="POST" action="{{ route('arsip.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" id="kodeShow" class="form-control" name="nama">
                                    @if ($errors->has('nama'))
                                        <label class="mt-2" style="color: red">
                                            {{ $errors->first('nama') }}
                                        </label>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Berkas</label>
                                    <input type="file" class="form-control" name="berkas">
                                    @if ($errors->has('berkas'))
                                        <label class="mt-2" style="color: red">
                                            {{ $errors->first('berkas') }}
                                        </label>
                                    @endif
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection