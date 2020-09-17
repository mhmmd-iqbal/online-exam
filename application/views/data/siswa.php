<?php $level = $this->session->userdata('level'); ?>
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
                <h1 class="h3 mb-4 text-gray-800">Data Siswa</h1>
              </div>
              <div class="col-md-6">
                <p style="color: green"><?=(isset($sukses))?$sukses:''?></p>
                <p style="color: red"><?=(isset($error))?$error:''?></p>
              </div>
            </div>
            <div class="row">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <?php if($level == 'operator'):?>
                  <h6 class="m-0 font-weight-bold text-primary "><a data-toggle="modal" href='#tambahdata' class="btn btn-success">Tambah Data</a></h6>
                <?php endif; ?>
                </div>
                <div class="card-body">
                  <table class="table table-bordered table-hover" id="dataTable">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Nomor Induk Siswa</th>
                        <th>Kelas</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $no = 1; foreach($siswa as $data): ?>
                      <tr>
                        <td><?=$no?></td>
                        <td><?=$data['nama_siswa']?></td>
                        <td><?=$data['nis']?></td>
                        <td>Kelas <?=$data['nama_kelas']?></td>
                        <td class="text-center">
                          <a href="#detail<?=$data['nis']?>" class="btn btn-warning" data-toggle="modal"><i class="fa fa-eye"></i></a>
                          <?php if($level == 'operator'):?>
                          <a href="#edit<?=$data['nis']?>" class="btn btn-primary" data-toggle="modal"><i class="fa fa-cog"></i></a>
                          <a href="#hapus<?=$data['nis']?>" class="btn btn-danger" data-toggle="modal"><i class="fa fa-times"></i></a>
                          <?php endif; ?>
                        </td>
                      </tr>  
<!-- LIHAT DATA -->
<div class="modal fade" id="detail<?=$data['nis']?>">
  <div class="modal-dialog">
    <div class="modal-content modal-md">
      <div class="modal-header">
        <h4 class="modal-title">Lihat Data <?=$data['nama_siswa']?></h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-8">
            <div class="row">
              <div class="col-md-5">Nama</div>
              <div class="col-md-7"><?=$data['nama_siswa']?></div>
            </div>
            <div class="row">
              <div class="col-md-5">NIS</div>
              <div class="col-md-7"><?=$data['nis']?></div>
            </div>
            <div class="row">
              <div class="col-md-5">Jenis Kelamin</div>
              <div class="col-md-7"><?=($data['jk_siswa'] == 'L')?'Laki-laki':'Wanita'?></div>
            </div>
            <div class="row">
              <div class="col-md-5">Tempat dan Tanggal Lahir</div>
              <div class="col-md-7"><?=$data['tmp_lahir_siswa']?>, <?=date('Y-m-d', strtotime($data['tgl_lahir_siswa']))?></div>
            </div>
            <div class="row">
              <div class="col-md-5">Alamat</div>
              <div class="col-md-7"><?=$data['alamat_siswa']?></div>
            </div>
            <div class="row">
              <div class="col-md-5">Kelas</div>
              <div class="col-md-7"><?=$data['nama_kelas']?></div>
            </div>
          </div>
          <div class="col-md-4">
            <img width="100px" height="160px" src="<?=base_url()?>assets/img/photo_siswa/<?=$data['photo_siswa']?>">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup Modal</button>
        <button class="btn btn-danger" data-toggle="modal" data-target="#resetpass<?=$no?>">Reset Password</button>
      </div>
    </div>
  </div>
</div>
<!-- END LIHAT DATA -->
<!-- MODAL RESET PASS -->
<div class="modal fade" id="resetpass<?=$no?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Reset Password <?=$data['nama_siswa']?></h4>
      </div>
      <div class="modal-body">
        Apakah anda yakin akan mereset password <?=$data['nama_siswa']?>
      </div>
      <div class="modal-footer">
        <a href="<?=site_url()?>/crudController/crudSiswa/reset_pass/<?=$data['nis']?>" class="btn btn-danger" >Reset Password</a>
      </div>
    </div>
  </div>
</div>
<!-- END MODAL RESET PASS -->



