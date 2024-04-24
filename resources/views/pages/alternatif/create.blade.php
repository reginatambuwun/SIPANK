@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tambah Alternatif</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Tambah Alternatif</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6 col-lg-6">
                    <a href="{{ route('alternatif.index', request()->segment(3)) }}" class="btn btn-primary mb-4"><i class="fas fa-arrow-left"></i></a>
                    <div class="card">
                        <form method="POST" id="form" action="{{ route('alternatif.store') }}">
                            @csrf
                            <div class="card-body">
                                <input type="hidden" id="periodeId" name="periode_id" value={{request()->segment(3)}}>
                                <div class="form-group">
                                    <label>Pegawai</label>
                                    <select name="user_id" id="selectUser" class="custom-select">
                                        <option value="-">Pilih</option>
                                        @foreach ($pengguna as $item)
                                            <option value={{$item->id}} {{ old('user_id') == $item->id ? 'selected' : '' }}>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('user_id'))
                                        <label class="" style="color: red">
                                            {{ $errors->first('user_id') }}
                                        </label>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Lamanya Masa Kerja</label>
                                    <input type="hidden" name="7aa84f09-ada0-4e1d-aeac-8d5eaec82d1f" id="lamaMasaKerja">
                                    <select id="7aa84f09-ada0-4e1d-aeac-8d5eaec82d1f" class="custom-select" disabled>
                                        <option value="">Pilih</option>
                                        <option value="8680423c-d029-4645-b532-9d809af606e3">Sangat Lama (>3 Tahun)</option>
                                        <option value="e17f32ba-4981-4801-9cfa-aea4cc6dfd19">Cukup Lama (2-3 tahun)</option>
                                        <option value="b3fb1ffb-f0c4-497c-a808-1d12837f9246">Lama(1-2 Tahun)</option>
                                        <option value="672abd5d-14dd-4738-82f6-d4db81defaa6">Baru (≤1 tahun)</option>
                                    </select>
                                    {{-- @if ($errors->has('7aa84f09-ada0-4e1d-aeac-8d5eaec82d1f'))
                                        <label class="" style="color: red">
                                            {{ $errors->first('7aa84f09-ada0-4e1d-aeac-8d5eaec82d1f') }}
                                        </label>
                                    @endif --}}
                                </div>

                                <div class="form-group">
                                    <label>Kinerja Pegawai</label>
                                    <input type="hidden" name="e830576e-591e-4d01-8ebf-0ce28185e501" id="kinerjaPegawai">
                                    <select id="e830576e-591e-4d01-8ebf-0ce28185e501" class="custom-select" disabled>
                                        <option value="">Pilih</option>
                                        <option value="37a2340e-e13e-4682-956e-cbed14cfdb1a">Baik (90-100)</option>
                                        <option value="a3e44379-2200-48fc-8abe-de688291fa62">Cukup (70-89)</option>
                                        <option value="99fe40d8-c78d-494c-9118-029c9610888a">Kurang (50-69)</option>
                                        <option value="d024f740-7af0-44f3-8e7c-5ec53c3a0b1f">Sangat Kurang (< 50)</option>
                                    </select>
                                    {{-- @if ($errors->has('e830576e-591e-4d01-8ebf-0ce28185e501'))
                                        <label class="" style="color: red">
                                            {{ $errors->first('e830576e-591e-4d01-8ebf-0ce28185e501') }}
                                        </label>
                                    @endif --}}
                                </div>


                                {{-- @foreach ($daftarKriteria as $key => $value)                                    
                                    <div class="form-group">
                                        <label>{{ $value['nama_kriteria'] }}</label>
                                        <select name={{$value['kriteria_id']}} class="custom-select">
                                            <option value="">Pilih</option>
                                            @foreach ($value['subkriteria'] as $item)
                                                <option value={{$item->id}} {{ old($value['kriteria_id']) == $item->id ? 'selected' : '' }}>{{$item->nama}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has($value['kriteria_id']))
                                            <label class="" style="color: red">
                                                {{ $errors->first($value['kriteria_id']) }}
                                            </label>
                                        @endif
                                    </div>
                                @endforeach --}}
                                <div class="text-right">
                                    <button type="submit" id="submit" class="btn btn-primary" disabled>Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(function () {
            // $('#selectUser').on('change', function () {
            //     var idUser = this.value;
            //     console.log('testing check ', idUser);
            //     $("#state-dropdown").html('');
            //     $.ajax({
            //         url: "{{url('api/fetch-states')}}",
            //         type: "POST",
            //         data: {
            //             country_id: idCountry,
            //             _token: '{{csrf_token()}}'
            //         },
            //         dataType: 'json',
            //         success: function (result) {
            //             // $('#state-dropdown').html('<option value="">-- Select State --</option>');
            //             // $.each(result.states, function (key, value) {
            //             //     $("#state-dropdown").append('<option value="' + value
            //             //         .id + '">' + value.name + '</option>');
            //             // });
            //             // $('#city-dropdown').html('<option value="">-- Select City --</option>');
            //         }
            //     });
            // });


            $(document).on('change', '#selectUser', function () {
                // let userId = $(this).data('id');
                var userId = this.value, periodeId = $('#periodeId').val();;

                if(userId === '-'){
                    $('#submit').prop('disabled', true);
                    $('#form')[0].reset()
                    return
                }

                let url = '{{ route('alternatif.kalkulasi', [':uid',':pid']) }}'; 
                url = url.replace(':uid', userId);
                url = url.replace(':pid', periodeId);

                $.get(url, function (data) {
                    $("#7aa84f09-ada0-4e1d-aeac-8d5eaec82d1f").val(data.data.lamaMasaKerja); $("#lamaMasaKerja").val(data.data.lamaMasaKerja);
                    $("#e830576e-591e-4d01-8ebf-0ce28185e501").val(data.data.kinerjaPegawai); $("#kinerjaPegawai").val(data.data.kinerjaPegawai);

                    $('#submit').prop('disabled', false)
                }).fail(function(data) {
                    const { status, message } = data.responseJSON;
                    console.log('testing fail ', message);
                    Swal.fire({
                        title: 'Terjadi kesalahan',
                        html: message,
                        icon: status === 'validation error' ? 'warning' : 'error',
                        confirmButtonText: 'OK'
                    })

                    $('#submit').prop('disabled', true);
                    $('#form')[0].reset()
                })
            });

        });
    </script>
@endpush