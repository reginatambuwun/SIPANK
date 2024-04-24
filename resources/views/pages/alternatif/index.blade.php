@extends('layouts.app')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Daftar Alternatif</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item">Daftar Alternatif</div>
      </div>
    </div>

    <div class="section-body">
      <div class="alert alert-light alert-has-icon">
        <div class="alert-icon"><i class="fas fa-info-circle"></i></div>
        <div class="alert-body">
          <div class="alert-title">Mohon Diperhatikan</div>
          <ul style="margin-left: -20px; margin-bottom: 0px">
            <li>Tidak dapat menambah/mengubah data alternatif jika status periode telah selesai.</li>
          </ul> 
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <a href="{{ route('alternatif.create',request()->segment(3)) }}" class="btn btn-primary">
                Tambah <i class="fas fa-plus-square"></i>
              </a>
            </div>
            <div class="card-body p-4">
              <div class="table-responsive">
                <table id="datatable" class="table table-striped table-md text-center">
                  <thead>
                      <tr>
                        <th>No</th>
                        <th>Pegawai</th>
                        @foreach ($kriteria as $item)    
                          <th>{{$item->nama_kriteria}}</th>
                        @endforeach
                        <th>Nilai</th>
                        <th>Aksi</th>
                      </tr>
                  </thead>
                  <tbody class="">
                    <?php $no=0; ?>
                    @foreach ($daftarAlternatif as $value)
                      <?php $no++; ?>      
                      <tr>
                        <th>{{$no}}</th>
                        <th>{{$value['nama_pegawai']}}</th>
                        @foreach ($value['subkriteria'] as $item)
                          <th>{{$item->nama_subkriteria}}</th>
                        @endforeach
                        <th>{{$value['nilai']}}</th>
                        <th>
                          {{-- <a href="{{ route('alternatif.edit',$value['id']) }}" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i></a> --}}
                          <a href="javascript:void(0)" data-alternatif={{$value['id']}} data-periode={{request()->segment(3)}} class="btn btn-danger btn-sm show-delete-modal"><i class="fas fa-trash-alt"></i></a>
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

  <!-- Modal Delete Alternatif -->
  <div class="modal fade" id="deleteDataModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5>Hapus Data Alternatif</h5>
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

      // /*------------------------------------------ Show modal delete periode --------------------------------------------*/ 
      $(document).on('click', '.show-delete-modal', function () {
        $('#deleteDataModal').modal('show');
        $('#deleteDataId').val($(this).data("alternatif"));
      });

      // /*------------------------------------------ Delete data periode --------------------------------------------*/ 
      $('#confirmDeleteBtn').click(function (e) {
        $(this).html('Menghapus...');

        let dataId = $('#deleteDataId').val();
        let url = '{{ route('alternatif.destroy', ':id') }}'; url = url.replace(':id', dataId);

        // disable button while deleting
        $("#confirmDeleteBtn").prop("disabled",true); 
        $("#closeDeleteBtn").prop("disabled",true);

        $.ajax({
          type: "DELETE",
          url : url,
          success: function (data) {
            $('#deleteDataModal').modal('hide');
            location.reload();
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
          }
        });
      });

    });
  </script>
@endpush