<!-- EDIT DATA -->
<div class="modal fade" id="edit<?=$data['nis']?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Data Siswa</h4>
      </div>
      <form action="<?=site_url()?>/crudController/crudSiswa/edit/<?=$data['nis']?>" method="POST" role="form" enctype="multipart/form-data">
      <div class="modal-body">
          <div class="row">
            <div class="col-md-8">
              <div class="form-group">
                <label for="">Nomer Induk Siswa</label>
                <input type="text" class="form-control" minlength="10"  required="" maxlength="10" value="<?=$data['nis']?>" name="nis">
              </div>
              <div class="form-group">
                <label for="">Nama Siswa</label>
                <input type="text" class="form-control" maxlength="20" value="<?=$data['nama_siswa']?>" name="nama_siswa">
              </div>
            </div>
            <div class="col-md-4">
            <img width="100px" height="160px" src="<?=base_url()?>assets/img/photo_siswa/<?=$data['photo_siswa']?>">
            </div>
          </div>
          <div class="form-group">
            <label>Kelas</label>
            <select class="form-control" name="id_kelas">
              <option value="" disabled selected>-- Pilih Kelas --</option>
              <?php foreach ($kelas as $key ): ?>
                <option <?=($key['id_kelas']==$data['id_kelas'])?'selected':''?>  value="<?=$key['id_kelas'] ?>"><?=$key['nama_kelas']?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label>Tempat dan Tanggal Lahir</label>
            <div class="row">
              <div class="col-md-7">
                <input type="text" class="form-control" name="tmp_lahir" value="<?=$data['tmp_lahir_siswa']?>" maxlength="40">
              </div>
              <div class="col-md-5">
                <input type="text" class="form-control datepicker" name="tgl_lahir" value="<?=$data['tgl_lahir_siswa']?>">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-md-4"> 
                <label for="">Jenis Kelamin</label>
                <div class="radio">
                  <label><input type="radio" name="jk_siswa" id="input" value="L" <?=($data['jk_siswa']=='L')?'checked':''?> >Pria</label>
                  <label><input type="radio" name="jk_siswa" id="input" value="P" <?=($data['jk_siswa']=='P')?'checked':''?> >Wanita</label>
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
            <textarea type="text" name="alamat" class="form-control" rows="2" maxlength="40"><?=$data['tmp_lahir_siswa']?> </textarea>
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

<!-- HAPUS MODAL -->
  <div class="modal fade" id="hapus<?=$data['nis']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Hapus Data <?=$data['nis']?></h5>
        </div>
        <div class="modal-body">Apakah anda yakin akan menghapus data <?=$data['nama_siswa']?> dengan NIS <?=$data['nis']?> ?</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Jangan! Saya Khilaf!</button>
          <a class="btn btn-danger" href="<?=site_url()?>/crudController/crudSiswa/delete/<?=$data['nis']?>">Ya! Hapuslah!</a>
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
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Data Siswa</h4>
      </div>
      <form action="<?=site_url()?>/crudController/crudSiswa/add/0" method="POST" role="form" enctype="multipart/form-data">
      <div class="modal-body">
          <div class="form-group">
            <label for="">Nomer Induk Siswa</label>
            <input type="text" class="form-control" maxlength="10" minlength="10" required="" placeholder="Nama Induk Siswa..." name="nis">
          </div>
          <div class="form-group">
            <label for="">Nama Siswa</label>
            <input type="text" class="form-control" maxlength="20" required="" placeholder="Nama Siswa..." name="nama_siswa">
          </div>
          <div class="form-group">
            <label>Kelas</label>
            <select class="form-control" name="id_kelas">
              <option value="" disabled selected>--> Pilih Kelas <--</option>
              <?php foreach ($kelas as $key ): ?>
                <option value="<?=$key['id_kelas'] ?>"><?=$key['nama_kelas']?></option>
              <?php endforeach; ?>
            </select>
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
                  <label><input type="radio" name="jk_siswa" id="input" value="L" checked="">Pria</label>
                  <label><input type="radio" name="jk_siswa" id="input" value="P" >Wanita</label>
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