<html lang="en">
<?php $this->load->view('template/header') ?>
<body id="page-top">
    <div id="wrapper">
    <?php $this->load->view('template/menu_bar') ?>
      <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
        <?php $this->load->view('template/nav-bar-atas') ?>
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-4">
                <h1 class="h3 mb-4 text-gray-800">Baca Materi</h1>
              </div>
              <div class="col-md-6">
                <p style="color: green"><?=(isset($sukses))?$sukses:''?></p>
                <p style="color: red"><?=(isset($error))?$error:''?></p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="card shadow">
                  <div class="card-header py-3">
                    <div class="h4 mb-4 text-gray-800">Lihat Daftar Materi</div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-bordered table-hover" id="dataTable">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Judul Materi</th>
                            <th class="text-center">kategori</th>
                            <th class="text-center">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $no=1; foreach ($materi as $data): ?>
                          <tr>
                            <td><?=$no ?></td>
                            <td><?=$data['judul_materi']?></td>
                            <td><?=$data['mapel']?></td>
                            <td class="text-center"><a class="btn btn-success btn-sm" href="<?=site_url()?>/Welcome/bacaMateri/<?=$data['id_materi']?>">Yuk Baca</a></td>
                          </tr>
                          <?php $no++; endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <?php if (isset($baca)): ?>
                <div class="row">
                  <div class="card shadow">
                    <div class="card-header py-3">
                      <div class="h4 mb-4 text-gray-800"><?=$baca['judul_materi']?></div>
                    </div>
                    <div class="card-body">
                      <h5 class="text-blue mb-4">Oleh <?=($baca['jk_guru'])=='L'?'Bapak':'Ibu'?> <?=$baca['nama_guru'] ?></h5>
                      <p><?=date('d M Y - h : i : s', strtotime($baca['log_materi']))?></p>
                      <p><?=$baca['mapel']?></p>
                      <hr>
                      <?php if ($baca['img_materi'] != 'NOIMAGE.jpg'): ?>
                        <img src="<?=base_url()?>/assets/img/photo/<?=$baca['img_materi']?>" height="200px" width="300px">
                      <?php endif; ?>
                      <p style="text-align: justify;"><?=$baca['materi']?></p>
                      <hr>
                      <?php if(!is_null($baca['modul'])): ?>
                      <a href="<?=site_url()?>/crudController/crudMateri/download/<?=$baca['id_materi']?>" class="btn btn-success">download modul</a>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
                  
                <?php endif; ?>
              </div>
            </div>

          

          </div>
        </div>
      <?php $this->load->view('template/footer') ?>
      </div>
    </div>
  <?php $this->load->view('template/scriptmenu') ?>
</body>
</html>
