@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Detail Periode</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Detail Periode</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-10">

                    <span class="badge badge-info mb-3">Periode : {{ $periode ? $periode->nama : '-' }}</span>

                    {{-- status berkas telah diterima --}}
                    @if($checkStatus && $checkStatus->status === 'diterima')
                        <div class="alert alert-success alert-has-icon">
                            <div class="alert-icon"><i class="fas fa-info-circle"></i></div>
                            <div class="alert-body">
                                <div class="alert-title">Info</div>
                                <p>Berkas yang dikirim telah ditinjau dan diterima.</p>
                                <p>Pihak BKPSDM akan mengirim Surat Keputusan Kenaikan Pangkat anda.</p>
                            </div>
                        </div>
                    {{-- ada berkas yang harus diperbaiki --}}
                    @elseif($checkStatus && $checkStatus->status === 'perbaikan')                        
                        <div class="alert alert-warning alert-has-icon">
                            <div class="alert-icon"><i class="fas fa-info-circle"></i></div>
                            <div class="alert-body">
                                <div class="alert-title">Info</div>
                                Berkas yang dikirim masih harus diperbaiki sesuai dengan keterangan yang diberikan, periksa dan kirim kembali. 
                            </div>
                        </div>
                    @endif


                    <div class="card">
                        <div class="card-header">
                            <h4>Riwayat Peninjauan Berkas</h4>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                            <table class="table table-striped table-md">
                                <tr>
                                    <th>#</th>
                                    <th>Keterangan</th>
                                    <th>Status</th>
                                    {{-- <th>Waktu</th> --}}
                                    <th>Tanggal</th>
                                </tr>
                                <?php $no=0; ?>
                                @foreach($peninjauanBerkas as $item)  
                                    <?php $no++ ?>                                  
                                    <tr>
                                        <td>{{$no}}</td>
                                        <td>{{$item->keterangan ?? '-'}}</td>
                                        <td>
                                            @if($item->status === 'diterima')
                                                <div class="badge badge-success">Diterima</div>
                                            @elseif($item->status === 'perbaikan')
                                                <div class="badge badge-warning">Perbaikan</div>
                                            @endif
                                        </td>
                                        {{-- <td>{{$item->created_at->translatedFormat('H:i')}}</td> --}}
                                        <td>{{$item->created_at->translatedFormat('l, d/m/Y')}}</td>
                                    </tr>
                                @endforeach
                            </table>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4>Surat Keputusan Kenaikan Pangkat</h4>
                        </div>
                        <div class="card-body">
                            {{-- sk kp belum dikirim --}}
                            @if (!$berkas->sk_kp)
                                <div class="alert alert-light alert-has-icon">
                                    <div class="alert-icon"><i class="fas fa-info-circle"></i></div>
                                    <div class="alert-body">
                                        <p>Berkas SK KP anda belum tersedia.</p>
                                    </div>
                                </div>
                            @else
                                <div class="alert alert-light alert-has-icon">
                                    <div class="alert-icon"><i class="fas fa-info-circle"></i></div>
                                    <div class="alert-body">
                                        <p>Berkas akan diperbaiki jika diperlukan.</p>
                                    </div>
                                </div> 
                                <iframe src="{{ asset('berkas/'.$berkas->sk_kp.'') }}" style="width: 100%; height: 100vh" frameborder="0"></iframe>
                            @endif
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
@endsection