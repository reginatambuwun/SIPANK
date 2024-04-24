@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Peninjauan Berkas</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Peninjauan Berkas</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-10">

                    <span class="badge badge-info mb-3">Pegawai : {{ $pegawai ? $pegawai->name : '-' }}</span>

                    @if($periode?->status === 'selesai')                                    
                        <div class="alert alert-success alert-has-icon">
                            <div class="alert-icon"><i class="fas fa-info-circle"></i></div>
                            <div class="alert-body">
                                <p>Status periode telah <strong>Selesai</strong>.</p>
                            </div>
                        </div>   
                    @endif

                    {{-- status berkas telah diterima --}}
                    @if ($berkas?->status === 'diterima') 
                        
                        {{-- periode belum selesai  --}}
                        @if ($periode?->status === 'sementara')
                        
                            <div class="alert alert-light alert-has-icon">
                                <div class="alert-icon"><i class="fas fa-info-circle"></i></div>
                                <div class="alert-body">
                                    <div class="alert-title">Mohon Diperhatikan</div>
                                    <p>Silahkan mengirim SK KP jika telah tersedia.</p>
                                </div>
                            </div>

                            <div class="card">
                                <form method="POST" action="{{ route('bkpsdm-periode-alternatif-sk-kp.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <input type="hidden" name="periode_id" value={{request()->segment(5)}}>
                                        <input type="hidden" name="alternatif_id" value={{request()->segment(6)}}>
                                        <div class="form-group">
                                            <label>Berkas SK KP</label>
                                            <input type="file" class="form-control" name="sk_kp">
                                            @if ($errors->has('sk_kp'))
                                                <label class="mt-2" style="color: red">
                                                    {{ $errors->first('sk_kp') }}
                                                </label>
                                            @endif
                                        </div>
                                        <div class="form-group text-right">
                                            <button type="submit" class="btn btn-primary">Kirim</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endif

                        <div class="card">
                            <div class="card-header">
                                <h4>Surat Keputusan Kenaikan Pangkat</h4>
                            </div>
                            <div class="card-body">
                                {{-- sk kp belum dikirim --}}
                                @if(!$berkas->sk_kp)
                                    <div class="alert alert-light alert-has-icon">
                                        <div class="alert-icon"><i class="fas fa-info-circle"></i></div>
                                        <div class="alert-body">
                                            <p>Berkas tidak tersedia.</p>
                                        </div>
                                    </div>
                                @else 
                                    {{-- periode belum selesai --}}
                                    @if($periode?->status === 'sementara')                                    
                                        <div class="alert alert-light alert-has-icon">
                                            <div class="alert-icon"><i class="fas fa-info-circle"></i></div>
                                            <div class="alert-body">
                                                <p>Berkas bisa dikirim kembali jika diperlukan.</p>
                                            </div>
                                        </div>   
                                    @endif
                                    <iframe src="{{ asset('berkas/'.$berkas->sk_kp.'') }}" style="width: 100%; height: 100vh" frameborder="0"></iframe>
                                @endif
                            </div>
                        </div>
                    @endif
                    
                    {{-- ada berkas yang harus diperbaiki --}}
                    @if($berkas?->status === 'perbaikan' && $peninjauan?->status === 'perbaikan')
                        <div class="alert alert-warning alert-has-icon">
                            <div class="alert-icon"><i class="fas fa-info-circle"></i></div>
                            <div class="alert-body">
                                <p>Berkas telah ditinjau dan perlu diperbaiki dengan keterangan:</p>
                                <p><strong>{{$peninjauan->keterangan}}</strong></p>
                            </div>
                        </div>
                    {{-- berkas telah diterima --}}
                    @elseif($berkas?->status === 'diterima')
                        <div class="alert alert-light alert-has-icon">
                            <div class="alert-icon"><i class="fas fa-info-circle"></i></div>
                            <div class="alert-body">
                                <p>Berkas dibawah ini telah ditinjau dan diterima.</p>
                            </div>
                        </div>
                    {{-- berkas belum ditinjau --}}
                    @else
                        <div class="alert alert-light alert-has-icon">
                            <div class="alert-icon"><i class="fas fa-info-circle"></i></div>
                            <div class="alert-body">
                                <div class="alert-title">Mohon Diperhatikan</div>
                                <p>Pastikan untuk meninjau dengan baik berkas yang diterima.</p>
                                <p>Jika terdapat berkas yang perlu diperbaiki, berikan keterangan untuk berkas yang dimaksud.</p>
                            </div>
                        </div>
                        <div class="card">
                            <form method="POST" action="{{ route('bkpsdm-periode-alternatif.store') }}">
                                @csrf
                                <div class="card-body">
                                    <input type="hidden" name="periode_id" value={{request()->segment(5)}}>
                                    <input type="hidden" name="alternatif_id" value={{request()->segment(6)}}>
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <textarea name="keterangan" class="form-control"></textarea>
                                        @if ($errors->has('keterangan'))
                                            <label class="mt-2" style="color: red">
                                                {{ $errors->first('keterangan') }}
                                            </label>
                                        @endif
                                    </div>
                                    <fieldset class="form-group">
                                        <label>Status</label>
                                        <div class="row">
                                            <div class="col-sm-10">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status" id="status1" value="diterima">
                                                    <label class="form-check-label" for="status1">
                                                    Diterima
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status" id="status2" value="perbaikan">
                                                    <label class="form-check-label" for="status2">
                                                    Perbaikan
                                                    </label>
                                                </div>
                                                @if ($errors->has('status'))
                                                    <label class="mt-2" style="color: red">
                                                        {{ $errors->first('status') }}
                                                    </label>
                                                @endif
                                            </div>
                                        </div>
                                    </fieldset>
                                    <div class="form-group text-right">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endif


                    <div class="card">
                        <div class="card-header">
                            <h4>Surat Pengantar Dari Instansi</h4>
                        </div>
                        <div class="card-body">
                            @if(!$berkas->surat_pengantar_instansi)
                                <div class="alert alert-light alert-has-icon">
                                    <div class="alert-icon"><i class="fas fa-info-circle"></i></div>
                                    <div class="alert-body">
                                        <p>Berkas tidak tersedia.</p>
                                    </div>
                                </div>
                            @else    
                                <iframe src="{{ asset('berkas/'.$berkas->surat_pengantar_instansi.'') }}" style="width: 100%; height: 100vh" frameborder="0"></iframe>
                            @endif
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4>SK CPNS DAN PNS</h4>
                        </div>
                        <div class="card-body">
                            @if(!$berkas->sk_cpns_pns)
                                <div class="alert alert-light alert-has-icon">
                                    <div class="alert-icon"><i class="fas fa-info-circle"></i></div>
                                    <div class="alert-body">
                                        <p>Berkas tidak tersedia.</p>
                                    </div>
                                </div>
                            @else    
                                <iframe src="{{ asset('berkas/'.$berkas->sk_cpns_pns.'') }}" style="width: 100%; height: 100vh" frameborder="0"></iframe>
                            @endif
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4>Kartu Pegawai</h4>
                        </div>
                        <div class="card-body">
                            @if(!$berkas->kartu_pegawai)
                                <div class="alert alert-light alert-has-icon">
                                    <div class="alert-icon"><i class="fas fa-info-circle"></i></div>
                                    <div class="alert-body">
                                        <p>Berkas tidak tersedia.</p>
                                    </div>
                                </div>
                            @else    
                                <iframe src="{{ asset('berkas/'.$berkas->kartu_pegawai.'') }}" style="width: 100%; height: 100vh" frameborder="0"></iframe>
                            @endif
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4>SKP 1 Tahun Terakhir</h4>
                        </div>
                        <div class="card-body">
                            @if(!$berkas->skp)
                                <div class="alert alert-light alert-has-icon">
                                    <div class="alert-icon"><i class="fas fa-info-circle"></i></div>
                                    <div class="alert-body">
                                        <p>Berkas tidak tersedia.</p>
                                    </div>
                                </div>
                            @else    
                                <iframe src="{{ asset('berkas/'.$berkas->skp.'') }}" style="width: 100%; height: 100vh" frameborder="0"></iframe>
                            @endif
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4>SK Pangkat Akhir</h4>
                        </div>
                        <div class="card-body">
                            @if(!$berkas->sk_pangkat_akhir)
                                <div class="alert alert-light alert-has-icon">
                                    <div class="alert-icon"><i class="fas fa-info-circle"></i></div>
                                    <div class="alert-body">
                                        <p>Berkas tidak tersedia.</p>
                                    </div>
                                </div>
                            @else    
                                <iframe src="{{ asset('berkas/'.$berkas->sk_pangkat_akhir.'') }}" style="width: 100%; height: 100vh" frameborder="0"></iframe>
                            @endif
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4>SK Jabatan Akhir</h4>
                        </div>
                        <div class="card-body">
                            @if(!$berkas->sk_jabatan_akhir)
                                <div class="alert alert-light alert-has-icon">
                                    <div class="alert-icon"><i class="fas fa-info-circle"></i></div>
                                    <div class="alert-body">
                                        <p>Berkas tidak tersedia.</p>
                                    </div>
                                </div>
                            @else    
                                <iframe src="{{ asset('berkas/'.$berkas->sk_jabatan_akhir.'') }}" style="width: 100%; height: 100vh" frameborder="0"></iframe>
                            @endif
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4>Ijazah Terakhir Yang Dilegalisir</h4>
                        </div>
                        <div class="card-body">
                            @if(!$berkas->ijazah)
                                <div class="alert alert-light alert-has-icon">
                                    <div class="alert-icon"><i class="fas fa-info-circle"></i></div>
                                    <div class="alert-body">
                                        <p>Berkas tidak tersedia.</p>
                                    </div>
                                </div>
                            @else    
                                <iframe src="{{ asset('berkas/'.$berkas->ijazah.'') }}" style="width: 100%; height: 100vh" frameborder="0"></iframe>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection