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
                        <div role="tabpanel" class="tab-pane active" id="home">
                          <br>
                          <form action="<?=site_url()?>/crudController/updateAkun/operator/<?=$diri['id_operator']?>" method="POST" role="form" enctype="multipart/form-data">                            
                            <div class="row">
                              <div class="col-md-8">
                                <div class="form-group">
                                  <label for="">ID Operator</label>
                                  <input type="text" class="form-control" maxlength="16" value="<?=$diri['id_operator']?>" placeholder="ID Operator..." name="id_operator" disabled>
                                </div>
                                <div class="form-group">
                                  <label for="">Nama Operator</label>
                                  <input type="text" class="form-control" maxlength="20" placeholder="Nama Operator..." name="nama_operator" value="<?=$diri['nama_operator']?>">
                                </div>
                              </div>
                              <div class="col-md-4">
                              <img width="140px" height="200px" src="<?=base_url()?>assets/img/photo_operator/<?=$diri['photo_operator']?>">
                              </div>
                            </div>
                            <div class="form-group">

                            <div class="row">
                              <div class="col-md-4"> 
                                <label for="">Jenis Kelamin</label>
                                <div class="radio">
                                  <label><input type="radio" name="jk_operator" id="input" value="L" <?=($diri['jk_operator']=='L')?'checked':''?> >laki-Laki</label>
                                  <label><input type="radio"  name="jk_operator" id="input" value="P" <?=($diri['jk_operator']=='P')?'checked':''?>>Perempuan</label>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <label>Photo</label>
                                <input type="file" class="form-control" name="photo">
                              </div>
                            </div>
                          </div>


                            <button type="submit" class="btn btn-primary">Update Data Diri</button>
                          </form>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="tab">
                          <form action="<?=site_url()?>/crudController/crudOperator/ganti_pass/<?=$diri['id_operator']?>" method="POST" role="form">
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
