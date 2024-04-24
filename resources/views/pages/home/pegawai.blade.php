<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <section class="section">
                    <div class="section-body">
                        <h2 class="section-title">Selamat Datang</h2>
                        <p class="section-lead">Halaman informasi untuk pengajuan kenaikan pangkat.</p>
                    </div>
                </section>
            </div>
        </div>

        @if(!$berkas)    
            <div class="alert alert-warning alert-has-icon">
                <div class="alert-icon"><i class="fas fa-info-circle"></i></div>
                <div class="alert-body">
                    <div class="alert-title">Info</div>
                    Anda belum terdaftar dalam proses pengajuan kenaikan pangkat.
                </div>
            </div>
        @elseif(!$perankingan || $perankingan?->direkomendasi === 0)    
            <div class="alert alert-warning alert-has-icon">
                <div class="alert-icon"><i class="fas fa-info-circle"></i></div>
                <div class="alert-body">
                    <div class="alert-title">Info</div>
                    Anda telah terdaftar dalam proses pengajuan kenaikan pangkat, tapi belum direkomendasikan.
                </div>
            </div>
        @elseif($berkas && !$berkas->status)
            <div class="alert alert-info alert-has-icon">
                <div class="alert-icon"><i class="fas fa-info-circle"></i></div>
                <div class="alert-body">
                    <div class="alert-title">Info</div>
                    <p>Anda telah direkomendasikan untuk melakukan pengajuan kenaikan pangkat.</p>
                    <p>Masuk kehalaman <strong>Pengajuan Berkas</strong> untuk mengunggah berkas-berkas yang diperlukan.</p>
                </div>
            </div>
        @elseif($berkas && $berkas->status === 'dikirim')
            <div class="alert alert-success alert-has-icon">
                <div class="alert-icon"><i class="fas fa-info-circle"></i></div>
                <div class="alert-body">
                    <div class="alert-title">Info</div>
                    <p>Berkas telah dikirim dan akan ditinjau oleh pihak BKPSDM.</p>
                </div>
            </div>
        @endif
    </div>
</div>
