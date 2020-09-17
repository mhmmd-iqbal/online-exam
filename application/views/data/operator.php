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
                <h1 class="h3 mb-4 text-gray-800">Data Operator Sistem</h1>
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
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th class="text-center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $no = 1; foreach($operator as $data): ?>
                      <tr>
                        <td><?=$no?></td>
                        <td><?=$data['id_operator']?></td>
                        <td><?=$data['nama_operator']?></td>
                        <td><?=$data['jk_operator']?></td>
                        <td class="text-center">
                          <a class="btn btn-warning" data-toggle="modal" href="#lihat<?=$data['id_operator']?>"><i class="fa fa-eye"></i></a>
                          <a href="#edit<?=$data['id_operator']?>" class="btn btn-primary" data-toggle="modal"><i class="fa fa-cog"></i></a>
                          <a href="#delete<?=$data['id_operator']?>" class="btn btn-danger" data-toggle="modal"><i class="fa fa-times"></i></a>
                        </td>
                      </tr>
<!-- MODAL LIHAT DATA -->
<div class="modal fade" id="lihat<?=$data['id_operator']?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Lihat Dat <?=$data['id_operator']?></h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-8">
            <div class="row">
              <div class="col-md-5">Nama</div>
              <div class="col-md-7"><?=$data['nama_operator']?></div>
            </div>
            <div class="row">
              <div class="col-md-5">Jenis Kelamin</div>
              <div class="col-md-7"><?=($data['jk_operator']=='L')?'Laki-laki':'Wanita'?></div>
            </div>
            <div class="row">
              <div class="col-md-5">Log</div>
              <div class="col-md-7"><?=$data['log_operator']?></div>
            </div>
          </div>
          <div class="col-md-4">
            <img width="100px" height="160px" src="<?=base_url()?>assets/img/photo_operator/<?=$data['photo_operator']?>">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger">Selesai Lihat</button>
      </div>
    </div>
  </div>
</div>
<!-- MODAL LIHAT DATA -->
<!-- MODAL HAPUS -->
<div class="modal fade" id="delete<?=$data['id_operator']?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Hapus Data <?=$data['id_operator']?></h4>
      </div>
      <div class="modal-body">
        <h4>Apakah anda yakin akan menghapus data <?=$data['id_operator']?> <?=$data['nama_operator']?> ?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Jangan! Saya Khilaf</button>
        <a href="<?php echo site_url() ?>/crudController/crudOperator/delete/<?=$data['id_operator']?>" class="btn btn-danger">Ya! Hapus Data Ini</a>
      </div>
    </div>
  </div>
</div>
<!-- END MODAL HAPUS -->
<!-- MODAL EDIT DATA -->
<div class="modal fade" id="edit<?=$data['id_operator']?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Data <?=$data['id_operator']?></h4>
      </div>
      <form action="<?=site_url()?>/crudController/crudOperator/update/<?=$data['id_operator']?>" method="POST" role="form" enctype="multipart/form-data">
      <div class="modal-body">
          <div class="row">
            <div class="col-md-8">
              <div class="form-group">
                <label for="">ID Operator</label>
                <input type="text" class="form-control" maxlength="16" value="<?=$data['id_operator']?>" placeholder="ID Operator..." name="id_operator">
              </div>
              <div class="form-group">
                <label for="">Nama Operator</label>
                <input type="text" class="form-control" maxlength="20" placeholder="Nama Operator..." name="nama_operator" value="<?=$data['nama_operator']?>">
              </div>
            </div>
            <div class="col-md-4">
            <img width="100px" height="160px" src="<?=base_url()?>assets/img/photo_operator/<?=$data['photo_operator']?>">
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-md-4"> 
                <label for="">Jenis Kelamin</label>
                <div class="radio">
                  <label><input type="radio" name="jk_operator" id="input" value="L" <?=($data['jk_operator']=='L')?'checked':''?> >laki-Laki</label>
                  <label><input type="radio"  name="jk_operator" id="input" value="P" <?=($data['jk_operator']=='P')?'checked':''?>>Perempuan</label>
                </div>
              </div>
              <div class="col-md-8">
                <label>Photo</label>
                <input type="file" class="form-control" name="photo">
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Update Data</button>
      </form>
    </div>
  </div>
</div>
<!-- END MODAL EDIT DAT -->
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
        <h4 class="modal-title">Tambah Data Operator</h4>
      </div>
      <form action="<?=site_url()?>/crudController/crudOperator/add/0" method="POST" role="form" enctype="multipart/form-data">
      <div class="modal-body">
          <div class="form-group">
            <label for="">ID Operator</label>
            <input type="text" class="form-control" maxlength="16" placeholder="ID Operator..." name="id_operator">
          </div>
          <div class="form-group">
            <label for="">Nama Operator</label>
            <input type="text" class="form-control" maxlength="20" placeholder="Nama Operator..." name="nama_operator">
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-md-4"> 
                <label for="">Jenis Kelamin</label>
                <div class="radio">
                  <label><input type="radio" name="jk_operator" id="input" value="L" checked="">Pria</label>
                  <label><input type="radio" name="jk_operator" id="input" value="P" >Wanita</label>
                </div>
              </div>
              <div class="col-md-8">
                <label>Photo</label>
                <input type="file" class="form-control" name="photo">
              </div>
            </div>
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