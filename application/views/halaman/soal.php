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
                <h1 class="h3 mb-4 text-gray-800">List Soal Dari Paket Ujian</h1>
              </div>
              <div class="col-md-6">
                <p style="color: green"><?=(isset($sukses))?$sukses:''?></p>
                <p style="color: red"><?=(isset($error))?$error:''?></p>
              </div>
            </div>
            <div class="row">
              <div class="card shadow">
                <div class="card-header py-3">
                  <a href="<?=site_url()?>/Welcome/listUjian" class="btn btn-primary" style="float: left">Kembali</a>
                </div>
                <div class="card-body">
                  <table class="table table-bordered table-hover" id="dataTable">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th width="180px">Mata Pelajaran</th>
                        <th width="450px">Soal</th>
                        <th class="text-center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $no = 1; foreach($soal as $data): ?>
                      <tr>
                        <td><?=$no?></td>
                        <td><?=$data['mapel']?></td>
                        <td><?=$data['soal']?></td>
                        <td class="text-center">
                          <a href="#look<?=$no?>" class="btn btn-warning btn-sm" data-toggle='modal'><i class="fa fa-eye"></i></a>
                        </td>
                      </tr>
<!-- Modal Detail  -->
<div class="modal fade" id="look<?=$no?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Soal <?=$data['mapel']?></h5>
        </div>
        <hr>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-8">
              <div class="row">
                  <div class="col-md-12"><p style="text-align: justify;">Soal : <?=$data['soal']?></p></div>
              </div>
              <div class="row">
                  <div class="col-md-12"><p style="text-align: justify;">a. <?=$data['a']?></p></div>
              </div>
              <div class="row">
                  <div class="col-md-12"><p style="text-align: justify;">b. <?=$data['b']?></p></div>
              </div>
              <div class="row">
                  <div class="col-md-12"><p style="text-align: justify;">c. <?=$data['c']?></p></div>
              </div>
              <div class="row">
                  <div class="col-md-12"><p style="text-align: justify;">d. <?=$data['d']?></p></div>
              </div>
              <div class="row">
                  <div class="col-md-12"><p><b>Jawaban yang benar : <?=$data['kunci']?></b></p></div>
              </div>
            </div>
            <div class="col-md-4">
              <img width="168px" height="240px" src="<?=base_url()?>assets/img/photo/<?=$data['img_soal']?>">
            </div>
          </div>
        </div>
        
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Tutup Modal</button>
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
