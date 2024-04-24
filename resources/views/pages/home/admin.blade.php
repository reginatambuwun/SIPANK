<section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <a href="{{route('periode.index')}}">
                <div class="card card-statistic-1">
                      <div class="card-icon bg-primary">
                          <i class="far fa-calendar"></i>
                      </div>
                      <div class="card-wrap">
                          <div class="card-header">
                              <h4>Periode</h4>
                          </div>
                          <div class="card-body">
                              {{$periode}}
                          </div>
                      </div>
                  </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <a href="{{route('pengguna.index')}}">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Pegawai</h4>
                        </div>
                        <div class="card-body">
                            {{$pegawai}}
                        </div>
                    </div>
                </div>
            </a>
        </div>              
    </div>
</section>