@extends('layouts.app')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Daftar BKPSDM</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item">BKPSDM</div>
      </div>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <button id="showAddModalBtn" type="button" class="btn btn-primary">
                Tambah <i class="fas fa-plus-square"></i>
              </button>
            </div>
            <div class="card-body p-4">
              <div class="table-responsive">
                <table id="datatable" class="table table-striped table-md">
                  <thead>
                      <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
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
    
  <!-- Modal Add New User -->
  <div class="modal fade" id="addNewUserModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <form id="newUserForm">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Tambah BKPSDM</h5>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Nama</label>
              <input type="text" name="name" class="form-control" required="">
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" name="email" class="form-control" required="">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" id="closeAddBtn" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" id="confirmAddBtn" class="btn btn-primary" >Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Edit User -->
  <div class="modal fade" id="editUserModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <form id="editUserForm">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Ubah Data</h5>
          </div>
          <div class="modal-body">
            <input type="hidden" id="editUserId">
            <div class="form-group">
              <label>Nama</label>
              <input type="text" id="name" name="name" class="form-control" required="">
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" id="email" name="email" class="form-control" required="">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" id="closeEditBtn" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" id="confirmEditBtn" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Delete User -->
  <div class="modal fade" id="deleteUserModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5>Hapus Data BKPSDM</h5>
        </div>
        <div class="modal-body">
          <input type="hidden" id="deleteUserId">
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
        ajax: "{{ route('bkpsdm.datatable') }}",
        columns: [
          {data: 'DT_RowIndex', name: 'DT_RowIndex'},
          {data: 'name', name: 'name'},
          {data: 'email', name: 'email'},
          {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        columnDefs: [
          { className: "dt-center", targets: [ 0, 1, 2, 3 ] }
        ]
      });

      /*------------------------------------------ Show modal button add new user --------------------------------------------*/ 
      $('#showAddModalBtn').click(function () {
        $('#newUserForm').trigger("reset");
        $('#addNewUserModal').modal('show');
      });

      /*------------------------------------------ Create new user --------------------------------------------*/ 
      $('#newUserForm').submit(function (e) {
        e.preventDefault();
        $('#confirmAddBtn').html('Menyimpan...');
      
        // disable button while editing
        $("#confirmAddBtn").prop("disabled",true); 
        $("#closeAddBtn").prop("disabled",true);

        $.ajax({
          data: $('#newUserForm').serialize(),
          url: "{{ route('pengguna-bkpsdm.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
            $('#newUserForm').trigger("reset");
            $('#addNewUserModal').modal('hide');
            table.ajax.reload();
            Swal.fire({
              title: 'Berhasil',
              text: 'BKPSDM berhasil disimpan',
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
              icon: status === 'validation error' ? 'warning' : 'error',
              confirmButtonText: 'OK'
            })
          },
          complete: function(data) {
            $('#confirmAddBtn').html('Simpan');

            // enable button
            $("#confirmAddBtn").prop("disabled",false); 
            $("#closeAddBtn").prop("disabled",false);
          }
        });
      });

      /*------------------------------------------ Show modal button edit user --------------------------------------------*/
      $(document).on('click', '.show-edit-modal', function () {
        
        let userId = $(this).data('id');
        let url = '{{ route('pengguna-bkpsdm.edit', ':id') }}'; url = url.replace(':id', userId);

        $.get(url, function (data) {
          $('#editUserModal').modal('show');
          $('#editUserId').val(data.data.id);
          $('#name').val(data.data.name);
          $('#email').val(data.data.email);
        }).fail(function(data) {
          const { status, message } = data.responseJSON;
          Swal.fire({
            title: 'Terjadi kesalahan',
            text: message,
            icon: 'error',
            confirmButtonText: 'OK'
          })
        })
      });

      /*------------------------------------------ Edit data user --------------------------------------------*/ 
      $('#editUserForm').submit(function (e) {
        e.preventDefault();
        $('#confirmEditBtn').html('Menyimpan...');
      
        let userId = $('#editUserId').val();
        let url = '{{ route('pengguna-bkpsdm.update', ':id') }}'; url = url.replace(':id', userId);

        // disable button while editing
        $("#confirmEditBtn").prop("disabled",true); 
        $("#closeEditBtn").prop("disabled",true);

        $.ajax({
          data: $('#editUserForm').serialize(),
          url: url,
          type: "PUT",
          dataType: 'json',
          success: function (data) {
            $('#editUserForm').trigger("reset");
            $('#editUserModal').modal('hide');
            table.ajax.reload();
            Swal.fire({
              title: 'Berhasil',
              text: 'BKPSDM berhasil disimpan',
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
              icon: status === 'validation error' ? 'warning' : 'error',
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

      /*------------------------------------------ Show modal delete user --------------------------------------------*/ 
      $(document).on('click', '.show-delete-modal', function () {
        $('#deleteUserModal').modal('show');
        $('#deleteUserId').val($(this).data("id"));
      });

      /*------------------------------------------ Delete data user --------------------------------------------*/ 
      $('#confirmDeleteBtn').click(function (e) {
        $(this).html('Menghapus...');

        let userId = $('#deleteUserId').val();
        let url = '{{ route('pengguna-bkpsdm.destroy', ':id') }}'; url = url.replace(':id', userId);

        // disable button while deleting
        $("#confirmDeleteBtn").prop("disabled",true); 
        $("#closeDeleteBtn").prop("disabled",true);

        $.ajax({
          type: "DELETE",
          url : url,
          success: function (data) {
            $('#deleteUserModal').modal('hide');
            table.ajax.reload();
            Swal.fire({
              title: 'Berhasil',
              text: 'BKPSDM berhasil dihapus',
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
          }
        });
      });

    });
  </script>
@endpush