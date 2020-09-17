<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		p{
			margin-bottom: 0px;
			padding-bottom: 0px;
		}

	</style>
  	<link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap.css">
</head>
<body style="font-size: 12px; font-family: times-new-roman; margin-left: 50px; margin-right: 25px">
	<h4 style="text-align: center;" class="text-uppercase"><b><?php echo "Nilai ".$ujian['judul_soal_ujian']." Kelas ".$ujian['nama_kelas']?></b></h4>
	<br>
	<table cellpadding="5px">
		<tr>
			<td width="150px">Guru Pengasuh</td>
			<td>: <?=$ujian['nama_guru']?></td>
		</tr>
		<tr>
			<td>Tanggal</td>
			<td>: <?=date('d M Y', strtotime($ujian['waktu_ujian']))?></td>
		</tr>
		<tr>
			<td>Keterangan</td>
			<td>: <?=$ujian['judul_soal_ujian']?></td>
		</tr>
	</table>
	<hr style="color: black">
	<div class="">
		<div class="row">
			<div class="col-md-12">
				<table border="1px" cellpadding="5px">
					<thead class="thead-light">
						<tr>
							<th class="text-center" width="20px">No</th>
							<th class="text-center" width="250px;">Nama</th>
							<th class="text-center" width="100px">NIS</th>
							<th class="text-center" width="50px">Nilai</th>
							<th class="text-center" width="150px">Keterangan (L/TL)</th>
						</tr>
					</thead>
					<tbody>
						<?php $no=1; foreach ($siswa as $data): ?>
						<tr>
							<td><?=$no ?></td>
							<td><?=$data['nama_siswa'] ?></td>
							<td class="text-center"><?=$data['nis'] ?></td>
							<td class="text-center"><?=$data['nilai'] ?></td>
							<td class="text-center"><?=($data['nilai'] >59)? "L" :'TL' ?></td>
						</tr>
						<?php $no++; endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
		<br>
	</div>
	<br>
	<table  cellpadding="5px">
		<tr>
			<td>
				lhokseumawe, <?=date('d-m-Y')?>
			</td>
		</tr>
		<tr>
			<td>
				Guru Pengasuh
			</td>
		</tr>
		<tr>
			<td></td>
		</tr>
		<tr>
			<td></td>
		</tr>
		<tr>
			<td></td>
		</tr>
		<tr>
			<td>
				<?=$ujian['nama_guru']?>
			</td>
		</tr>
		<tr>
			<td>
				NIP. <?=$ujian['nip']?>				
			</td>
		</tr>
	</table>
</body>
</html>