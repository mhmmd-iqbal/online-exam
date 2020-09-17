<html lang="en">
<?php $this->load->view('template/header') ?>
<body id="page-top">
    <div id="wrapper">
    <?php $this->load->view('template/menu_bar') ?>
      <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
        <?php $this->load->view('template/nav-bar-atas') ?>
          <div class="container-fluid">
            <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>
            <h5 style="font-style: italic;">Selamat Datang di Aplikasi E-Ujian</h5>
            <?php if(isset($level) AND ($level == 'siswa') AND (isset($ujian_baru)) AND ($ujian_baru == 0)): ?>
            <div class="alert alert-warning">
              Halo <?=$this->session->userdata('nama') ?>, Anda memiliki ujian yang belum dikerjakan ! Lihat daftar ujian dan segera kerjakan.
            </div>
            <?php endif ?>
            <?php if(isset($level) AND ($level == 'operator')): ?>
            <div class="row">
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Data Guru</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$jml_guru?> DATA</div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-user fa-2x text-gray-300"></i>
                      </div>
                    </div>
                    <hr>
                    <a href="<?=site_url()?>/Welcome/lihatData/guru" class="btn btn-primary btn-sm" style="float: right; margin-top: -10px; margin-bottom: -20px">Cek Data</a>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Data Siswa</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$jml_siswa?> DATA</div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-user fa-2x text-gray-300"></i>
                      </div>
                    </div>
                    <hr>
                    <a href="<?=site_url()?>/Welcome/lihatData/siswa" class="btn btn-primary btn-sm" style="float: right; margin-top: -10px; margin-bottom: -20px">Cek Data</a>
                  </div>
                </div>
              </div>
              <!-- <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Data Mapel</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$jml_mapel?> DATA</div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-list-ol fa-2x text-gray-300"></i>
                      </div>
                    </div>
                    <hr>
                    <a href="<?=site_url()?>/Welcome/lihatData/pelajaran" class="btn btn-primary btn-sm" style="float: right; margin-top: -10px; margin-bottom: -20px">Cek Data</a>
                  </div>
                </div>
              </div> -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Data Materi</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$jml_materi?> DATA</div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-list-ol fa-2x text-gray-300"></i>
                      </div>
                    </div>
                    <hr>
                    <a href="<?=site_url()?>/Welcome/lihatData/materi" class="btn btn-primary btn-sm" style="float: right; margin-top: -10px; margin-bottom: -20px">Cek Data</a>
                  </div>
                </div>
              </div>
            </div>
            <?php endif; ?>
            <hr>
            <h1 class="h3 mb-4 text-gray-800">Navigasi Halaman</h1>
            <div class="row">
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="text-lg font-weight-bold text-success text-uppercase mb-1">MATERI</div>
                        </div>
                        <div class="col-auto">
                          <i class="fas fa-book fa-2x text-gray-400"></i>
                        </div>
                      </div>
                      <hr>
                      <div style="float: right; margin-top: -10px; margin-bottom: -20px;"><a href="<?=site_url()?>/Welcome/bacaMateri/0" class="btn btn-success btn-sm">Baca Materi</a></div>
                  </div>
                </div>
              </div>
              <?php if(isset($level)): ?>
              
              <?php if ($level == 'guru'): ?>
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="text-lg font-weight-bold text-success text-uppercase mb-1">SOAL</div>
                        </div>
                        <div class="col-auto">
                          <i class="fas fa-pencil-alt fa-2x text-gray-400"></i>
                        </div>
                      </div>
                      <hr>
                      <div style="float: right; margin-top: -10px; margin-bottom: -20px;"><a href="<?=site_url()?>/Welcome/lihatData/soal" class="btn btn-success btn-sm">Buat Soal</a></div>
                  </div>
                </div>
              </div>
              <?php endif; ?>
              
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="text-lg font-weight-bold text-success text-uppercase mb-1">UJIAN</div>
                        </div>
                        <div class="col-auto">
                          <i class="fas fa-stopwatch fa-2x text-gray-400"></i>
                        </div>
                      </div>
                      <hr>
                      <div style="float: right; margin-top: -10px; margin-bottom: -20px;"><a href="<?=site_url()?>/Welcome/listUjian" class="btn btn-success btn-sm">Mulai Ujian</a></div>
                  </div>
                </div>
              </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php $this->load->view('template/footer') ?>
      </div>
    </div>
  <?php $this->load->view('template/scriptmenu') ?>
</body>
</html>
