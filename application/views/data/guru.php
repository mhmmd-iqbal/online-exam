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
                <h1 class="h3 mb-4 text-gray-800">Data Guru</h1>
              </div>
              <div class="col-md-6">
                <p style="color: green"><?=(isset($sukses))?$sukses:''?></p>
                <p style="color: red"><?=(isset($error))?$error:''?></p>
              </div>
            </div>
            <div class="row">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary "><a data-toggle="modal" href='#tambahdata' class="btn btn-success">Tambah Data</a></h6>
                </div>
                <div class="card-body">
                  <table class="table table-bordered table-hover" id="dataTable">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Nomor Induk Pegawai</th>
                        <th class="text-center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $no = 1; foreach($guru as $data): ?>
                      <tr>
                        <td><?=$no?></td>
                        <td><?=$data['nama_guru']?></td>
                        <td><?=$data['nip']?></td>
                        <td class="text-center">
                          <a class="btn btn-warning" data-toggle="modal" href="#lihat<?=$data['nip']?>"><i class="fa fa-eye"></i></a>
                          <?php if ($level == 'operator'): ?>
                          <a href="#edit<?=$data['nip']?>" class="btn btn-primary" data-toggle="modal"><i class="fa fa-cog"></i></a>
                          <a href="#delete<?=$data['nip']?>" class="btn btn-danger" data-toggle="modal"><i class="fa fa-times"></i></a>
                        <?php endif; ?>
                        </td>
                      </tr>
<!-- MODAL LIHAT DETAI -->
<div class="modal fade" id="lihat<?=$data['nip']?>">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Detail Data Guru</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-8">
            <div class="row">
              <div class="col md-5">Nama</div>
              <div class="col-md-7"><?=$data['nama_guru']?></div>
            </div>
            <div class="row">
              <div class="col md-5">NIP</div>
              <div class="col-md-7"><?=$data['nip']?></div>
            </div>
            <div class="row">
              <div class="col md-5">Jenis Kelamin</div>
              <div class="col-md-7"><?=($data['jk_guru']=='L')?'Laki-laki':'Wanita'?></div>
            </div>
            <div class="row">
              <div class="col md-5">Tempat dan Tanggal Lahir</div>
              <div class="col-md-7"><?=$data['tmp_lahir_guru']?>, <?=date('d-m-Y', strtotime($data['tgl_lahir_guru']))?></div>
            </div>
            <div class="row">
              <div class="col md-5">Alamat</div>
              <div class="col-md-7"><?=$data['alamat_guru']?></div>
            </div>
            <div class="row">
              <div class="col md-5">Log Aktivasi</div>
              <div class="col-md-7"><?=$data['log_guru']?></div>
            </div>
          </div>
          <div class="col md-4">
            <img width="100px" height="160px" src="<?=base_url()?>assets/img/photo_guru/<?=$data['photo_guru']?>">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok! Selesai Lihat</button>
        <?php if ($level == 'operator'): ?>
        <a href="#reset<?=$data['nip']?>" data-toggle="modal" class="btn btn-danger">Atur Ulang password</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
<!-- END MODAL LIHAT DETAIL -->

<!-- RESET PASSWORD -->
<div class="modal fade" id="reset<?=$data['nip']?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <h4 style="text-align: justify;">Apakah Anda Yakin Akan Mengatur Ulang Password Untuk NIK <?=$data['nip']?> ? </h4>
        <p class="text-help text-red" style="text-align: justify;">nb. password yang direset akan disesuaikan dengan nim</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan Aksi Reset</button>
        <a href="<?=site_url()?>/crudController/crudGuru/reset_pass/<?=$data['nip']?>" type="button" class="btn btn-danger">Ya! Reset Password Segera</a>
      </div>
    </div>
  </div>
</div>
<!-- END RESET PASSWORD -->

