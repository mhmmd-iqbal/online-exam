<html lang="en">
<?php $this->load->view('template/header') ?>
<body id="page-top">
    <div id="wrapper">
    <?php $this->load->view('template/menu_bar') ?>
      <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
        <?php $this->load->view('template/nav-bar-atas') ?>
          <div class="container-fluid">
            <h1 class="h3 mb-4 text-gray-800">Hasil <?=$ujian['judul_soal_ujian']?> Kelas <?=$ujian['nama_kelas']?></h1>
            <div class="row">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Tanggal Ujian : <?=date('d-m-Y', strtotime($ujian['log_soal_ujian']))?></h6>
                  <br>
                  <h6 class="m-0 font-weight-bold text-primary"><?=($ujian['jk_guru']=='L')?"Bapak ".$ujian['nama_guru'] : "Ibu ".$ujian['nama_guru'] ?></h6>
                </div>
                <div class="card-body">
                  <a href="<?=site_url()?>/ujianController/cetakNilai/<?=$ujian['id_soalujian']?>" style="float: right;" class="btn btn-success btn-sm"><i class="fa fa-print"></i> Cetak Hasil Ujian</a>
                  <br><br>
                  <table class="table table-bordered" id="dataTable">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th width="200px">Nama Siswa</th>
                        <th class="text-center">Benar</th>
                        <th class="text-center">Salah</th>
                        <th class="text-center">Tidak Dijawab</th>
                        <th>Tanggal Mengerjakan</th>
                        <th class="text-center">Nilai Ujian</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no=1; foreach($siswa as $data): ?>
                      <tr>
                        <td><?=$no?></td>
                        <td><?=$data['nama_siswa']?></td>
                        <td class="text-center"><?=$data['benar']?></td>
                        <td class="text-center"><?=$data['salah']?></td>
                        <td class="text-center"><?=$data['kosong']?></td>
                        <td>
                          <?=($data['log_ujian']!=''? date('d M Y - h:m:s', strtotime($data['log_ujian'])) : '')?>
                        </td>
                        <td class="text-center">
                          <div class="alert alert-<?=$data['nilai']>59?"success":($data['nilai'] =='Belum Ujian'?'warning':'danger')?>"><?=$data['nilai']?></div>
                        </td>
                      </tr>
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
