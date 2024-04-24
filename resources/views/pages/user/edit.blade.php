@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Ubah Data Pegawai</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Ubah Data Pegawai</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row justify-content-center">

              <div class="col-12 col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('pengguna.update', $data?->user_id) }}" enctype="multipart/form-data">
                            @csrf     
                            <input type="hidden" name="_method" value="PATCH">                    
                            <div class="row">   
                                <div class="form-group col-md-6 col-12">
                                    <label>No. Induk Pegawai</label>
                                    <input type="text" class="form-control" name="nip" value="{{old('nip') ?? $data?->nip}}">
                                    @if ($errors->has('nip'))
                                      <label class="mt-2" style="color: red">
                                          {{ $errors->first('nip') }}
                                      </label>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label>No. Induk Pegawai Lama</label>
                                    <input type="text" class="form-control" name="nipl" value="{{old('nipl') ?? $data?->nipl}}">
                                    @if ($errors->has('nipl'))
                                      <label class="mt-2" style="color: red">
                                          {{ $errors->first('nipl') }}
                                      </label>
                                    @endif
                                </div>
                            </div>
                            <div class="row">      
                              <div class="form-group col-md-6 col-12">
                                  <label>Gelar Depan</label>
                                  <input type="text" class="form-control" name="gelar_depan" value="{{old('gelar_depan') ?? $data?->gelar_depan}}">
                                  @if ($errors->has('gelar_depan'))
                                      <label class="mt-2" style="color: red">
                                          {{ $errors->first('gelar_depan') }}
                                      </label>
                                  @endif
                              </div>
                              <div class="form-group col-md-6 col-12">
                                  <label>Gelar Belakang</label>
                                  <input type="text" class="form-control" name="gelar_belakang" value="{{old('gelar_belakang') ?? $data?->gelar_belakang}}">
                                  @if ($errors->has('gelar_belakang'))
                                    <label class="mt-2" style="color: red">
                                        {{ $errors->first('gelar_belakang') }}
                                    </label>
                                  @endif
                              </div>
                            </div>
                            <div class="row">      
                              <div class="form-group col-12">
                                  <label>Nama Lengkap Pegawai</label>
                                  <input type="text" class="form-control" name="nama_lengkap" value="{{old('nama_lengkap') ?? $data?->name}}">
                                  @if ($errors->has('nama_lengkap'))
                                    <label class="mt-2" style="color: red">
                                        {{ $errors->first('nama_lengkap') }}
                                    </label>
                                  @endif
                              </div>
                            </div>
                            <div class="row">      
                              <div class="form-group col-md-6 col-12">
                                  <label>Tempat Lahir</label>
                                  <input type="text" class="form-control" name="tempat_lahir" value="{{old('tempat_lahir') ?? $data?->tempat_lahir}}">
                                  @if ($errors->has('tempat_lahir'))
                                      <label class="mt-2" style="color: red">
                                          {{ $errors->first('tempat_lahir') }}
                                      </label>
                                  @endif
                              </div>
                              <div class="form-group col-md-6 col-12">
                                  <label>Tanggal Lahir</label>
                                  <input type="date" class="form-control" name="tanggal_lahir" value="{{old('tanggal_lahir') ?? $data?->tanggal_lahir}}">
                                  @if ($errors->has('tanggal_lahir'))
                                    <label class="mt-2" style="color: red">
                                        {{ $errors->first('tanggal_lahir') }}
                                    </label>
                                  @endif
                              </div>
                            </div>

                            <div class="form-group">
                              <label>Jenis Kelamin</label><br>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki_laki" value="L" @if(old('jenis_kelamin') === 'L') checked @elseif($data?->jenis_kelamin === 'L')checked @endif/>
                                <label class="form-check-label" for="laki_laki">Laki-Laki</label>
                              </div>
                              
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="P" @if(old('jenis_kelamin') === 'P') checked @elseif($data?->jenis_kelamin === 'P')checked @endif/>
                                <label class="form-check-label" for="perempuan">Perempuan</label>
                              </div>
                              @if ($errors->has('jenis_kelamin'))
                                <br>
                                <label class="mt-2" style="color: red">
                                    {{ $errors->first('jenis_kelamin') }}
                                </label>
                              @endif
                            </div>

                            <div class="form-group">
                              <label>Golongan Darah</label><br>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gol_darah" id="golA" value="A" @if(old('gol_darah') === 'A') checked @elseif($data?->gol_darah === 'A')checked @endif />
                                <label class="form-check-label" for="golA">A</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gol_darah" id="golB" value="B" @if(old('gol_darah') === 'B') checked @elseif($data?->gol_darah === 'B')checked @endif />
                                <label class="form-check-label" for="golB">B</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gol_darah" id="golAB" value="AB" @if(old('gol_darah') === 'AB') checked @elseif($data?->gol_darah === 'AB')checked @endif />
                                <label class="form-check-label" for="golAB">AB</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gol_darah" id="golO" value="O" @if(old('gol_darah') === 'O') checked @elseif($data?->gol_darah === 'O')checked @endif />
                                <label class="form-check-label" for="golO">O</label>
                              </div>
                              @if ($errors->has('gol_darah'))
                                <br>
                                <label class="mt-2" style="color: red">
                                    {{ $errors->first('gol_darah') }}
                                </label>
                              @endif
                            </div>

                            <div class="row">      
                              <div class="form-group col-md-6 col-12">
                                <label>Identitas Diri</label><br>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="identitas_diri" id="ktp" value="KTP" @if(old('identitas_diri') === 'KTP') checked @elseif($data?->identitas_diri === 'KTP')checked @endif/>
                                  <label class="form-check-label" for="ktp">KTP</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="identitas_diri" id="sim" value="SIM" @if(old('identitas_diri') === 'SIM') checked @elseif($data?->identitas_diri === 'SIM')checked @endif/>
                                  <label class="form-check-label" for="sim">SIM</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="identitas_diri" id="paspor" value="Paspor" @if(old('identitas_diri') === 'Paspor') checked @elseif($data?->identitas_diri === 'Paspor')checked @endif/>
                                  <label class="form-check-label" for="paspor">Paspor</label>
                                </div>
                                @if ($errors->has('identitas_diri'))
                                  <br>
                                  <label class="mt-2" style="color: red">
                                      {{ $errors->first('identitas_diri') }}
                                  </label>
                                @endif
                              </div>
                              <div class="form-group col-md-6 col-12">
                                  <label></label>
                                  <input type="text" class="form-control" name="nomor_identitas" value="{{old('nomor_identitas') ?? $data?->nomor_identitas}}">
                                  @if ($errors->has('nomor_identitas'))
                                    <label class="mt-2" style="color: red">
                                        {{ $errors->first('nomor_identitas') }}
                                    </label>
                                  @endif
                              </div>
                            </div>

                            <div class="row">      
                              <div class="form-group col-md-6 col-12">
                                  <label>Jabatan</label>
                                  <input type="text" class="form-control" name="jabatan" value="{{old('jabatan') ?? $data?->jabatan}}">
                                  @if ($errors->has('jabatan'))
                                    <label class="mt-2" style="color: red">
                                        {{ $errors->first('jabatan') }}
                                    </label>
                                  @endif
                              </div>
                              <div class="form-group col-md-6 col-12">
                                  <label>No. NPWP</label>
                                  <input type="text" class="form-control" name="npwp" value="{{old('npwp') ?? $data?->npwp}}">
                                  @if ($errors->has('npwp'))
                                    <label class="mt-2" style="color: red">
                                        {{ $errors->first('npwp') }}
                                    </label>
                                  @endif
                              </div>
                            </div>

                            <div class="row">      
                                <div class="form-group col-md-6 col-12">
                                  <label>Alamat Rumah</label>
                                  <input type="text" class="form-control" name="alamat" value="{{old('alamat') ?? $data?->alamat}}">
                                  @if ($errors->has('alamat'))
                                    <label class="mt-2" style="color: red">
                                        {{ $errors->first('alamat') }}
                                    </label>
                                  @endif
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label>Kelurahan/Desa</label>
                                    <input type="text" class="form-control" name="kelurahan_desa" value="{{old('kelurahan_desa') ?? $data?->kelurahan_desa}}">
                                    @if ($errors->has('kelurahan_desa'))
                                      <label class="mt-2" style="color: red">
                                          {{ $errors->first('kelurahan_desa') }}
                                      </label>
                                    @endif
                                </div>
                            </div>

                            <div class="row">      
                              <div class="form-group col-md-6 col-12">
                                  <label>Kecamatan</label>
                                  <input type="text" class="form-control" name="kecamatan" value="{{old('kecamatan') ?? $data?->kecamatan}}">
                                  @if ($errors->has('kecamatan'))
                                    <label class="mt-2" style="color: red">
                                        {{ $errors->first('kecamatan') }}
                                    </label>
                                  @endif
                              </div>
                              <div class="form-group col-md-6 col-12">
                                  <label>Kabupatan/Kota</label>
                                  <input type="text" class="form-control" name="kab_kota" value="{{old('kab_kota') ?? $data?->kab_kota}}">
                                  @if ($errors->has('kab_kota'))
                                    <label class="mt-2" style="color: red">
                                        {{ $errors->first('kab_kota') }}
                                    </label>
                                  @endif
                              </div>
                            </div>

                            <div class="row">      
                              <div class="form-group col-md-6 col-12">
                                  <label>Kode Pos</label>
                                  <input type="text" class="form-control" name="kode_pos" value="{{old('kode_pos') ?? $data?->kode_pos}}">
                                  @if ($errors->has('kode_pos'))
                                    <label class="mt-2" style="color: red">
                                        {{ $errors->first('kode_pos') }}
                                    </label>
                                  @endif
                              </div>
                              <div class="form-group col-md-6 col-12">
                                  <label>No. Telepon. Rumah / HP</label>
                                  <input type="text" class="form-control" name="no_telp" value="{{old('no_telp') ?? $data?->no_telp}}">
                                  @if ($errors->has('no_telp'))
                                    <label class="mt-2" style="color: red">
                                        {{ $errors->first('no_telp') }}
                                    </label>
                                  @endif
                              </div>
                            </div>

                            <div class="form-group">
                              <label>Agama</label><br>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="agama" id="islam" value="Islam" @if(old('agama') === 'Islam') checked @elseif($data?->agama === 'Islam')checked @endif/>
                                <label class="form-check-label" for="islam">Islam</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="agama" id="kristen" value="Kristen" @if(old('agama') === 'Kristen') checked @elseif($data?->agama === 'Kristen')checked @endif/>
                                <label class="form-check-label" for="kristen">Kristen</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="agama" id="katholik" value="Katholik" @if(old('agama') === 'Katholik') checked @elseif($data?->agama === 'Katholik')checked @endif/>
                                <label class="form-check-label" for="katholik">Katholik</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="agama" id="hindu" value="Hindu" @if(old('agama') === 'Hindu') checked @elseif($data?->agama === 'Hindu')checked @endif/>
                                <label class="form-check-label" for="hindu">Hindu</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="agama" id="budha" value="Budha" @if(old('agama') === 'Budha') checked @elseif($data?->agama === 'Budha')checked @endif/>
                                <label class="form-check-label" for="budha">Budha</label>
                              </div>
                              @if ($errors->has('agama'))
                                <br>
                                <label class="mt-2" style="color: red">
                                    {{ $errors->first('agama') }}
                                </label>
                              @endif
                            </div>

                            <div class="form-group">
                              <label>Status Pernihakan</label><br>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status_pernikahan" id="singel" value="Singel" @if(old('status_pernikahan') === 'Singel') checked @elseif($data?->status_pernikahan === 'Singel')checked @endif/>
                                <label class="form-check-label" for="singel">Singel</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status_pernikahan" id="menikah" value="Menikah" @if(old('status_pernikahan') === 'Menikah') checked @elseif($data?->status_pernikahan === 'Menikah')checked @endif/>
                                <label class="form-check-label" for="menikah">Menikah</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status_pernikahan" id="janda" value="Janda" @if(old('status_pernikahan') === 'Janda') checked @elseif($data?->status_pernikahan === 'Janda')checked @endif/>
                                <label class="form-check-label" for="janda">Janda</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status_pernikahan" id="duda" value="Duda" @if(old('status_pernikahan') === 'Duda') checked @elseif($data?->status_pernikahan === 'Duda')checked @endif/>
                                <label class="form-check-label" for="duda">Duda</label>
                              </div>
                              @if ($errors->has('status_pernikahan'))
                                <br>
                                <label class="mt-2" style="color: red">
                                    {{ $errors->first('status_pernikahan') }}
                                </label>
                              @endif
                            </div>

                            <div class="row">      
                              <div class="form-group col-12">
                                  <label>Email</label>
                                  <input type="text" class="form-control" name="email" value="{{old('email') ?? $data?->email}}" disabled>
                                  @if ($errors->has('email'))
                                    <label class="mt-2" style="color: red">
                                        {{ $errors->first('email') }}
                                    </label>
                                  @endif
                              </div>
                            </div>

                            <div class="row">      
                              <div class="form-group col-md-6 col-12">
                                  <label>Tinggi</label>
                                  <input type="text" class="form-control" name="tinggi" value="{{old('tinggi') ?? $data?->tinggi}}">
                                  @if ($errors->has('tinggi'))
                                    <label class="mt-2" style="color: red">
                                        {{ $errors->first('tinggi') }}
                                    </label>
                                  @endif
                              </div>
                              <div class="form-group col-md-6 col-12">
                                  <label>Berat Badan</label>
                                  <input type="text" class="form-control" name="berat_badan" value="{{old('berat_badan') ?? $data?->berat_badan}}">
                                  @if ($errors->has('berat_badan'))
                                    <label class="mt-2" style="color: red">
                                        {{ $errors->first('berat_badan') }}
                                    </label>
                                  @endif
                              </div>
                            </div>

                            <div class="row">      
                              <div class="form-group col-12">
                                  <label>Hobi</label>
                                  <input type="text" class="form-control" name="hobi" value="{{old('hobi') ?? $data?->hobi}}">
                                  @if ($errors->has('hobi'))
                                    <label class="mt-2" style="color: red">
                                        {{ $errors->first('hobi') }}
                                    </label>
                                  @endif
                              </div>
                            </div>

                            <div class="row">      
                              <div class="form-group col-12">
                                  <label>TMT Bekerja/CPNS</label>
                                  <input type="date" class="form-control" name="tmt_bekerja_cpns" value="{{old('tmt_bekerja_cpns') ?? $data?->tmt_bekerja_cpns}}">
                                  @if ($errors->has('tmt_bekerja_cpns'))
                                    <label class="mt-2" style="color: red">
                                        {{ $errors->first('tmt_bekerja_cpns') }}
                                    </label>
                                  @endif
                              </div>
                            </div>

                            <div class="row">      
                              <div class="form-group col-12">
                                  <label>TMT SK Akhir</label>
                                  <input type="date" class="form-control" name="tmt_sk_akhir" value="{{old('tmt_sk_akhir') ?? $data?->tmt_sk_akhir}}">
                                  @if ($errors->has('tmt_sk_akhir'))
                                    <label class="mt-2" style="color: red">
                                        {{ $errors->first('tmt_sk_akhir') }}
                                    </label>
                                  @endif
                              </div>
                            </div>

                            <div class="row">      
                              <div class="form-group col-12">
                                  <label>Gol/Ruang Awal</label>
                                  <input type="text" class="form-control" name="gol_ruang_awal" value="{{old('gol_ruang_awal') ?? $data?->gol_ruang_awal}}">
                                  @if ($errors->has('gol_ruang_awal'))
                                    <label class="mt-2" style="color: red">
                                        {{ $errors->first('gol_ruang_awal') }}
                                    </label>
                                  @endif
                              </div>
                            </div>

                            <div class="row">      
                              <div class="form-group col-12">
                                  <label>Nilai SKP 1 Tahun Terakhir</label>
                                  <input type="number" class="form-control" name="nilai_skp" value="{{old('nilai_skp') ?? $data?->nilai_skp}}">
                                  @if ($errors->has('nilai_skp'))
                                    <label class="mt-2" style="color: red">
                                        {{ $errors->first('nilai_skp') }}
                                    </label>
                                  @endif
                              </div>
                            </div>

                            <div class="form-group float-right">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
              </div>
            </div>
          </div>
    </section>
@endsection