<!-- MODAL EDIT -->
<div class="modal fade" id="edit<?=$data['nip']?>" enctype="multipart/form-data">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Data Guru</h4>
      </div>
      <form action="<?=site_url()?>/crudController/crudGuru/edit/<?=$data['nip']?>" method="POST" role="form" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="row">
          <div class="col-md-8">
            <div class="form-group">
              <label for="">Nomer Induk Pegawai</label>
              <input type="text" class="form-control" required="" minlength="18" maxlength="18" value="<?=$data['nip']?>" name="nip">
            </div>
            <div class="form-group">
              <label for="">Nama Guru</label>
              <input type="text" class="form-control" required="" maxlength="40" value="<?=$data['nama_guru']?>" name="nama_guru">
            </div>
          </div>
          <div class="col-md-4">
            <img width="100px" height="160px" src="<?=base_url()?>assets/img/photo_guru/<?=$data['photo_guru']?>">
          </div>
        </div>
          <div class="form-group">
            <label>Tempat dan Tanggal Lahir</label>
            <div class="row">
              <div class="col-md-7">
                <input type="text" class="form-control" name="tmp_lahir" value="<?=$data['tmp_lahir_guru']?>" maxlength="40">
              </div>
              <div class="col-md-5">
                <input type="text" class="form-control datepicker" name="tgl_lahir" value="<?=$data['tgl_lahir_guru']?>">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-md-4">
                <label for="">Jenis Kelamin</label>
                <div class="radio">
                  <label><input type="radio" name="jk_guru" id="input" value="L" <?php if($data['jk_guru'] == 'L'){ echo "checked"; } ?>>Pria</label>
                  <label><input type="radio" name="jk_guru" id="input" value="P" <?php if($data['jk_guru'] == 'P'){ echo "checked"; } ?>>Wanita</label>
                </div>
              </div>
              <div class="col-md-8">
                <label>Photo</label>
                <input type="file" class="form-control" name="photo">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label>Alamat</label>
            <textarea type="text" name="alamat" class="form-control" rows="2" maxlength="40"><?=$data['alamat_guru']?> </textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="reset" class="btn btn-danger">Reset</button>
        <button type="submit" class="btn btn-success">Update Data</button>
      </form>
      </div>
    </div>
  </div>
</div>                      
<!-- END MODAL EDIT -->

<!-- HAPUS MODAL -->
  <div class="modal fade" id="delete<?=$data['nip']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Hapus Data <?=$data['nip']?></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Apakah anda yakin akan menghapus data <?=$data['nama_guru']?> dengan NIP <?=$data['nip']?> ?</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Jangan! Saya Khilaf!</button>
          <a class="btn btn-danger" href="<?=site_url()?>/crudController/crudGuru/delete/<?=$data['nip']?>">Ya! Hapuslah!</a>
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
<div class="modal fade" id="tambahdata">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Data Guru</h4>
      </div>
      <form action="<?=site_url()?>/crudController/crudGuru/add/0" method="POST" role="form" enctype="multipart/form-data">
      <div class="modal-body">
          <div class="form-group">
            <label for="">Nomer Induk Pegawai</label>
            <input type="text" class="form-control" maxlength="18" minlength="18"  required="" placeholder="Nomer Induk Pegawai..." name="nip">
          </div>
          <div class="form-group">
            <label for="">Nama Guru</label>
            <input type="text" class="form-control" maxlength="40" placeholder="Nama Guru..."  required="" name="nama_guru">
          </div>
          <div class="form-group">
            <label>Tempat dan Tanggal Lahir</label>
            <div class="row">
              <div class="col-md-7">
                <input type="text" class="form-control" name="tmp_lahir" placeholder="Tempat Lahir..." maxlength="40">
              </div>
              <div class="col-md-5">
                <input type="text" class="form-control datepicker" name="tgl_lahir" placeholder="Tanggal Lahir...">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-md-4"> 
                <label for="">Jenis Kelamin</label>
                <div class="radio">
                  <label><input type="radio" name="jk_guru" id="input" value="L" checked="">Pria</label>
                  <label><input type="radio" name="jk_guru" id="input" value="P" >Wanita</label>
                </div>
              </div>
              <div class="col-md-8">
                <label>Photo</label>
                <input type="file" class="form-control" name="photo">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label>Alamat</label>
            <textarea type="text" name="alamat" class="form-control" rows="2" maxlength="40"> </textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Tambah Data</button>
      </form>
      </div>
    </div>
  </div>
</div>