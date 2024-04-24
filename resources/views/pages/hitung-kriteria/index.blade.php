@extends('layouts.app')

@section('content')
  <section class="section">
        <div class="section-header">
            <h1>Hitung Kriteria</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Hitung Kriteria</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <span class="badge badge-info">Matriks Perbandingan</span>
                        </div>
                        <div class="card-body p-4">
                            @if (sizeof($kriteria) === 0)
                                <div class="alert alert-light">
                                    Tidak tersedia kriteria.
                                </div>
                            @else
                                <div class="table-responsive">
                                    <table id="" class="table table-bordered table-md">
                                        <thead class="text-center">
                                            <tr>
                                                <th>Kriteria</th>
                                                @foreach ($nilaiBobot as $key => $item)     
                                                    <th>{{ $item[$key]["nama"] }}</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            @foreach ($nilaiBobot as $key => $item)                        
                                                <tr>
                                                    <th scope="row">{{ $item[$key]["nama"] }}</th>
                                                    @foreach ($item as $item)
                                                    
                                                    <th scope="row">
                                                        {{-- {{ $item->kriteria1 }} --- {{ $item->kriteria2 }} ---  --}}
                                                        {{ number_format($item->bobot, 2, ',', ' ') }}</th>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <th>Jumlah</th>
                                                @foreach ($kriteria as $item)
                                                    <th>{{number_format($item->jumlah_bobot, 2, ',', ' ')}}</th>
                                                @endforeach
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                    
                                <br>
                    
                                <h6>Perhitungan Nilai Eigen dan Nilai Rata-rata</h6>
                                <div class="table-responsive">
                                    <table id="" class="table table-bordered table-md">
                                        <thead class="text-center">
                                            <tr>
                                                <th colspan={{sizeof($kriteria)}}>Nilai Eigen</th>
                                                <th>Jumlah</th>
                                                <th>Rata-rata</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            <?php 
                                                $jumlah = 0; $rata2 = 0;
                                            ?>
                                            @foreach ($nilaiBobot as $key => $item)  
                                                <?php
                                                    $jumlah += $kriteria[$key]->jumlah_eigen;
                                                    $rata2 += $kriteria[$key]->rata_eigen;
                                                ?>                      
                                                <tr>
                                                    {{-- <th scope="row">{{ $item[$key]["nama"] }}</th> --}}
                                                    @foreach ($item as $item)
                                                    <th scope="row">{{ number_format($item->eigen, 5, ',', ' ') }}</th>
                                                    @endforeach
                                                    <th scope="row">{{ number_format($kriteria[$key]->jumlah_eigen, 5, ',', ' ') }}</th>
                                                    <th scope="row">{{ number_format($kriteria[$key]->rata_eigen, 2, ',', ' ') }}</th>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <th colspan={{sizeof($kriteria)}}>Total</th>
                                                <th>{{$jumlah}}</th>
                                                <th>{{$rata2}}</th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                    
                                <?php 
                                    $lamdaMax = 0; $ci = 0; $cr = 0; $ir = 0;
                    
                                    foreach ($kriteria as $value) {
                                        $lamdaMax = number_format(($value->jumlah_bobot * $value->rata_eigen)+$lamdaMax, 5) ;
                                    }
                    
                                    if($lamdaMax > 0 && sizeof($kriteria)-1 > 0) $ci = ($lamdaMax-sizeof($kriteria))/(sizeof($kriteria)-1);
                    
                                    //rasio konsistensi
                                    if(sizeof($kriteria) == 1) $ir = 0;
                                    elseif(sizeof($kriteria) == 2) $ir = 0;
                                    elseif(sizeof($kriteria) == 3) $ir = 0.58;
                                    elseif(sizeof($kriteria) == 4) $ir = 0.9;
                                    elseif(sizeof($kriteria) == 5) $ir = 1.12;
                                    elseif(sizeof($kriteria) == 6) $ir = 1.24;
                                    elseif(sizeof($kriteria) == 7) $ir = 1.32;
                                    elseif(sizeof($kriteria) == 8) $ir = 1.41;
                                    elseif(sizeof($kriteria) == 9) $ir = 1.46;
                                    elseif(sizeof($kriteria) == 10) $ir = 1.49;
                    
                                    if($ir > 0)$cr = $ci/$ir;
                    
                                ?>
                    
                                <table>
                                    <tr>
                                        <th>CI = (Lamda Max-n)/(n-1)</th>
                                    </tr>
                                    <tr>
                                        <td>Lamda Max</td>
                                        <td>:</td>
                                        <td>{{$lamdaMax > 0 ? $lamdaMax : 0}}</td>
                                    </tr>
                                    <tr>
                                        <td>CI =</td>
                                        <td>:</td>
                                        <td>{{$ci > 0 ? $ci : 0}}</td>
                                    </tr>
                                    <tr>
                                        <td>CR=CI/IR</td>
                                        <td>:</td>
                                        <td>{{$cr > 0 ? $cr : 0}} <strong>(KONSISTEN)</strong></td>
                                    </tr>
                                </table>
                            @endif
                        </div>
                    </div>

                    @foreach ($daftarPerhitunganSubkriteria as $value)         
                        <div class="card">
                            <div class="card-header">
                                <span class="badge badge-info">Kriteria : {{$value['nama_kriteria']}}</span>
                            </div>
                            <div class="card-body p-4">
                                @if (sizeof($value['subkriteria']) === 0)
                                    <div class="alert alert-light">
                                        Tidak tersedia sub kriteria.
                                    </div>
                                @else
                                    <div class="table-responsive">
                                        <table id="" class="table table-bordered table-md">
                                            <thead class="text-center">
                                                <tr>
                                                    <th>Kriteria</th>
                                                    @foreach ($value['bobot'] as $key => $item)     
                                                        <th>{{ $item[$key]["nama"] }}</th>
                                                    @endforeach
                                                </tr>
                                            </thead>
                                            <tbody class="text-center">
                                                @foreach ($value['bobot'] as $key => $item)                        
                                                    <tr>
                                                        <th scope="row">{{ $item[$key]["nama"] }}</th>
                                                        @foreach ($item as $item)
                                                        
                                                        <th scope="row">
                                                            {{-- {{ $item->kriteria1 }} --- {{ $item->kriteria2 }} ---  --}}
                                                            {{ number_format($item->bobot, 2, ',', ' ') }}</th>
                                                        @endforeach
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <th>Jumlah</th>
                                                    @foreach ($value['subkriteria'] as $item)
                                                        <th>{{number_format($item->jumlah_bobot, 2, ',', ' ')}}</th>
                                                    @endforeach
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <br>

                                    <h6>Perhitungan Nilai Eigen dan Nilai Rata-rata</h6>
                                    <div class="table-responsive">
                                        <table id="" class="table table-bordered table-md">
                                            <thead class="text-center">
                                                <tr>
                                                    <th colspan={{sizeof($value['subkriteria'])}}>Nilai Eigen</th>
                                                    <th>Jumlah</th>
                                                    <th>Rata-rata</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-center">
                                                <?php 
                                                    $jumlah = 0; $rata2 = 0;
                                                ?>
                                                @foreach ($value['bobot'] as $key => $item)  
                                                    <?php
                                                        $jumlah += $value['subkriteria'][$key]->jumlah_eigen;
                                                        $rata2 += $value['subkriteria'][$key]->rata_eigen;
                                                    ?>                      
                                                    <tr>
                                                        @foreach ($item as $item)
                                                            <th scope="row">{{ number_format($item->eigen, 5, ',', ' ') }}</th>
                                                        @endforeach
                                                        <th scope="row">{{ number_format($value['subkriteria'][$key]->jumlah_eigen, 5, ',', ' ') }}</th>
                                                        <th scope="row">{{ number_format($value['subkriteria'][$key]->rata_eigen, 2, ',', ' ') }}</th>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <th colspan={{sizeof($value['subkriteria'])}}>Total</th>
                                                    <th>{{$jumlah}}</th>
                                                    <th>{{$rata2}}</th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <?php 
                                        $lamdaMax = 0; $ci = 0; $cr = 0; $ir = 0;
                        
                                        foreach ($value['subkriteria'] as $item) {
                                            $lamdaMax = number_format(($item->jumlah_bobot * $item->rata_eigen)+$lamdaMax, 5) ;
                                        }
                        
                                        if($lamdaMax > 0) $ci = ($lamdaMax-sizeof($value['subkriteria']))/(sizeof($value['subkriteria'])-1);
                        
                                        //rasio konsistensi
                                        if(sizeof($value['subkriteria']) == 1) $ir = 0;
                                        elseif(sizeof($value['subkriteria']) == 2) $ir = 0;
                                        elseif(sizeof($value['subkriteria']) == 3) $ir = 0.58;
                                        elseif(sizeof($value['subkriteria']) == 4) $ir = 0.9;
                                        elseif(sizeof($value['subkriteria']) == 5) $ir = 1.12;
                                        elseif(sizeof($value['subkriteria']) == 6) $ir = 1.24;
                                        elseif(sizeof($value['subkriteria']) == 7) $ir = 1.32;
                                        elseif(sizeof($value['subkriteria']) == 8) $ir = 1.41;
                                        elseif(sizeof($value['subkriteria']) == 9) $ir = 1.46;
                                        elseif(sizeof($value['subkriteria']) == 10) $ir = 1.49;
                        
                                        if($ir > 0)$cr = $ci/$ir;
                                    ?>
                    
                                    <table>
                                        <tr>
                                            <th>CI = (Lamda Max-n)/(n-1)</th>
                                        </tr>
                                        <tr>
                                            <td>Lamda Max</td>
                                            <td>:</td>
                                            <td>{{$lamdaMax > 0 ? $lamdaMax : 0}}</td>
                                        </tr>
                                        <tr>
                                            <td>CI =</td>
                                            <td>:</td>
                                            <td>{{$ci > 0 ? $ci : 0}}</td>
                                        </tr>
                                        <tr>
                                            <td>CR=CI/IR</td>
                                            <td>:</td>
                                            <td>{{$cr > 0 ? $cr : 0}} <strong>(KONSISTEN)</strong></td>
                                        </tr>
                                    </table>
                                @endif

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection