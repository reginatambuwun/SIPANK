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
      <div class="row">
        <div class="col-12 col-md-6">
            @if ($pemberitahuan->count() === 0)
              <div class="alert alert-light alert-has-icon">
                <div class="alert-icon"><i class="fas fa-info-circle"></i></div>
                <div class="alert-body">
                  <p>Tidak tersedia</p>
                </div>
              </div>
            @endif
        </div>
        <div class="col-12">
      
          @foreach ($pemberitahuan as $item)
            <div class="activities">
              <div class="activity">
                <div class="activity-icon bg-primary text-white shadow-primary">
                  <i class="fas fa-envelope"></i>
                </div>
                <div class="activity-detail">
                  <div class="mb-2">
                    <span class="text-job text-primary">{{$item->created_at->translatedFormat('l, d/m/Y')}}</span>
                    <span class="bullet"></span>
                    <a class="text-job" href="{{ route('pemberitahuan.detail',$item->id) }}">Lihat</a>
                  </div>
                  <p><strong>
                    @if($item->status === 'terdaftar_periode')
                      Terdaftar Periode
                    @elseif($item->status === 'rekomendasi_naik_pangkat')
                      Direkomendasikan Pengajuan Naik Pangkat
                    @elseif($item->status === 'batal_rekomendasi_naik_pangkat')
                      Belum Direkomendasikan Pengajuan Naik Pangkat
                    @elseif($item->status === 'perbaikan_berkas')
                      Perbaikan Berkas Pengajuan Naik Pangkat
                    @elseif($item->status === 'berkas_diterima')
                      Berkas Pengajuan Naik Pangkat Diterima
                    @elseif($item->status === 'sk_kp_dikirim')
                      SK Kenaikan Pangkat Dikirim
                    @elseif($item->status === 'semua_sk_kp_dikirim')
                      Semua Pegawai Telah Menerima SK KP
                    @endif
                  </strong></p>
                  {!!$item->keterangan!!}
                </div>
              </div>
            </div>
          @endforeach
          {{ $pemberitahuan->links() }}
        </div>
      </div>
    </div>
  </section>
@endsection
