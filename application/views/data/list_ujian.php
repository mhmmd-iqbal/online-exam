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
                <h1 class="h3 mb-4 text-gray-800">Paket Ujian </h1>
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
                  </div>
                  <div class="card-body">
                    <table class="table table-bordered table-hover" id="dataTable">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th >Judul Ujian</th>
                          <th>Kelas</th>
                          <th  >Guru Pembimbing</th>
                          <th>Batas Waktu Ujian </th>
                          <th class="text-center" >Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if(isset($ujian)): ?>
                        <?php $no=1; foreach ($ujian as $data):?>
                          <tr>
                            <td><?=$no?></td>
                            <td><?=$data['judul_soal_ujian']?></td>
                            <td>Kelas <?=$data['nama_kelas']?></td>
                            <td><?=$data['nama_guru']?></td>
                            <td><?=date('d M Y',strtotime($data['waktu_ujian']))?></td>
                           
                            <td class="text-center">
                            <?php if($level != 'siswa'): ?>
                              <a href="#detail<?=$no?>" data-toggle="modal" class="btn btn-warning btn-sm">
                                <i class="fa fa-eye"></i>
                              </a>
                              <a href="<?=site_url()?>/ujianController/nilaiUjian/<?=$data['id_soalujian']?>" class="btn btn-primary btn-sm"><i class="fa fa-list"></i></a>
                              <?php if($level == 'operator'): ?>
                                <a href="#hapus<?=$no?>" data-toggle="modal" class="btn btn-danger btn-sm">
                                  <i class="fa fa-times"></i>
                                </a>
                              <?php endif; ?>
                            <?php endif; ?>
                            <?php if($level == 'siswa'):?>
                              <?php if ((isset($data['sudah_ujian']))&&($data['sudah_ujian']=='sudah')&&($data['nis'] == $data['nis_now'])): ?>
                                <i class="fa fa-check text-success"></i>
                              <?php else : ?>
                                <?php if($diri['id_kelas']==$data['id_kelas']): ?>
                                  <a href="#ikut<?=$no?>" class="btn btn-success" data-toggle="modal">Ikuti Ujian !</a>
                                <?php //else: ?>
                                  <!-- <p class="text-danger">Ujian/Tugas ini Bukan Untuk Kelasmu !</p> -->
                                <?php endif; ?>
                              <?php endif; ?>
                            <?php endif; ?>
                            </td>
                          </tr>
                          <!-- IKUT UJIAN -->
                          <div class="modal fade" id="ikut<?=$no?>">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title">Pengumuman Penting</h4>
                                </div>
                                <div class="modal-body">
                                  <ul>
                                    <li>
                                      <h5>Masukkan TOKEN yang diberikan pengajar</h5>
                                    </li>
                                    <li>
                                      <h5>Waktu pengerjaan ujian adalah <?=$data['lama_pengerjaan']?> Menit</h5>
                                    </li>
                                    <li>
                                      <h5>Pastikan koneksi internet anda stabil</h5>
                                    </li>
                                    <li>
                                      <h5>Ujian tidak dapat ditunda setelah diikuti. Apakah anda yakin mengikuti ujian ?</h5>
                                    </li>
                                  </ul>
                                </div>
                                <div class="modal-footer">
                                  <form action="<?=site_url()?>/ujianController/ujian/<?=$data['id_soalujian']?>" method="POST" role="form">
                                    <div class="row">
                                      <div class="col-md-12">
                                        <div class="form-group">
                                          <input type="text" class="form-control" name="token" placeholder="Input Token...">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-12">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Saya Belum Siap</button>
                                        <button type="submit" class="btn btn-danger">Ya! Lanjutkan!</button>
                                      </div>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- LIHAT PAKET DAN TOKEN                         -->
                          <div class="modal fade" id="detail<?=$no?>">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title"><b><?=$data['judul_soal_ujian']?> - Kelas <?=$data['nama_kelas']?></b></h4>
                                </div>
                                <div class="modal-body">
                                  <div class="row">
                                    <div class="col-md-6">
                                      <h5>Guru Pembimbing</h5>
                                    </div>
                                    <div class="col-md-6">
                                      <h5><?=$data['nama_guru']?></h5>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-6">
                                      <h5>Waktu Pengerjaan</h5>
                                    </div>
                                    <div class="col-md-6">
                                      <h5><?=$data['lama_pengerjaan']?> Menit</h5>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-6">
                                      <h5>Keterangan</h5>
                                    </div>
                                    <div class="col-md-6">
                                      <h5><?=$data['keterangan']?></h5>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-6">
                                      <h5>Batas Pengerjaan</h5>
                                    </div>
                                    <div class="col-md-6">
                                      <h5><?=date('D, d-m-Y', strtotime($data['waktu_ujian']))?></h5>
                                    </div>
                                  </div>
                                  <br>
                                  <div class="row">
                                    <div class="col-md-6">
                                      <h5>Token</h5>
                                    </div>
                                    <div class="col-md-6">
                                      <h5><b><?=$data['token']?></b></h5>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  <?php if($level == 'guru'): ?>
                                    <a href="<?=site_url()?>/Welcome/ceksoal/<?=$data['id_soalujian']?>" class="btn btn-primary">Cek Soal Terkait</a>
                                  <?php endif;?>
                                </div>
                              </div>
                            </div>
                          </div>

                          <!-- MODAL DELETE                         -->
                          <div class="modal fade" id="hapus<?=$no?>">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title">Hapus Paket Ujian</h4>
                                </div>
                                <div class="modal-body">
                                  Anda yakin akan menghapus paket Ujian ?
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Tidak, Batalkan</button>
                                  <a href="<?=site_url()?>/crudController/hapusPaketUjian/<?=$data['id_soalujian']?>" class="btn btn-danger">Ya! Hapus Segera</a>
                                </div>
                              </div>
                            </div>
                          </div>
                        <?php $no++; endforeach; ?>
                      <?php endif;?>
                      </tbody>
                    </table>
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
