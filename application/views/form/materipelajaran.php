<?php 
  $level  = $this->session->userdata('level');
  $nip    = $this->session->userdata('username');
  $nama   = $this->session->userdata('nama');
?>
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
              <div class="col-md-6">
                <h1 class="h3 mb-4 text-gray-800"><?=isset($cek)?'Edit':'Tambah'?> Data Materi Pembelajaran</h1>
              </div>
              <div class="col-md-6">
                <p style="color: green"><?=(isset($sukses))?$sukses:''?></p>
                <p style="color: red"><?=(isset($error))?$error:''?></p>
              </div>
            </div>
            <div class="row">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Navigasi Master Data</h6>
                </div>
                <div class="card-body">
                  <?php $link = 'add/0'; if(isset($cek)): $link = 'edit/'.$materi['id_materi']; endif; ?>
                  <form action="<?=site_url()?>/crudController/crudMateri/<?=$link?>" method="POST" role="form" enctype="multipart/form-data">                  
                    <div class="form-group">
                      <label for="">Judul</label>
                      <input type="text" class="form-control" style="width: 1000px" maxlength="20" required="" name="judul_materi" value="<?=(isset($cek))? $materi['judul_materi'] : '' ?>">
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-5">
                          <label for="">Mata Pelajaran</label>
                          <select class="form-control"  name="id_mapel">
                            <option value="" disabled="" selected="">-- Mata Pelajaran --</option>
                            <?php $var =''; if (isset($cek)) : $var = $materi['id_mapel']; endif; ?>
                            <?php foreach ($mapel as $data ) :?>
                            <option  <?=($var==$data['id_mapel'])?'selected':''?> value="<?=$data['id_mapel']?>">
                              <?=$data['mapel']?>
                            </option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="col-md-7">
                          <label for="">Guru Pengasuh</label>
                          <?php if($level == 'operator'): ?>
                          <select name="nip" class="form-control" <?=isset($cek)?'disabled':''?> >
                            <option value="" disabled="" selected="">-- Guru Pengasuh --</option>
                            <?php $var =''; if (isset($cek)) : $var = $materi['nip']; endif; ?>
                            <?php foreach ($guru as $data ) :?>
                            <option <?=($var==$data['nip'])?'selected':''?> value="<?=$data['nip']?>"><?=$data['nama_guru']?></option>
                            <?php endforeach; ?>
                          </select>
                          <?php elseif($level == 'guru')  :?>
                            <input type="text" name="nip" value="<?=$nip?>" class="form-control">
                          <?php endif; ?>
                        </div>
                      </div>
                    </div>
                    <label for="">Upload Modul </label>
                    <div class="form-group">
                      <input type="file" class="form-control" name="modul" placeholder="">
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <?php if(isset($mater['modul'])): ?>
                        <?php if(!is_null($materi['modul'])): ?>
                           <a style="float: right;" href="<?=site_url()?>/crudController/crudMateri/download/<?=$materi['id_materi']?>" class="btn btn-danger"> <i class="fa fa-print"></i> Download Modul</a>
                        <?php endif; ?>
                        <?php endif; ?>
                      </div>
                    </div>
                    <label for="">Gambar </label>
                    <div class="form-group">
                      <input type="file" class="form-control" name="img_materi" placeholder="">
                    </div>
                    <p class="text-helper">*dapat dikosongkan bila tidak ada</p>
                    <?php if(isset($cek)): ?>
                    <?php if($materi['img_materi'] != '') :?>
                      <img src="<?=base_url()?>/assets/img/photo/<?=$materi['img_materi']?>" width="360px" height="220px">
                    <?php endif; ?>
                    <?php endif; ?>
                    <div class="form-group">
                      <label for="">Materi</label>
                      <textarea class="form-control" maxlength="5000" name="materi" rows="10"><?=(isset($cek))? $materi['materi'] : '' ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary"><?=(isset($cek))? 'Update' : 'Tambah' ?> Materi</button>
                    <button type="reset" class="btn btn-danger">Reset</button>
                  </form>
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
