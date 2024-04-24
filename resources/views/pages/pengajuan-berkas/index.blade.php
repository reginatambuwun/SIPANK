@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Pengajuan Berkas</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Pengajuan Berkas</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    {{-- Tidak ada periode yang terkait dengan yang user ini --}}
                    @if(!$berkas)    
                        <div class="alert alert-warning alert-has-icon">
                            <div class="alert-icon"><i class="fas fa-info-circle"></i></div>
                            <div class="alert-body">
                                <div class="alert-title">Info</div>
                                Anda belum terdaftar dalam proses pengajuan kenaikan pangkat.
                            </div>
                        </div>
                    {{--  --}}
                    @elseif(!$perankingan || $perankingan?->direkomendasi === 0)    
                        <div class="alert alert-warning alert-has-icon">
                            <div class="alert-icon"><i class="fas fa-info-circle"></i></div>
                            <div class="alert-body">
                                <div class="alert-title">Info</div>
                                Anda telah terdaftar dalam proses pengajuan kenaikan pangkat, tapi belum direkomendasikan.
                            </div>
                        </div>
                    {{-- Ada periode yg terkait dengan user ini, dan status berkas masih NULL --}}
                    @elseif($berkas && !$berkas->status)
                        <div class="alert alert-info alert-has-icon">
                            <div class="alert-icon"><i class="fas fa-info-circle"></i></div>
                            <div class="alert-body">
                                <div class="alert-title">Info</div>
                                <p>Anda direkomendasikan pada periode <strong>{{ $periode->nama_periode }}</strong>.</p>
                                <p>Pastikan untuk memasukkan berkas yang valid, sesuai dengan syarat yang ada.</p>
                            </div>
                        </div>
                    {{-- Ada periode yg terkait dengan user ini dengan status berkas "dikirim" --}}
                    @elseif($berkas && $berkas->status === 'dikirim')
                        <div class="alert alert-success alert-has-icon">
                            <div class="alert-icon"><i class="fas fa-info-circle"></i></div>
                            <div class="alert-body">
                                <div class="alert-title">Info</div>
                                <p>Berkas telah dikirim, sambil menunggu proses peninjauan berkas dari pihak BKPSDM anda bisa mengirim kembali berkas jika diperlukan atau ada yang keliru.</p>
                            </div>
                        </div>
                    {{-- Ada periode yg terkait dengan user ini dengan status berkas "perbaikan" --}}
                    @elseif($berkas && $berkas->status === 'perbaikan')
                        <div class="alert alert-warning alert-has-icon">
                            <div class="alert-icon"><i class="fas fa-info-circle"></i></div>
                            <div class="alert-body">
                                <div class="alert-title">Info</div>
                                <p>Berkas yang dikirim masih harus diperbaiki sesuai dengan keterangan yang diberikan, periksa dan kirim kembali.</p>
                            </div>
                        </div>
                    {{-- Ada periode yg terkait dengan user ini dengan status berkas "diterima" --}}
                    @elseif($berkas && $berkas->status === 'diterima')
                        <div class="alert alert-success alert-has-icon">
                            <div class="alert-icon"><i class="fas fa-info-circle"></i></div>
                            <div class="alert-body">
                                <div class="alert-title">Info</div>
                                <p>Berkas anda telah diterima, silahkan menunggu pemberitahuan selanjutnya.</p>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Berkas yang dikirim harus diperbaiki --}}
                @if($berkas?->status === 'perbaikan' && $peninjauanBerkas?->status === 'perbaikan')                    
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card card-primary">
                            <div class="card-body">
                                <h6>Keterangan Perbaikan</h6>
                                <p style="margin-bottom: -5px">{{ $peninjauanBerkas->keterangan }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            {{-- terdaftar periode kenaikan pangkat dan telah direkomendasikan --}}
            @if($berkas && !$berkas->status && $perankingan?->direkomendasi === 1)
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <form method="POST" action="{{ route('pengajuan-berkas.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <input type="hidden" name="periode_id" value={{$periode->periode_id}}>
                                    <input type="hidden" name="alternatif_id" value={{$periode->alternatif_id}}>
                                    <div class="form-row">
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label><strong>Surat Pengantar Dari Instansi</strong></label>
                                                <input type="file" class="form-control" name="surat_pengantar_instansi">
                                                @if ($errors->has('surat_pengantar_instansi'))
                                                    <label class="mt-2" style="color: red">
                                                        {{ $errors->first('surat_pengantar_instansi') }}
                                                    </label>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label><strong>SK CPNS DAN PNS</strong></label>
                                                <input type="file" class="form-control" name="sk_cpns_pns">
                                                @if ($errors->has('sk_cpns_pns'))
                                                    <label class="mt-2" style="color: red">
                                                        {{ $errors->first('sk_cpns_pns') }}
                                                    </label>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label><strong>Kartu Pegawai</strong></label>
                                                <input type="file" class="form-control" name="kartu_pegawai">
                                                @if ($errors->has('kartu_pegawai'))
                                                    <label class="mt-2" style="color: red">
                                                        {{ $errors->first('kartu_pegawai') }}
                                                    </label>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label><strong>SKP 1 Tahun Terakhir</strong></label>
                                                <input type="file" class="form-control" name="skp">
                                                @if ($errors->has('skp'))
                                                    <label class="mt-2" style="color: red">
                                                        {{ $errors->first('skp') }}
                                                    </label>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label><strong>SK Pangkat Akhir</strong></label>
                                                <input type="file" class="form-control" name="sk_pangkat_akhir">
                                                @if ($errors->has('sk_pangkat_akhir'))
                                                    <label class="mt-2" style="color: red">
                                                        {{ $errors->first('sk_pangkat_akhir') }}
                                                    </label>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label><strong>SK Jabatan Akhir</strong></label>
                                                <input type="file" class="form-control" name="sk_jabatan_akhir">
                                                @if ($errors->has('sk_jabatan_akhir'))
                                                    <label class="mt-2" style="color: red">
                                                        {{ $errors->first('sk_jabatan_akhir') }}
                                                    </label>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label><strong>Ijazah Terakhir Yang Dilegalisir</strong></label>
                                                <input type="file" class="form-control" name="ijazah">
                                                @if ($errors->has('ijazah'))
                                                    <label class="mt-2" style="color: red">
                                                        {{ $errors->first('ijazah') }}
                                                    </label>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary">Kirim Berkas</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @elseif($berkas && ($berkas->status === 'dikirim' || $berkas->status === 'perbaikan'))
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <form method="POST" action="{{ route('pengajuan-berkas.update') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="_method" value="PATCH">
                                <div class="card-body">
                                    <input type="hidden" name="periode_id" value={{$periode->periode_id}}>
                                    <input type="hidden" name="alternatif_id" value={{$periode->alternatif_id}}>
                                    <div class="form-row">
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label><strong>Surat Pengantar Dari instansi : {{ explode("---",$berkas->surat_pengantar_instansi)[0] }}</strong></label>
                                                @if($berkas->status === 'perbaikan')
                                                    <input type="file" class="form-control" name="surat_pengantar_instansi">
                                                @endif
                                                @if ($errors->has('surat_pengantar_instansi'))
                                                    <label class="mt-2" style="color: red">
                                                        {{ $errors->first('surat_pengantar_instansi') }}
                                                    </label>
                                                @endif
                                                <hr>
                                                <a href="{{ route('unduh-berkas', $berkas->surat_pengantar_instansi) }}" class="btn btn-info">Unduh</a>
                                                <a href="{{ asset('berkas/'.$berkas->surat_pengantar_instansi.'') }}" class="btn btn-secondary" target="blink">Lihat</a>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label><strong>SK CPNS DAN PNS : {{ explode("---",$berkas->sk_cpns_pns)[0] }}</strong></label>
                                                @if($berkas->status === 'perbaikan')                                                    
                                                    <input type="file" class="form-control" name="sk_cpns_pns">
                                                @endif
                                                @if ($errors->has('sk_cpns_pns'))
                                                    <label class="mt-2" style="color: red">
                                                        {{ $errors->first('sk_cpns_pns') }}
                                                    </label>
                                                @endif
                                                <hr>
                                                <a href="{{ route('unduh-berkas', $berkas->sk_cpns_pns) }}" class="btn btn-info">Unduh</a>
                                                <a href="{{ asset('berkas/'.$berkas->sk_cpns_pns.'') }}" class="btn btn-secondary" target="blink">Lihat</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label><strong>Kartu Pegawai : {{ explode("---",$berkas->kartu_pegawai)[0] }}</strong></label>
                                                @if($berkas->status === 'perbaikan')                                                    
                                                    <input type="file" class="form-control" name="kartu_pegawai">
                                                @endif
                                                @if ($errors->has('kartu_pegawai'))
                                                    <label class="mt-2" style="color: red">
                                                        {{ $errors->first('kartu_pegawai') }}
                                                    </label>
                                                @endif
                                                <hr>
                                                <a href="{{ route('unduh-berkas', $berkas->kartu_pegawai) }}" class="btn btn-info">Unduh</a>
                                                <a href="{{ asset('berkas/'.$berkas->kartu_pegawai.'') }}" class="btn btn-secondary" target="blink">Lihat</a>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label><strong>SKP 1 Tahun Terakhir : {{ explode("---",$berkas->skp)[0] }}</strong></label>
                                                @if($berkas->status === 'perbaikan')                                                    
                                                    <input type="file" class="form-control" name="skp">
                                                @endif
                                                @if ($errors->has('skp'))
                                                    <label class="mt-2" style="color: red">
                                                        {{ $errors->first('skp') }}
                                                    </label>
                                                @endif
                                                <hr>
                                                <a href="{{ route('unduh-berkas', $berkas->skp) }}" class="btn btn-info">Unduh</a>
                                                <a href="{{ asset('berkas/'.$berkas->skp.'') }}" class="btn btn-secondary" target="blink">Lihat</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label><strong>SK Pangkat Akhir : {{ explode("---",$berkas->sk_pangkat_akhir)[0] }}</strong></label>
                                                @if($berkas->status === 'perbaikan')                                                    
                                                    <input type="file" class="form-control" name="sk_pangkat_akhir">
                                                @endif
                                                @if ($errors->has('sk_pangkat_akhir'))
                                                    <label class="mt-2" style="color: red">
                                                        {{ $errors->first('sk_pangkat_akhir') }}
                                                    </label>
                                                @endif
                                                <hr>
                                                <a href="{{ route('unduh-berkas', $berkas->sk_pangkat_akhir) }}" class="btn btn-info">Unduh</a>
                                                <a href="{{ asset('berkas/'.$berkas->sk_pangkat_akhir.'') }}" class="btn btn-secondary" target="blink">Lihat</a>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label><strong>SK Jabatan Akhir : {{ explode("---",$berkas->sk_jabatan_akhir)[0] }}</strong></label>
                                                @if($berkas->status === 'perbaikan')                                                    
                                                    <input type="file" class="form-control" name="sk_jabatan_akhir">
                                                @endif
                                                @if ($errors->has('sk_jabatan_akhir'))
                                                    <label class="mt-2" style="color: red">
                                                        {{ $errors->first('sk_jabatan_akhir') }}
                                                    </label>
                                                @endif
                                                <hr>
                                                <a href="{{ route('unduh-berkas', $berkas->sk_jabatan_akhir) }}" class="btn btn-info">Unduh</a>
                                                <a href="{{ asset('berkas/'.$berkas->sk_jabatan_akhir.'') }}" class="btn btn-secondary" target="blink">Lihat</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label><strong>Ijazah Terakhir Yang Dilegalisir : {{ explode("---",$berkas->ijazah)[0] }}</strong></label>
                                                @if($berkas->status === 'perbaikan')                                                    
                                                    <input type="file" class="form-control" name="ijazah">
                                                @endif
                                                @if ($errors->has('ijazah'))
                                                    <label class="mt-2" style="color: red">
                                                        {{ $errors->first('ijazah') }}
                                                    </label>
                                                @endif
                                                <hr>
                                                <a href="{{ route('unduh-berkas', $berkas->ijazah) }}" class="btn btn-info">Unduh</a>
                                                <a href="{{ asset('berkas/'.$berkas->ijazah.'') }}" class="btn btn-secondary" target="blink">Lihat</a>
                                            </div>
                                        </div>
                                    </div>
                                    @if($berkas->status === 'perbaikan')                                                    
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-primary">Kirim Berkas</button>
                                        </div>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </section>
@endsection