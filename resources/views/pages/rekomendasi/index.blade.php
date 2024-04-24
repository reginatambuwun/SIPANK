@extends('layouts.app')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Rekomendasi</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item">Rekomendasi</div>
      </div>
    </div>

    <div class="section-body">
      <div class="alert alert-light alert-has-icon">
        <div class="alert-icon"><i class="fas fa-info-circle"></i></div>
        <div class="alert-body">
          <div class="alert-title">Mohon Diperhatikan</div>
          <ul style="margin-left: -20px; margin-bottom: 0px">
            <li>Tidak dapat mengubah data rekomendasi jika status periode telah selesai.</li>
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
                <table id="datatable" class="table table-striped table-md">
                  <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Nilai</th>
                        <th>Rekomendasi</th>
                        <th>Aksi</th>
                      </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Modal Edit Rekomendasi -->
  <div class="modal fade" id="updateStatusModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <form id="editDataForm">
          <div class="modal-header">
            <h5 id="title">-</h5>
          </div>
          <div class="modal-body">
            <input type="hidden" id="dataId">
            <input type="hidden" name="direkomendasi" id="direkomendasi">
            <span id="content">-</span>
          </div>
          <div class="modal-footer">
            <button type="button" id="closeEditBtn" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
            <button type="submit" id="confirmEditBtn" class="btn btn-primary">Ya</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <input type="hidden" value={{request()->segment(3)}} id="idPeriode">
@endsection

@push('scripts')
  <script>
    $(function () {

      /*------------------------------------------ Render DataTable --------------------------------------------*/
      let url = '{{ route('rekomendasi.datatable', ':id') }}'; url = url.replace(':id', $('#idPeriode').val());
      let table = $('#datatable').DataTable({
        responsive: true,
        processing: true,
        serverSide: false,
        autoWidth: false,
        ajax: url,
        columns: [
          {data: 'DT_RowIndex', name: 'DT_RowIndex'},
          {data: 'nama_pengguna', name: 'nama_pengguna'},
          {data: 'nilai', name: 'nilai'},
          {data: 'direkomendasi', name: 'direkomendasi'},
          {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        columnDefs: [
          { className: "dt-center", targets: [ 0, 1, 2, 3, 4 ] }
        ]
      });

      // /*------------------------------------------ Show modal button edit periode --------------------------------------------*/
      $(document).on('click', '.show-update-status-modal', function () {
        
        let dataId = $(this).data('id');
        let url = '{{ route('rekomendasi.edit', ':id') }}'; url = url.replace(':id', dataId);
        $.get(url, function (data) {

          console.log('testing check ', data);
          $('#updateStatusModal').modal('show');
          $('#dataId').val(data.data.id);
          $('#direkomendasi').val(data.data.direkomendasi === 0 ? 1 : 0);

          if(data.data.direkomendasi === 1){
            $('#title').text('Batalkan rekomendasi');
            $('#content').text('Anda yakin akan membatalkan rekomendasi untuk pegawai ini?');
          }else if(data.data.direkomendasi === 0){
            $('#title').text('Rekomendasi naik pangkat');
            $('#content').text('Anda yakin akan merekomendasikan pegawai ini?');
          }

        }).fail(function(data) {
          const { status, message } = data.responseJSON;
          Swal.fire({
            title: 'Terjadi kesalahan',
            text: message,
            icon: status === 'warning' ? 'warning' : 'error',
            confirmButtonText: 'OK'
          })
        })
      });

      // /*------------------------------------------ Edit data status rekomendasi --------------------------------------------*/ 
      $('#editDataForm').submit(function (e) {
        e.preventDefault();
        $('#confirmEditBtn').html('Menyimpan...');
      
        let dataId = $('#dataId').val();
        let url = '{{ route('rekomendasi.update', ':id') }}'; url = url.replace(':id', dataId);

        // disable button while editing
        $("#confirmEditBtn").prop("disabled",true); 
        $("#closeEditBtn").prop("disabled",true);

        $.ajax({
          data: $('#editDataForm').serialize(),
          url: url,
          type: "PUT",
          dataType: 'json',
          success: function (data) {
            $('#editDataForm').trigger("reset");
            $('#updateStatusModal').modal('hide');
            table.ajax.reload();
            Swal.fire({
              title: 'Berhasil',
              text: 'Status berhasil diubah',
              icon: 'success',
              confirmButtonText: 'OK'
            })
          },
          error: function (data) {
            let html = "";
            const { status, message } = data.responseJSON;

            for (const key in message) {
              html += `<p style="">${message[key]}</p>`
            }
            Swal.fire({
              title: 'Terjadi kesalahan',
              html: status === 'validation error' ? html : message,
              icon: status === 'validation error' || status === 'warning' ? 'warning' : 'error',
              confirmButtonText: 'OK'
            })
          },
          complete: function(data) {
            $('#confirmEditBtn').html('Simpan');

            // enable button
            $("#confirmEditBtn").prop("disabled",false); 
            $("#closeEditBtn").prop("disabled",false);
          }
        });
      });

    });
  </script>
@endpush