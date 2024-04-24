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
                    </div></div>
                    Ubah informasi tentang akun anda pada halaman ini.
                    @if(Auth::user()->role === 'pegawai')                       
                      <div class="text-right">
                        <a href="{{route('profil.detail')}}">Detail Profil</a>
                      </div>
                    @endif
                  </div>
                </div>
              </div>
              @if(Auth::user()->role == 'pegawai')
                @include('pages.profil.pegawai')
              @elseif(Auth::user()->role == 'admin' || Auth::user()->role == 'bkpsdm')
                @include('pages.profil.user')
              @endif
            </div>
          </div>
    </section>
@endsection