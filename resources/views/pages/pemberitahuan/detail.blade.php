@extends('layouts.app')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Pemberitahuan</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item">Pemberitahuan</div>
      </div>
    </div>

    <div class="section-body">
      <div class="row justify-content-center">
        <div class="col-10">
          <div class="form-group">
            <a href="{{ route('pemberitahuan.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i></a>
          </div>
          <div class="card card-primary">
            <div class="card-header">
              <h4>
                @if($pemberitahuan->status === 'terdaftar_periode')
                  Terdaftar Periode
                @elseif($pemberitahuan->status === 'rekomendasi_naik_pangkat')
                  Direkomendasikan Pengajuan Naik Pangkat
                @elseif($pemberitahuan->status === 'batal_rekomendasi_naik_pangkat')
                  Belum Direkomendasikan Pengajuan Naik Pangkat
                @elseif($pemberitahuan->status === 'perbaikan_berkas')
                  Perbaikan Berkas Pengajuan Naik Pangkat
                @elseif($pemberitahuan->status === 'berkas_diterima')
                  Berkas Pengajuan Naik Pangkat Diterima
                @elseif($pemberitahuan->status === 'sk_kp_dikirim')
                  SK Kenaikan Pangkat Dikirim
                @elseif($pemberitahuan->status === 'semua_sk_kp_dikirim')
                  Semua Pegawai Telah Menerima SK KP
                @endif
              </h4>
            </div>
    
            <div class="card-body">
              {!!$pemberitahuan->keterangan!!}
            </div>
          </div>
          <h2 class="section-title">{{$pemberitahuan->created_at->translatedFormat('l, d/m/Y')}}</h2>
        </div>
      </div>

    </div>
  </section>
@endsection
