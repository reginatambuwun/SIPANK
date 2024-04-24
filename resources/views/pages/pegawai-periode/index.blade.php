@extends('layouts.app')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Daftar Periode</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item">Daftar Periode</div>
      </div>
    </div>

    <div class="section-body">
      <div class="alert alert-light alert-has-icon">
        <div class="alert-icon"><i class="fas fa-info-circle"></i></div>
        <div class="alert-body">
          <div class="alert-title">Mohon Diperhatikan</div>
          <p>Daftar yang ditampilkan adalah periode kenaikan pangkat yang melibatkan anda.</p>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body p-4">
              <div class="table-responsive">
                <table id="datatable" class="table table-striped table-md text-center">
                  <thead>
                      <tr>
                        <th>No</th>
                        <th>Periode</th>
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr>
                  </thead>
                  <tbody class="">
                    <?php $no=0; ?>
                    @foreach ($periode as $value)
                      <?php $no++; ?>      
                      <tr>
                        <th>{{$no}}</th>
                        <th>{{$value->nama_periode}}</th>
                        <th>
                          @if($value->status_periode === 'selesai')
                            <h6><span class="badge badge-success">Selesai</span></h6>
                          @elseif($value->status_periode === 'sementara')
                            <h6><span class="badge badge-info">Sementara</span></h6>
                          @endif
                        </th>
                        <th>
                          <a href="{{ route('pegawai-periode.detail',$value->id) }}" class="edit btn btn-primary btn-sm">Lihat</a>
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