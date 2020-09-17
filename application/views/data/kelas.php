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
                <h1 class="h3 mb-4 text-gray-800">Data Kelas</h1>
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
                        <th>Kelas </th>
                        <th>Jumlah Siswa</th>
                        <th class="text-center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php if(isset($kelas)): ?>
                    <?php $no = 1; foreach($kelas as $data): ?>
                      <tr>
                        <td><?=$no?></td>
                        <td>Kelas <?=$data['nama_kelas']?></td>
                        <td><?=$data['jml_siswa']?> Siswa</td>
                        <td class="text-center">
                          <a href="#edit<?=$data['id_kelas']?>" class="btn btn-primary" data-toggle="modal">
                            <i class="fa fa-cog"></i>
                          </a>
                          <a href="#hapus<?=$data['id_kelas']?>" class="btn btn-danger" data-toggle="modal">
                            <i class="fa fa-times"></i>
                          </a>
                        </td>
                      </tr>
<div class="modal fade" id="edit<?=$data['id_kelas']?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Data Kelas</h4>
      </div>
      <form action="<?=site_url()?>/crudController/crudKelas/edit/<?=$data['id_kelas']?>" method="POST" role="form">
      <div class="modal-body">
          <div class="form-group">
            <label for="">Nama Kelas</label>
            <input type="number" class="form-control" maxlength="10" value="<?=$data['nama_kelas']?>" name="nama_kelas">
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
  <div class="modal fade" id="hapus<?=$data['id_kelas']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Hapus Data <?=$data['nama_kelas']?></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Apakah anda yakin akan menghapus data <?=$data['nama_kelas']?>  ?</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Jangan! Saya Khilaf!</button>
          <a class="btn btn-danger" href="<?=site_url()?>/crudController/crudKelas/delete/<?=$data['id_kelas']?>">Ya! Hapuslah!</a>
        </div>
      </div>
    </div>
  </div>
                    <?php $no++; endforeach; ?>
                    <?php endif; ?>
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
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Data Kelas</h4>
      </div>
      <form action="<?=site_url()?>/crudController/crudKelas/add/0" method="POST" role="form">
      <div class="modal-body">
          <div class="form-group">
            <label for="">Nama Kelas</label>
            <input type="number" class="form-control" maxlength="6" placeholder="Kelas..." name="nama_kelas">
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