<aside>
    <div class="sidebar-brand">
        @if(Auth::user()->role === 'admin' || Auth::user()->role === 'pegawai')            
            <img src="{{asset('assets/img/dlh.png')}}" class="rounded-circle profile-widget-picture" style="object-fit: cover; width: 30px; height: 30px; border: 1px solid rgb(235, 235, 235)">
            &nbsp
        @endif
        <a href="{{ route ('home') }}">SI KEPANGKATAN</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        @if(Auth::user()->role === 'admin' || Auth::user()->role === 'pegawai')            
            <img src="{{asset('assets/img/dlh.png')}}" class="rounded-circle profile-widget-picture" style="object-fit: cover; width: 30px; height: 30px; border: 1px solid rgb(235, 235, 235)">
        @else
            <a href="index.html">SI</a>
        @endif
    </div>
    <ul class="sidebar-menu">
        {{-- <li class="menu-header">Dashboard</li> --}}
        <li class="{{ request()->segment(1) == '' ? 'active' : '' }}"><a class="nav-link" href="{{ route('home') }}"><i class="far fa-square"></i> <span>Dashboard</span></a></li>

        @if(Auth::user()->role == 'admin')
            {{-- <li class="{{ request()->segment(1) == 'pengguna' ? 'active' : '' }}"><a class="nav-link" href="{{ route('pengguna.index') }}"><i class="fas fa-users"></i> <span>Pengguna</span></a></li> --}}

            <li class="dropdown {{ request()->segment(1) == 'pengguna-bkpsdm' || request()->segment(1) == 'pengguna' ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown active"><i class="fas fa-users"></i><span>Pengguna</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->segment(1) == 'pengguna-bkpsdm' ? 'active' : '' }}"><a class="nav-link" href="{{ route('pengguna-bkpsdm.index') }}"><i class="far fa-square"></i> <span>BKPSDM</span></a></li>
                    <li class="{{ request()->segment(1) == 'pengguna' ? 'active' : '' }}"><a class="nav-link" href="{{ route('pengguna.index') }}"><i class="far fa-square"></i> <span>Pegawai</span></a></li>
                </ul>
            </li>

            {{-- <li class="dropdown {{ request()->segment(1) == 'kriteria' || request()->segment(1) == 'bobot-kriteria' ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown active"><i class="fas fa-list"></i><span>Kriteria</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->segment(1) == 'kriteria' ? 'active' : '' }}"><a class="nav-link" href="{{ route('kriteria.index') }}"><i class="far fa-square"></i> <span>Kriteria</span></a></li>
                    <li class="{{ request()->segment(1) == 'bobot-kriteria' ? 'active' : '' }}"><a class="nav-link" href="{{ route('bobot-kriteria.index') }}"><i class="far fa-square"></i> <span>Bobot Kriteria</span></a></li>
                </ul>
            </li> --}}
            {{-- <li class="dropdown {{ request()->segment(1) == 'sub-kriteria' || request()->segment(1) == 'bobot-sub-kriteria' ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown active"><i class="fas fa-list"></i><span>Sub Kriteria</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->segment(1) == 'sub-kriteria' ? 'active' : '' }}"><a class="nav-link" href="{{ route('sub-kriteria.index') }}"><i class="far fa-square"></i> <span>Sub Kriteria</span></a></li>
                    <li class="{{ request()->segment(1) == 'bobot-sub-kriteria' ? 'active' : '' }}"><a class="nav-link" href="{{ route('bobot-sub-kriteria.index') }}"><i class="far fa-square"></i> <span>Bobot Sub Kriteria</span></a></li>
                </ul>
            </li> --}}
            <li class="{{ request()->segment(1) == 'hitung-kriteria' ? 'active' : '' }}"><a class="nav-link" href="{{ route('hitung-kriteria.index') }}"><i class="fas fa-calculator"></i> <span>Hitung Kriteria</span></a></li>
            <li class="{{ request()->segment(1) == 'periode' ? 'active' : '' }}"><a class="nav-link" href="{{ route('periode.index') }}"><i class="far fa-calendar"></i> <span>Periode</span></a></li>
            <li class="{{ request()->segment(1) == 'alternatif' ? 'active' : '' }}"><a class="nav-link" href="{{ route('alternatif-daftar-periode.index') }}"><i class="fas fa-user-tag"></i> <span>Alternatif</span></a></li>
            {{-- <li class="{{ request()->segment(1) == 'rekomendasi' ? 'active' : '' }}"><a class="nav-link" href="{{ route('rekomendasi-daftar-periode.index') }}"><i class="fas fa-sort-numeric-up"></i> <span>Rekomendasi</span></a></li> --}}
        @endif

        @if(Auth::user()->role == 'pegawai')
            <li class="{{ request()->segment(1) == 'pengajuan-berkas' ? 'active' : '' }}"><a class="nav-link" href="{{ route('pengajuan-berkas.index') }}"><i class="fas fa-file-alt"></i> <span>Pengajuan Berkas</span></a></li>
            <li class="{{ request()->segment(1) == 'pegawai' && request()->segment(2) == 'periode' ? 'active' : '' }}"><a class="nav-link" href="{{ route('pegawai-periode.index') }}"><i class="far fa-calendar"></i> <span>Periode</span></a></li>
            <li class="{{ request()->segment(1) == 'arsip' ? 'active' : '' }}"><a class="nav-link" href="{{ route('arsip.index') }}"><i class="far fa-calendar"></i> <span>Arsip</span></a></li>
        @endif

        @if(Auth::user()->role == 'bkpsdm')
            <li class="{{ request()->segment(1) == 'bkpsdm' && request()->segment(2) == 'periode' ? 'active' : '' }}"><a class="nav-link" href="{{ route('bkpsdm-periode.index') }}"><i class="far fa-calendar"></i> <span>Periode</span></a></li>
        @endif
    </ul> 
</aside>