@extends('layouts.app')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Daftar Arsip Berkas</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item">Daftar Arsip Berkas</div>
      </div>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <a href="{{ route('arsip.create') }}" class="btn btn-primary">
                Tambah <i class="fas fa-plus-square"></i>
              </a>
            </div>
            <div class="card-body p-4">
              <div class="table-responsive">
                <table id="datatable" class="table table-striped table-md text-center">
                  <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                      </tr>
                  </thead>
                  <tbody class="">
                    <?php $no=0; ?>
                    @foreach ($arsip as $value)
                      <?php $no++; ?>      
                      <tr>
                        <th>{{$no}}</th>
                        <th>{{$value->nama}}</th>
                        <th>{{$value->created_at->translatedFormat('l, d/m/Y')}}</th>
                        <th>
                          <a href="{{ route('arsip.show',$value->id) }}" class="edit btn btn-primary btn-sm">Lihat</a>
                          <a href="javascript:void(0)" data-toggle="tooltip" data-id={{$value->id}} class="btn btn-danger btn-sm show-delete-modal"><i class="fas fa-trash-alt"></i></a>
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

  <!-- Modal Delete Kriteria -->
  <div class="modal fade" id="deleteDataModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5>Hapus Data Arsip</h5>
        </div>
        <div class="modal-body">
          <input type="hidden" id="deleteDataId">
          Anda yakin akan menghapus?
        </div>
        <div class="modal-footer">
          <button type="button" id="closeDeleteBtn" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
          <button type="button" id="confirmDeleteBtn" class="btn btn-primary">Ya</button>
        </div>
      </div>
    </div>
  </div>

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

      // /*------------------------------------------ Show modal delete arsip --------------------------------------------*/ 
      $(document).on('click', '.show-delete-modal', function () {
        $('#deleteDataModal').modal('show');
        $('#deleteDataId').val($(this).data("id"));

        console.log('testing delete');
      });

      // /*------------------------------------------ Delete data arsip --------------------------------------------*/ 
      $('#confirmDeleteBtn').click(function (e) {
        $(this).html('Menghapus...');

        let dataId = $('#deleteDataId').val();
        let url = '{{ route('arsip.destroy', ':id') }}'; url = url.replace(':id', dataId);

        // disable button while deleting
        $("#confirmDeleteBtn").prop("disabled",true); 
        $("#closeDeleteBtn").prop("disabled",true);

        $.ajax({
          type: "DELETE",
          url : url,
          success: function (data) {
            $('#deleteDataModal').modal('hide');

            Swal.fire({
              title: 'Berhasil',
              text: 'Kriteria berhasil dihapus',
              icon: 'success',
              confirmButtonText: 'OK'
            })
          },
          error: function (data) {
            const { status, message } = data.responseJSON;
            Swal.fire({
              title: 'Terjadi kesalahan',
              text: message,
              icon: 'error',
              confirmButtonText: 'OK'
            })
          },
          complete: function(data) {
            $('#confirmDeleteBtn').html('Ya'); 

            // enable button
            $("#confirmDeleteBtn").prop("disabled",false);
            $("#closeDeleteBtn").prop("disabled",false);

            setTimeout(() => {
              location.reload();
            }, 1000);
          }
        });
      });

    });
  </script>
@endpush