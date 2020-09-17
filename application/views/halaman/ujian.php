<?php
  if (!isset($cek)) { $cek = 0;}
  if (!isset($tmp)) { $tmp['jawaban'] = '';}
?>

<?php 
    $temp_waktu = ($time['finished']-time()); //dijadikan detik dan dikurangi waktu yang berlalu
    $temp_menit = (int)($temp_waktu/60);                //dijadikan menit lagi
    $temp_detik = $temp_waktu%60;                       //sisa bagi untuk detik
     
    if ($temp_menit < 60) { 
        $jam    = 0; 
        $menit  = $temp_menit; 
        $detik  = $temp_detik; 
    } else { 
        $jam    = (int)($temp_menit/60);    
        $menit  = $temp_menit%60;           
        $detik  = $temp_detik;
    }   
?>

<html lang="en">
<?php $this->load->view('template/header') ?>
<body id="page-top">
    <div id="wrapper">
      <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
        <?php $this->load->view('template/nav-bar-atas') ?>
          <div class="container-fluid">            
            <h2 class="h3 mb-4 text-gray-800" class="text-danger"><b></b></h2>
              <div class="row">
                <div class="col-md-4">
                  <div class="row" >
                    <div class="col-md-12">
                      <?php $no =1;$awal=1; foreach ($soal as $row ) : ?>
                      <a href="<?=site_url() ?>/ujianController/navSoal/<?=$no?>" class="btn btn-<?=($row['cek'] == 1)?'success':'secondary'?>"><?=$no?></a>
                      <?php $no++; endforeach; $akhir=$no-1; ?>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="card shadow">
                        <div class="card-header">
                          <h4 class="m-0 font-weight-bold text-primary">Waktu mengerjakan Soal</h4>
                        </div>
                        <div class="card-body border-left-primary">
                          <div id='timer'></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-8">
                  <div class="row"  style="padding-right: 10%">
                    <div class="col-md-12">
                      <div class="card shadow">
                        <div class="card-header">
                          <h4 class="m-0 font-weight-bold text-primary">SOAL <?=$nomer?></h4>
                        </div>
                        <div class="card-body border-left-primary">
                          <div class="row">
                            <div class="col-md-12">
                            <?php if($soal1['img_soal'] != 'NOIMAGE.jpg' ): ?>
                              <img style="float: left; margin: 5px" width="168px" height="240px" src="<?=base_url()?>assets/img/photo/<?=$soal1['img_soal']?>">            
                            <?php endif; ?>
                              <?=$soal1['soal']?>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-12">
                              <table  cellpadding="7px">
                                <hr>
                                <tr>
                                  <td style="padding-right: 10px"><a href="<?=site_url()?>/ujianController/tmpJawaban/a/<?=$soal1['id_soal']?>/<?=$nomer?>/<?=$soal1['id_soalujian']?>" class="btn btn-<?=($tmp['jawaban']=='a')?'success':'primary'?> btn-sm btn-circle">A</a></td>
                                  <td><?=$soal1['a']?></td>
                                </tr>
                                <tr>
                                  <td style="padding-right: 10px"><a href="<?=site_url()?>/ujianController/tmpJawaban/b/<?=$soal1['id_soal']?>/<?=$nomer?>/<?=$soal1['id_soalujian']?>" class="btn btn-<?=($tmp['jawaban']=='b')?'success':'primary'?> btn-sm btn-circle">B</a></td>
                                  <td><?=$soal1['b']?></td>
                                </tr>
                                <tr>
                                  <td style="padding-right: 10px"><a href="<?=site_url()?>/ujianController/tmpJawaban/c/<?=$soal1['id_soal']?>/<?=$nomer?>/<?=$soal1['id_soalujian']?>" class="btn btn-<?=($tmp['jawaban']=='c')?'success':'primary'?> btn-sm btn-circle">C</a></td>
                                  <td><?=$soal1['c']?></td>
                                </tr>
                                <tr>
                                  <td style="padding-right: 10px"><a href="<?=site_url()?>/ujianController/tmpJawaban/d/<?=$soal1['id_soal']?>/<?=$nomer?>/<?=$soal1['id_soalujian']?>" class="btn btn-<?=($tmp['jawaban']=='d')?'success':'primary'?> btn-sm btn-circle">D</a></td>
                                  <td><?=$soal1['d']?></td>
                                </tr>
                              </table>
                            </div>
                          </div>
                          <hr>
                          <div class="row">
                            <div class="col-md-12">
                              <?php if ($nomer != $awal) : ?>
                                <a href="<?=site_url()?>/ujianController/navSoal/<?=$nomer-1?>" class="btn btn-success" style="float: left;">Soal Sebelumnya</a>
                              <?php endif; ?>
                              <?php if ($nomer != $akhir) : ?>
                                <a href="<?=site_url()?>/ujianController/navSoal/<?=$nomer+1?>" class="btn btn-success" style="float: right;">Soal Selanjutnya</a>
                               <?php else : ?>
                                <?php if($selesai == $akhir): ?>  
                                  <a href="#verifikasiselesai" data-toggle="modal" class="btn btn-danger" style="float:right;" >SELESAI</a>    
                                <?php endif;?> 
                              <?php endif;?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <br>    
              
          </div>
        </div>
      <?php $this->load->view('template/footer') ?>
      </div>
    </div>
  <?php $this->load->view('template/scriptmenu') ?>
</body>
</html>
<div class="modal fade" id="verifikasiselesai">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Perhatian</h4>
      </div>
      <div class="modal-body">
        <ul>
          <li>Periksa kembali jawaban anda</li>
          <li>klik tombol <button class="btn btn-danger btn-sm" disabled="">SELESAI</button> untuk selesai mengikuti ujian</li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali ujian</button>
        <a href="<?=site_url()?>/ujianController/hasilUjian/<?=$soal1['id_soalujian']?>" id="submitting" class="btn btn-danger">SELESAI</a>
      </div>
    </div>
  </div>
</div>

    <script type="text/javascript">
        $(document).ready(function() {
            var detik   = <?= $detik; ?>;
            var menit   = <?= $menit; ?>;
            var jam     = <?= $jam; ?>;
            function hitung() {
                setTimeout(hitung,1000);
                if(menit < 10 && jam == 0){
                    var peringatan = 'style="color:red"';
                };
                $('#timer').html(
                    '<h5 '+peringatan+'>Sisa waktu Ujian <br />' + jam + ' jam : ' + menit + ' menit : ' + detik + ' detik</h5>'
                );
                detik --;
                if(detik < 0) {
                    detik = 59;
                    menit --;  
                    if(menit < 0) {
                        menit = 59;
                        jam --;
                        if(jam < 0) { 
                            clearInterval(hitung); 
                            window.location.href = "<?php echo site_url('ujianController/hasilUjian/'.$soal1['id_soalujian']); ?>"
                        } 
                    } 
                } 
            }           
            hitung();
        });
    </script>