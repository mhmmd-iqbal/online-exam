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
                <h1 class="h3 mb-4 text-gray-800">Data Soal</h1>
              </div>
              <div class="col-md-6">
                <p style="color: green"><?=$this->session->flashdata('sukses')?></p>
                <p style="color: red"><?=$this->session->flashdata('error')?></p>
              </div>
            </div>
            <div class="row">
              <div class="card shadow">
                <div class="card-header py-3">
                  <div class="col-md-12">
                    <h6 class="m-0 font-weight-bold text-primary" style="float: left;"><a href='<?=site_url() ?>/Welcome/form/addSoal/0' class="btn btn-success">Tambah Data</a></h6>
                    <?php if($level == 'guru'): ?>
                    <h6 class="m-0 font-weight-bold text-primary " style="float: right;" ><a href='#getToken' data-toggle="modal" class="btn btn-danger">Buat Ujian dan Aktifkan Token</a></h6>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="card-body">
                  <table class="table table-bordered table-hover" id="dataTable">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Mata Pelajaran</th>
                        <th>Soal</th>
                        <th class="text-center">Aksi</th>
                        <?php if($level == 'guru'): ?>
                          <th class="text-center">Aktivasi Soal</th>
                        <?php endif;?>
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
                          <a href="<?=site_url()?>/Welcome/form/editSoal/<?=$data['id_soal']?> btn-sm" class="btn btn-primary btn-sm"><i class="fa fa-cog"></i></a>
                          <?php if ($level == 'operator'): ?>
                          <a href="#delete<?=$data['id_soal']?>" class="btn btn-danger btn-sm" data-toggle="modal"><i class="fa fa-times"></i></a>
                        <?php endif; ?>
                        </td>
                        <?php if($level == 'guru'): ?>
                        <td class="text-center">
                          <?php if ($data['aktivasi']=='0') :?>
                            <a href="<?=site_url()?>/crudController/aktivasiSoal/<?=$data['id_soal']?>/<?=$data['nip']?>" class="btn btn-primary btn-sm">Aktifkan</i></a>
                          <?php else: ?>
                            <i class="fa fa-check"></i>
                          <?php endif;?>
                        </td>
                        <?php endif; ?>
                      </tr>
<!-- Delete -->
<div class="modal fade" id="delete<?=$data['id_soal']?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Hapus Soal</h4>
      </div>
      <div class="modal-body">
        <h6>Apakah anda yakin akan menghapus soal ini ?</h6>
        <p><b>Soal:</b> <?=$data['soal']?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <a href="<?=site_url()?>/crudController/crudsoal/delete/<?=$data['id_soal']?> >" class="btn btn-danger">Ya! Hapus Soal Ini</a>
      </div>
    </div>
  </div>
</div>
<!-- Modal Detail  -->
<div class="modal fade" id="look<?=$no?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Soal <?=$data['mapel']?></h5>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">Guru Pengasuh : <?=$data['nama_guru']?></div>
        </div>
        <hr>
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
        <div class="row">
          <div class="col-md-12">
            <?php if ($data['aktivasi'] == '1') : ?>
              <h5 class="text text-primary"><b>SOAL AKTIF</b></h5>
            <?php endif; ?>
          </div>
        </div>
        <div class="modal-footer">
          <?php if (($data['aktivasi'] == '1')&&($level == 'guru')) : ?>
            <a href="<?=site_url()?>/crudController/nonAktivasiSoal/<?=$data['id_soal']?>/<?=$data['nip']?>" class="btn btn-danger">Non Aktifkan Soal</a>
          <?php endif; ?>
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

<!-- GETTOKENMODAL -->
<div class="modal fade" id="getToken">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Aktivasi Soal Ujian</h4>
      </div>
      <form action="<?=site_url()?>/crudController/getToken/<?=date('ymd').rand(1000, 9999)?>/<?=$data['nip']?>" method="POST" role="form">        
      <div class="modal-body">
          <div class="form-group">
            <div class="row">
              <div class="col-md-4">
                <label for="">Guru</label>
              </div>
              <div class="col-md-8">
                <input type="text" class="form-control" disabled value="<?=$nama?>">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-md-4">
                <label for="">Judul Ujian</label>
              </div>
              <div class="col-md-8">
                <input type="text" maxlength="20" required="" class="form-control" name="nama" >
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-md-4">
                <label for="">Kelas</label>
              </div>
              <div class="col-md-8">
                <select name="id_kelas" class="form-control">
                  <?php foreach ($kelas as $data): ?>
                    <option value="<?=$data['id_kelas']?>">Kelas <?=$data['nama_kelas']?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-md-4">
                <label for="">Waktu Ujian</label>
              </div>
              <div class="col-md-8">
                <input type="text" class="form-control datepicker" name="waktu" value="<?=date('Y-m-d')?>">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-md-4">
                <label for="">Lama Pengerjaan(Menit)</label>
              </div>
              <div class="col-md-8">
                <input type="number" class="form-control" name="jam" value="45">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-md-4">
                <label for="">Keterangan</label>
              </div>
              <div class="col-md-8">
                <textarea class="form-control" maxlength="500" name="keterangan"></textarea>
              </div>
            </div>
          </div>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger">Aktifkan Ujian</button>
      </div>
      </form>
    </div>
  </div>
</div>
