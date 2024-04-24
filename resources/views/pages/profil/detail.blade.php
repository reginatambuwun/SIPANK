@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Profil</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Profil</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row justify-content-center">
              <div class="col-12 col-md-8">
                <div class="card profile-widget">
                  <div class="profile-widget-header">
                    @if($data?->image)
                      <img alt="image" src="{{asset('image/'.$data->image.'')}}" class="rounded-circle profile-widget-picture" style="object-fit: cover; width: 100px; height: 100px; border: 1px solid rgb(235, 235, 235)">
                    @else
                      <img alt="image" src="{{asset('assets/img/avatar/avatar-1.png')}}" class="rounded-circle profile-widget-picture">
                    @endif                     
                  </div>
                  <div class="profile-widget-description">
                    <div class="profile-widget-name">{{Auth::user()->name}} <div class="text-muted d-inline font-weight-normal"><div class="slash"></div>
                      @if(Auth::user()->role == 'admin')
                        Admin
                      @elseif(Auth::user()->role == 'bkpsdm')
                        BKPSDM
                      @elseif(Auth::user()->role == 'pegawai')
                        Pegawai
                      @endif
                      </div>
                    </div>
                    {{$data?->email ?? '-'}}
                  </div>
                </div>
                <div class="card profile-widget">
                  <div class="" style="padding: 20px">
                    <a href="{{route('profil-detail.edit', Auth::id())}}">Ubah Detail Profil</a>
                  </div>
                  <div class="row">      
                    <div class="col-md-6 col-12">
                      <div class="" style="padding-top: 15px; padding-bottom: 15px; padding-left: 20px; padding-right: 20px;">
                        <div class="" style="font-weight: bold">No. Induk Pegawai</div>
                        {{$data?->nip ?? '-'}}
                      </div>
                    </div>
                    <div class="col-md-6 col-12">
                      <div class="" style="padding-top: 15px; padding-bottom: 15px; padding-left: 20px; padding-right: 20px;">
                        <div class="" style="font-weight: bold">No. Induk Pegawai Lama</div>
                        {{$data?->nipl ?? '-'}}
                      </div>
                    </div>
                  </div>

                  <div class="row">      
                    <div class="col-md-6 col-12">
                      <div class="" style="padding-top: 15px; padding-bottom: 15px; padding-left: 20px; padding-right: 20px;">
                        <div class="" style="font-weight: bold">Gelar Depan</div>
                        {{$data?->gelar_depan ?? '-'}}
                      </div>
                    </div>
                    <div class="col-md-6 col-12">
                      <div class="" style="padding-top: 15px; padding-bottom: 15px; padding-left: 20px; padding-right: 20px;">
                        <div class="" style="font-weight: bold">Gelar Belakang</div>
                        {{$data?->gelar_belakang ?? '-'}}
                      </div>
                    </div>
                  </div>

                  <div class="row">      
                    <div class="col-md-6 col-12">
                      <div class="" style="padding-top: 15px; padding-bottom: 15px; padding-left: 20px; padding-right: 20px;">
                        <div class="" style="font-weight: bold">Jabatan</div>
                        {{$data?->jabatan ?? '-'}}
                      </div>
                    </div>
                    <div class="col-md-6 col-12">
                      <div class="" style="padding-top: 15px; padding-bottom: 15px; padding-left: 20px; padding-right: 20px;">
                        <div class="" style="font-weight: bold">Tempat/Tanggal Lahir</div>
                        {{$data?->tempat_lahir ?? '-'}}, {{ $data?->tanggal_lahir ? Carbon\Carbon::parse($data?->tanggal_lahir)->format('d-m-Y') : '-'}}
                      </div>
                    </div>
                  </div>

                  <div class="row">      
                    <div class="col-md-6 col-12">
                      <div class="" style="padding-top: 15px; padding-bottom: 15px; padding-left: 20px; padding-right: 20px;">
                        <div class="" style="font-weight: bold">Jenis Kelamin</div>
                        {{$data?->jenis_kelamin === 'L' ? 'Laki-Laki' : '' }} {{ $data?->jenis_kelamin === 'P' ? 'Perempuan' : ''}}
                      </div>
                    </div>
                    <div class="col-md-6 col-12">
                      <div class="" style="padding-top: 15px; padding-bottom: 15px; padding-left: 20px; padding-right: 20px;">
                        <div class="" style="font-weight: bold">Golongan Darah</div>
                        {{$data?->gol_darah ?? '-'}}
                      </div>
                    </div>
                  </div>

                  <div class="row">      
                    <div class="col-md-6 col-12">
                      <div class="" style="padding-top: 15px; padding-bottom: 15px; padding-left: 20px; padding-right: 20px;">
                        <div class="" style="font-weight: bold">Identitas Diri</div>
                        {{$data?->identitas_diri ?? '-' }}
                      </div>
                    </div>
                    <div class="col-md-6 col-12">
                      <div class="" style="padding-top: 15px; padding-bottom: 15px; padding-left: 20px; padding-right: 20px;">
                        <div class="" style="font-weight: bold">No. Identitas</div>
                        {{$data?->nomor_identitas ?? '-'}}
                      </div>
                    </div>
                  </div>

                  <div class="row">      
                    <div class="col-md-6 col-12">
                      <div class="" style="padding-top: 15px; padding-bottom: 15px; padding-left: 20px; padding-right: 20px;">
                        <div class="" style="font-weight: bold">No. NPWP</div>
                        {{$data?->npwp ?? '-' }}
                      </div>
                    </div>
                    <div class="col-md-6 col-12">
                      <div class="" style="padding-top: 15px; padding-bottom: 15px; padding-left: 20px; padding-right: 20px;">
                        <div class="" style="font-weight: bold">Alamat Rumah</div>
                        {{$data?->alamat ?? '-'}}
                      </div>
                    </div>
                  </div>

                  <div class="row">      
                    <div class="col-md-6 col-12">
                      <div class="" style="padding-top: 15px; padding-bottom: 15px; padding-left: 20px; padding-right: 20px;">
                        <div class="" style="font-weight: bold">Kelurahan/Desa</div>
                        {{$data?->kelurahan_desa ?? '-' }}
                      </div>
                    </div>
                    <div class="col-md-6 col-12">
                      <div class="" style="padding-top: 15px; padding-bottom: 15px; padding-left: 20px; padding-right: 20px;">
                        <div class="" style="font-weight: bold">Kecamatan</div>
                        {{$data?->kecamatan ?? '-'}}
                      </div>
                    </div>
                  </div>

                  <div class="row">      
                    <div class="col-md-6 col-12">
                      <div class="" style="padding-top: 15px; padding-bottom: 15px; padding-left: 20px; padding-right: 20px;">
                        <div class="" style="font-weight: bold">Kabupatan/Kota</div>
                        {{$data?->kab_kota ?? '-' }}
                      </div>
                    </div>
                    <div class="col-md-6 col-12">
                      <div class="" style="padding-top: 15px; padding-bottom: 15px; padding-left: 20px; padding-right: 20px;">
                        <div class="" style="font-weight: bold">Kode Pos</div>
                        {{$data?->kode_pos ?? '-'}}
                      </div>
                    </div>
                  </div>

                  <div class="row">      
                    <div class="col-md-6 col-12">
                      <div class="" style="padding-top: 15px; padding-bottom: 15px; padding-left: 20px; padding-right: 20px;">
                        <div class="" style="font-weight: bold">No. Telp. Rumah / HP</div>
                        {{$data?->no_telp ?? '-' }}
                      </div>
                    </div>
                    <div class="col-md-6 col-12">
                      <div class="" style="padding-top: 15px; padding-bottom: 15px; padding-left: 20px; padding-right: 20px;">
                        <div class="" style="font-weight: bold">Agama</div>
                        {{$data?->agama ?? '-'}}
                      </div>
                    </div>
                  </div>

                  <div class="row">      
                    <div class="col-md-6 col-12">
                      <div class="" style="padding-top: 15px; padding-bottom: 15px; padding-left: 20px; padding-right: 20px;">
                        <div class="" style="font-weight: bold">Status Pernihakan</div>
                        {{$data?->status_pernikahan ?? '-' }}
                      </div>
                    </div>
                    <div class="col-md-6 col-12">
                      <div class="" style="padding-top: 15px; padding-bottom: 15px; padding-left: 20px; padding-right: 20px;">
                        <div class="" style="font-weight: bold">Tinggi/Berat Badan</div>
                        {{$data?->tinggi ?? '-' }} Cm / {{$data?->berat_badan ?? '-' }} Kg
                      </div>
                    </div>
                  </div>

                  <div class="row">      
                    <div class="col-md-6 col-12">
                      <div class="" style="padding-top: 15px; padding-bottom: 15px; padding-left: 20px; padding-right: 20px;">
                        <div class="" style="font-weight: bold">Hobi</div>
                        {{$data?->hobi ?? '-'}}
                      </div>
                    </div>
                    <div class="col-md-6 col-12">
                      <div class="" style="padding-top: 15px; padding-bottom: 15px; padding-left: 20px; padding-right: 20px;">
                        <div class="" style="font-weight: bold">TMT Bekerja/CPNS</div>
                        {{-- {{$data?->tmt_bekerja_cpns->translatedFormat('d/m/Y') ?? '-' }} --}}
                        {{ $data?->tmt_bekerja_cpns ? Carbon\Carbon::parse($data?->tmt_bekerja_cpns)->format('d-m-Y') : '-'}}
                      </div>
                    </div>
                  </div>

                  <div class="row">      
                    <div class="col-md-6 col-12">
                      <div class="" style="padding-top: 15px; padding-bottom: 15px; padding-left: 20px; padding-right: 20px;">
                        <div class="" style="font-weight: bold">Gol/Ruang Awal</div>
                        {{$data?->gol_ruang_awal ?? '-'}}
                      </div>
                    </div>
                    <div class="col-md-6 col-12">
                      <div class="" style="padding-top: 15px; padding-bottom: 15px; padding-left: 20px; padding-right: 20px;">
                        <div class="" style="font-weight: bold">TMT SK Akhir</div>
                        {{ $data?->tmt_bekerja_cpns ? Carbon\Carbon::parse($data?->tmt_sk_akhir)->format('d-m-Y') : '-'}}
                      </div>
                    </div>
                  </div>

                  <div class="row">      
                    <div class="col-md-6 col-12">
                      <div class="" style="padding-top: 15px; padding-bottom: 15px; padding-left: 20px; padding-right: 20px;">
                        <div class="" style="font-weight: bold">Nilai SKP 1 Tahun Terakhir</div>
                        {{$data?->nilai_skp ?? '-'}}
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
    </section>
@endsection