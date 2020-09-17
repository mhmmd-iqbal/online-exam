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
                <h1 class="h3 mb-4 text-gray-800">Akun</h1>
              </div>
              <div class="col-md-6">
                <p style="color: green"><?=(isset($sukses))?$sukses:''?></p>
                <p style="color: red"><?=(isset($error))?$error:''?></p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card shadow">
                  <div class="card-header py-3">
                    <div class="h5 mb-4 text-gray-800">Update Data Diri</div>
                  </div>
                  <div class="card-body">
                    <div role="tabpanel">
                      <!-- Nav tabs -->
                      <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                          <a style="margin:0px 5px 5px 0px;" href="#home" aria-controls="home" role="tab" data-toggle="tab" class="btn btn-success ">Biodata Diri</a>
                        </li>
                        <li role="presentation">
                          <a style="margin: 0px 0px 5px 5px;" href="#tab" aria-controls="tab" role="tab" data-toggle="tab" class="btn btn-success ">Ganti Password</a>
                        </li>
                      </ul>
                    
                      <!-- Tab panes -->
                      <div class="tab-content">
                        <br>
                        <div role="tabpanel" class="tab-pane active" id="home">
                          <form action="<?=site_url()?>/crudController/updateAkun/siswa/<?=$diri['nis']?>" method="POST" role="form" enctype="multipart/form-data">

                           <div class="row">
                              <div class="col-md-8">
                                <div class="form-group">
                                  <label for="">Nomer Induk Siswa</label>
                                  <input type="text" class="form-control" maxlength="10" value="<?=$diri['nis']?>" name="nis" disabled>
                                </div>
                                <div class="form-group">
                                  <label for="">Nama Siswa</label>
                                  <input type="text" class="form-control" maxlength="20" value="<?=$diri['nama_siswa']?>" name="nama_siswa">
                                </div>
                              </div>
                              <div class="col-md-4">
                              <img  width="120px" height="180px" src="<?=base_url()?>assets/img/photo_siswa/<?=$diri['photo_siswa']?>">
                              </div>
                            </div>
                            <div class="form-group">
                              <label>Tempat dan Tanggal Lahir</label>
                              <div class="row">
                                <div class="col-md-7">
                                  <input type="text" class="form-control" name="tmp_lahir" value="<?=$diri['tmp_lahir_siswa']?>" maxlength="40">
                                </div>
                                <div class="col-md-5">
                                  <input type="text" class="form-control datepicker" name="tgl_lahir" value="<?=$diri['tgl_lahir_siswa']?>">
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="row">
                                <div class="col-md-4"> 
                                  <label for="">Jenis Kelamin</label>
                                  <div class="radio">
                                    <label><input type="radio" name="jk_siswa" id="input" value="L" <?=($diri['jk_siswa']=='L')?'checked':''?> >Pria</label>
                                    <label><input type="radio" name="jk_siswa" id="input" value="P" <?=($diri['jk_siswa']=='P')?'checked':''?> >Wanita</label>
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
                              <textarea type="text" name="alamat" class="form-control" rows="2" maxlength="40"><?=$diri['tmp_lahir_siswa']?> </textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Data</button>
                          </form>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="tab">
                          <form action="<?=site_url()?>/crudController/crudSiswa/ganti_pass/<?=$diri['nis']?>" method="POST" role="form">
                            <div class="form-group">
                              <label for="">Password Baru</label>
                              <input type="password" class="form-control" name="pass1" required="">
                            </div>
                            <div class="form-group">
                              <label for="">Retype Password Baru</label>
                              <input type="password" class="form-control" name="pass2" required="">
                            </div>
                            <button type="submit" class="btn btn-primary">Ubah Password</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
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
