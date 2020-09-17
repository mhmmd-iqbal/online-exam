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
                <h1 class="h3 mb-4 text-gray-800"><?=isset($cek)?'Edit':'Tambah'?> Data Soal</h1>
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
                  <?php $link = 'add/0'; if(isset($cek)): $link = 'edit/'.$soal['id_soal']; endif; ?>
                  <form action="<?=site_url()?>/crudController/crudsoal/<?=$link?>" method="POST" role="form" enctype="multipart/form-data">                  
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-5">
                          <label for="">Mata Pelajaran</label>
                          <select class="form-control"  name="id_mapel">
                            <option value="" disabled="" selected="">-- Mata Pelajaran --</option>
                            <?php $var =''; if (isset($cek)) : $var = $soal['id_mapel']; endif; ?>
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
                            <select name="nip" class="form-control" >
                              <option value="" selected="" disabled="">-- Guru Pengasuh --</option>
                              <?php $var =''; if (isset($cek)) : $var = $soal['nip']; endif; ?>
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
                    <div class="form-group">
                      <label for="">Pertanyaan</label>
                      <input type="text" class="form-control" style="width: 1000px" maxlength="600" name="judul_soal" value="<?=(isset($cek))? $soal['soal'] : '' ?>" >
                    </div>
                    <label for="">Gambar</label>
                    <div class="form-group">
                      <input type="file" class="form-control" name="img_soal" placeholder="">
                    </div>
                    <p class="text-helper">*dapat dikosongkan bila tidak ada</p>
                    <?php if(isset($cek)): ?>
                    <?php if($soal['img_soal'] != '') :?>
                      <img src="<?=base_url()?>assets/img/photo/<?=$soal['img_soal']?>" width="160px" height="220px">
                    <?php endif; ?>
                    <?php endif; ?>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-2">
                          <label for="">Jawaban A</label>
                        </div>
                        <div class="col-md-10">
                          <input type="text" class="form-control" maxlength="200" name="a" value="<?=(isset($cek))? $soal['a'] : '' ?>">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-2">
                          <label for="">Jawaban B</label>
                        </div>
                        <div class="col-md-10">
                          <input type="text" class="form-control" maxlength="200" name="b" value="<?=(isset($cek))? $soal['b'] : '' ?>">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-2">
                          <label for="">Jawaban C</label>
                        </div>
                        <div class="col-md-10">
                          <input type="text" class="form-control" maxlength="200" name="c" value="<?=(isset($cek))? $soal['c'] : '' ?>">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-2">
                          <label for="">Jawaban D</label>
                        </div>
                        <div class="col-md-10">
                          <input type="text" class="form-control" maxlength="200" name="d" value="<?=(isset($cek))? $soal['d'] : '' ?>">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-2">
                          <label for="">Kunci Jawaban</label>
                        </div>
                        <div class="col-md-2">
                          <select name="kunci" class="form-control">
                            <option value="a">A</option>
                            <option value="b">B</option>
                            <option value="c">C</option>
                            <option value="d">D</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary"><?=(isset($cek))? 'Update' : 'Tambah' ?> soal</button>
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
