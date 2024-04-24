@extends('layouts.app')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Daftar Pegawai</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item">Daftar Pegawai</div>
      </div>
    </div>

    <div class="section-body">
      <div class="alert alert-light alert-has-icon">
        <div class="alert-icon"><i class="fas fa-info-circle"></i></div>
        <div class="alert-body">
          <div class="alert-title">Mohon Diperhatikan</div>
          <p>Keterangan daftar status.</p>
          <ul>
            <li><strong>Diterima</strong> : Berkas yang dikirim pegawai telah ditinjau dan diterima</li>
            <li><strong>Dikirim</strong> : Pegawai telah mengirim berkas dan menunggu untuk ditinjau</li>
            <li><strong>Perbaikan</strong> : Berkas yang dikirim pegawai telah ditinjau dan perlu diperbaiki</li>
            <li><strong>Menunggu</strong> : Pegawai belum mengirim berkas</li>
          </ul> 
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <span class="badge badge-info">Periode : {{ $periode ? $periode->nama : '-' }}</span>
            </div>
            <div class="card-body p-4">
              <div class="table-responsive">
                <table id="datatable" class="table table-striped table-md text-center">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody class="">
                    <?php $no=0; ?>
                    @foreach ($alternatif as $value)
                      <?php $no++; ?>      
                      <tr>
                        <th>{{$no}}</th>
                        <th>{{$value->nama_pegawai}}</th>
                        <th>
                          @if($value->status_berkas === 'diterima')
                            <h6><span class="badge badge-success">Diterima</span></h6>
                          @elseif($value->status_berkas === 'dikirim')
                            <h6><span class="badge badge-info">Dikirim</span></h6>
                          @elseif($value->status_berkas === 'perbaikan')
                            <h6><span class="badge badge-warning">Perbaikan</span></h6>
                          @else
                            <h6><span class="badge badge-dark">Menunggu</span></h6>
                          @endif
                        </th>
                        <th>
                          <a href="{{ route('bkpsdm-periode-alternatif.detail',[request()->segment(4),$value->id]) }}" class="edit btn btn-primary btn-sm">Lihat</a>
                        </th>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@push('scripts')
  <script>
    $(function () {

      /*------------------------------------------ Render DataTable --------------------------------------------*/ 
      let table = $('#datatable').DataTable({
        responsive: true,
        processing: true,
        serverSide: false,
        autoWidth: false,
        columnDefs: [
          {"className": "dt-center", "targets": "_all"}
        ]
      });
    });
  </script>
@endpush