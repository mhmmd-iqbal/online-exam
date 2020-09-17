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
                <h1 class="h3 mb-4 text-gray-800">Data Materi Pelajaran</h1>
              </div>
              <div class="col-md-6">
                <p style="color: green"><?=(isset($sukses))?$sukses:''?></p>
                <p style="color: red"><?=(isset($error))?$error:''?></p>
              </div>
            </div>
            <div class="row">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary "><a href='<?=site_url() ?>/Welcome/form/addMateri/0' class="btn btn-success">Tambah Data</a></h6>
                </div>
                <div class="card-body">
                  <table class="table table-bordered table-hover" id="dataTable">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Mata Pelajaran</th>
                        <th>Judul Materi</th>
                        <th>Guru Pengasuh</th>
                        <th class="text-center">Aksi</th>
                        <th class="text-center">Log</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $no = 1; foreach($materi as $data): ?>
                      <tr>
                        <td><?=$no?></td>
                        <td><?=$data['mapel']?></td>
                        <td><?=$data['judul_materi']?></td>
                        <td><?=$data['nama_guru']?></td>
                        <td class="text-center">
                          <a href="#look<?=$no?>" class="btn btn-warning" data-toggle='modal'><i class="fa fa-eye"></i></a>
                          <a href="<?=site_url()?>/Welcome/form/editMateri/<?=$data['id_materi']?>" class="btn btn-primary"><i class="fa fa-cog"></i></a>
                          <?php if ($level == 'operator'): ?>
                          <a href="#delete<?=$data['id_materi']?>" class="btn btn-danger" data-toggle="modal"><i class="fa fa-times"></i></a>  
                          <?php endif; ?>
                          <?php if(!is_null($data['modul'])): ?>
                          <a href="<?=site_url()?>/crudController/crudMateri/download/<?=$data['id_materi']?>" class="btn btn-success"><i class="fa fa-download"></i></a>
                          <?php endif;  ?>
                        </td>
                        <td><?=$data['log_materi']?></td>
                      </tr>
<!-- Modal Detail  -->
<div class="modal fade" id="look<?=$no?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><?=$data['judul_materi']?></h5>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
                <p style="text-align: justify;"><?=$data['materi']?></p>              
            </div>
            <div class="col-md-12">
              <img src="<?=base_url()?>/assets/img/photo/<?=$data['img_materi']?>" height="200px" width="300px">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <?php if(!is_null($data['modul'])): ?>
          <a href="<?=site_url()?>/crudController/crudMateri/download/<?=$data['id_materi']?>" class="btn btn-success">Download Modul Ini!</a>
          <?php endif; ?>
          <button class="btn btn-danger" type="button" data-dismiss="modal">Sudah Selesai Dibaca!</button>
        </div>
      </div>
    </div>
  </div>
<!-- HAPUS MODAL -->
  <div class="modal fade" id="delete<?=$data['id_materi']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Hapus Data <?=$data['mapel']?></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Apakah anda yakin akan menghapus materi ini  ?</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Jangan! Saya Khilaf!</button>
          <a class="btn btn-danger" href="<?=site_url()?>/crudController/crudMateri/delete/<?=$data['id_materi']?>">Ya! Hapuslah!</a>
        </div>
      </div>
    </div>
  </div>
                    <?php $no++; endforeach; ?>
                    </tbody>
                  </table>
                </div>
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
