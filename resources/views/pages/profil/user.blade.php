<div class="col-12 col-md-8">
    <div class="card">
        <div class="card-header">
        <h4>Ubah Data</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('ubah-profil-user') }}" enctype="multipart/form-data">
                @csrf                         
                <div class="row">      
                    <div class="form-group col-md-6 col-12">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="name" value="{{$data->name}}">
                        @if ($errors->has('name'))
                            <label class="mt-2" style="color: red">
                                {{ $errors->first('name') }}
                            </label>
                        @endif
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <label>Email</label>
                        <input type="text" class="form-control" value="{{$data->email}}" disabled>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6 col-12">
                        <label>Katasandi</label>
                        <input type="password" class="form-control" name="password">
                        @if ($errors->has('password'))
                            <label class="mt-2" style="color: red">
                                {{ $errors->first('password') }}
                            </label>
                        @endif
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <label>Konfirmasi Katasandi</label>
                        <input type="password" class="form-control" name="password_confirmation">
                        @if ($errors->has('password_confirmation'))
                            <label class="mt-2" style="color: red">
                                {{ $errors->first('password_confirmation') }}
                            </label>
                        @endif
                    </div>
                </div>
                <div class="row">      
                    <div class="form-group col-md-6 col-12">
                        <label>Foto</label>
                        <input type="file" class="form-control" name="image">
                    </div>
                </div>
                <div class="form-group float-right">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>