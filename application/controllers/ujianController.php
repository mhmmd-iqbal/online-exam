<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ujianController extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('mymodel');
	}

	public function navSoal($no)
	{
		$nis 		  	= $this->session->userdata('username');
		$where 		  	= array('tb_siswa.nis' => $nis, );
		$table 		  	= array('tb_soal','tb_siswa');
		$join 		  	= array('tmp_soal.id_soal = tb_soal.id_soal','tmp_soal.nis = tb_siswa.nis');
		$soal 			= $this->mymodel->joinwhereorder('tmp_soal', $where, $table, $join,'tmp_soal.id_tmp_soal','ASC')->result_array();
		$data['soal1']	= $soal[$no-1];
		$data['nomer'] 	= $no;
		$data['tmp']	= $this->mymodel->getWhere('tmp_jawaban',array('id_soal'=>$data['soal1']['id_soal'], 'nis' => $nis))->row_array();

		$sum = 0;
		foreach ($soal as $key => $value) {
			$where 		= array(
						'id_soal' 	=> $value['id_soal'],
						'nis' 		=> $nis,);
			$cek 		= $this->mymodel->getWhere('tmp_jawaban',$where)->num_rows();
			$sum		= ($cek > 0) ? $sum+1 : $sum+0;
			$data['soal'][$key] = array(
				'id_tmp_soal' 	=> $value['id_tmp_soal'],
				'nis' 			=> $value['nis'],
				'id_soal' 		=> $value['id_soal'],
				'cek'			=> ($cek>0)?'1':'0',
			);
		}
		$data['selesai'] = $sum;

		// MAINKAN WAKTU SELESAI
		$time_finished  = $this->mymodel->getWhere('tmp_waktu', array('id_soalujian'=>$data['soal1']['id_soalujian'],'nis'=>$nis))->row_array();
		$data['time'] 	= array('finished' => $time_finished['bataswaktu']);
		// END MAINKAN WAKTU SELESAI		
		$this->load->view('halaman/ujian',$data);
	}

	public function ujian($id)
	{
		$token 		= $this->input->post('token');
		$where 		= array('id_soalujian' => $id, 'token' => $token); 
		$cekToken 	= $this->mymodel->getWhere('tb_soal_ujian',$where)->num_rows();
		if ($cekToken > 0) {
			$nis 		 = $this->session->userdata('username');
			$table 		= 'tb_list_soal_ujian';
			$where 		= array('id_soalujian' => $id);
			$soal		 = $this->mymodel->getWhere($table,$where)->result_array();
			$n			 = ($this->mymodel->getWhere($table,$where)->num_rows())-1;

			$acak		= $this->mymodel->pengacakan($soal, $n);

			foreach ($acak as $key => $value) {
				$data 	 	= array(
								'id_soal'		=> $value['id_soal'],
								'nis'	 		=> $nis,
								'id_soalujian'	=> $value['id_soalujian']
							);
				$where_cek	= array('nis' =>$nis,'id_soal'=>$value['id_soal']);
				$ceksoaltmp	= $this->mymodel->getWhere('tmp_soal', $where_cek)->num_rows();
				if ($ceksoaltmp < 1) {
					$this->mymodel->inputData('tmp_soal',$data);
				}
			}

			$where 		  = array('tb_siswa.nis' => $nis, );
			$table 		  = array('tb_soal','tb_siswa');
			$join 		  = array('tmp_soal.id_soal = tb_soal.id_soal','tmp_soal.nis = tb_siswa.nis');

			$soal 		   = $this->mymodel->joinwhereorder('tmp_soal', $where, $table, $join,'tmp_soal.id_tmp_soal','ASC')->result_array();
			$data['soal1'] = $soal[0];
			$data['nomer'] = 1;

			$data['tmp']	= $this->mymodel->getWhere('tmp_jawaban',array('id_soal'=>$data['soal1']['id_soal'], 'nis' => $nis))->row_array();

			foreach ($soal as $key => $value) {
				$where 		= array(
							'id_soal' 	=> $value['id_soal'],
							'nis' 		=> $nis,);
				$cek 		= $this->mymodel->getWhere('tmp_jawaban',$where)->num_rows();
				$data['soal'][$key] = array(
					'id_tmp_soal' 	=> $value['id_tmp_soal'],
					'nis' 			=> $value['nis'],
					'id_soal' 		=> $value['id_soal'],
					'cek'			=> ($cek>0)?'1':'0',
				);
			}
			$data['selesai'] = 0;
			
			// MAINKAN WAKTU SELESAI
			$cekTime  		 = $this->mymodel->getWhere('tmp_waktu', array('id_soalujian'=>$id,'nis'=>$nis))->num_rows();
			if ($cekTime < 1) {
				$Time 		 = $this->mymodel->getWhere('tb_soal_ujian', array('id_soalujian' => $id))->row_array();
				$data_tmp		 = array(
					'id_soalujian'  => $id,
					'nis' 			=> $nis,
					'bataswaktu' 	=> time()+($Time['lama_pengerjaan']*60),
				);
				$this->mymodel->inputData('tmp_waktu',$data_tmp);
			}
			$time_finished  = $this->mymodel->getWhere('tmp_waktu', array('id_soalujian'=>$data['soal1']['id_soalujian'],'nis'=>$nis))->row_array();
			$data['time'] 	= array('finished' => $time_finished['bataswaktu']);
			// END MAINKAN WAKTU SELESAI
			
			$this->load->view('halaman/ujian',$data);
		}
		else{
			echo "Token Salah";
		}
	}


	public function tmpJawaban($jawaban, $idSoal, $nomer, $id_soalujian)
	{
		$where 		= array(
						'id_soal' => $idSoal,
					);
		$getJawaban	= $this->mymodel->getWhere('tb_soal',$where)->row_array();
		$nilai		= $jawaban == $getJawaban['kunci']?'benar':'salah';
		$nis 		= $this->session->userdata('username');
		$data 		= array(
					'id_soal' 		=> $idSoal,
					'nis' 			=> $nis,
					'jawaban' 		=> $jawaban,
					'nilai' 		=> $nilai,
					'id_soalujian'	=> $id_soalujian,
					'log_tmp' 		=> date('Y-m-d h:m:s'),);
		
		$where 		= array(
					'id_soal' 		=> $idSoal,
					'nis' 			=> $nis,);

		// Cek Dulu Add Atau Update 
		$cek 		= $this->mymodel->getWhere('tmp_jawaban',$where)->num_rows();
		if ($cek>0) {
			$this->mymodel->updateData($where,$data,'tmp_jawaban');}
		else{
			$this->mymodel->inputData('tmp_jawaban',$data);}
	
		redirect(site_url('ujianController/navSoal/'.$nomer));
	}

	public function hasilUjian($id_soalujian){
		$nis		= $this->session->userdata('username');
		$where 		= array(
						'id_soalujian' 	=> $id_soalujian,
						'nis'			=> $nis,);
		$benar 		= array(
						'id_soalujian' 	=> $id_soalujian,
						'nis'			=> $nis,
						'nilai'			=> 'benar',);
		$salah 		= array(
						'id_soalujian' 	=> $id_soalujian,
						'nis'			=> $nis,
						'nilai'			=> 'salah',);
		$jmlSoal 	= $this->mymodel->getWhere('tmp_soal',$where)->num_rows();
		$jmlBenar 	= $this->mymodel->getWhere('tmp_jawaban',$benar)->num_rows();
		$jmlSalah 	= $this->mymodel->getWhere('tmp_jawaban',$salah)->num_rows();
		$jmlKosong 	= $jmlSoal - $jmlBenar - $jmlSalah;
		$bobotNilai	= 100/$jmlSoal;
		$nilaiAkhir	= $bobotNilai*$jmlBenar;

		$data 		= array(
						'id_soalujian' 	=> $id_soalujian,
						'jml_soal'	 	=> $jmlSoal,
						'tot_benar'	 	=> $jmlBenar,
						'tot_salah'	 	=> $jmlSalah,
						'tot_kosong'	=> $jmlKosong,
						'nilai'			=> $nilaiAkhir,
						'nis'			=> $nis,
						'log_ujian'		=> date('Y-m-d h:i:s'), );


		$this->mymodel->inputData('tb_ujian',$data);
		$this->mymodel->hapusData($where,'tmp_jawaban');
		$this->mymodel->hapusData($where,'tmp_soal');
		$this->mymodel->hapusData($where,'tmp_waktu');
		redirect(site_url('Welcome/listUjian'));

	}
	public function nilaiUjian($id_soalujian)
	{
		$soalujian 	 = $this->mymodel->getWhere('tb_soal_ujian', array('id_soalujian' => $id_soalujian))->row_array();
		$table		 = array('tb_kelas');
		$join 		 = array('tb_siswa.id_kelas = tb_kelas.id_kelas');
		$bycolumn 	 = 'nama_kelas';
		$order 		 = 'DESC';
		// $siswa 	 = $this->mymodel->joinOrder('tb_siswa', $table, $join, $bycolumn, $order)->result_array();
		$siswa 		 = $this->mymodel->joinwhere('tb_siswa', array('tb_siswa.id_kelas' => $soalujian['id_kelas']), $table, $join)->result_array();
		foreach ($siswa as $key => $value) {
			$where 	 = array(
					'id_soalujian'	=> $id_soalujian,
					'nis'			=> $value['nis'], );
			$getNilai = $this->mymodel->getWhere('tb_ujian',$where)->row_array();	
			$cek 	  = $this->mymodel->getWhere('tb_ujian',$where)->num_rows();

			$data['siswa'][$key] = array(
					'nis' 			=> $value['nis'],
					'nama_siswa' 	=> $value['nama_siswa'],
					'photo_siswa' 	=> $value['photo_siswa'],
					'id_kelas' 		=> $value['id_kelas'],
					'nama_kelas'	=> $value['nama_kelas'],
					'nilai'			=> ($cek>0)?$getNilai['nilai']:'Belum Ujian',
					'log_ujian' 	=> ($cek>0)?$getNilai['log_ujian']:'',
					'benar' 		=> ($cek>0)?$getNilai['tot_benar']:'',
					'salah' 		=> ($cek>0)?$getNilai['tot_salah']:'',
					'kosong'	 	=> ($cek>0)?$getNilai['tot_kosong']:'',
			);	
		}
		$from 			= 'tb_soal_ujian';
		$where 			= array('id_soalujian' => $id_soalujian);
		$table			= array('tb_guru','tb_kelas');
		$join 			= array('tb_soal_ujian.nip = tb_guru.nip','tb_soal_ujian.id_kelas=tb_kelas.id_kelas');
		$data['ujian']	= $this->mymodel->joinwhere($from, $where, $table, $join)->row_array();
		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";

		$this->load->view('halaman/hasilUjian',$data);
	}

	public function cetakNilai($id_soalujian){
		$soalujian 	 = $this->mymodel->getWhere('tb_soal_ujian', array('id_soalujian' => $id_soalujian))->row_array();
		$table		 = array('tb_kelas');
		$join 		 = array('tb_siswa.id_kelas = tb_kelas.id_kelas');
		$bycolumn 	 = 'nama_kelas';
		$order 		 = 'DESC';
		// $siswa 	 = $this->mymodel->joinOrder('tb_siswa', $table, $join, $bycolumn, $order)->result_array();
		$siswa 		 = $this->mymodel->joinwhere('tb_siswa', array('tb_siswa.id_kelas' => $soalujian['id_kelas']), $table, $join)->result_array();
		foreach ($siswa as $key => $value) {
			$where 	 = array(
					'id_soalujian'	=> $id_soalujian,
					'nis'			=> $value['nis'], );
			$getNilai = $this->mymodel->getWhere('tb_ujian',$where)->row_array();	
			$cek 	  = $this->mymodel->getWhere('tb_ujian',$where)->num_rows();

			$data['siswa'][$key] = array(
					'nis' 			=> $value['nis'],
					'nama_siswa' 	=> $value['nama_siswa'],
					'id_kelas' 		=> $value['id_kelas'],
					'nilai'			=> ($cek>0)?$getNilai['nilai']:'0',
					'log_ujian' 	=> ($cek>0)?$getNilai['log_ujian']:'',
					'benar' 		=> ($cek>0)?$getNilai['tot_benar']:'',
					'salah' 		=> ($cek>0)?$getNilai['tot_salah']:'',
					'kosong'	 	=> ($cek>0)?$getNilai['tot_kosong']:'',
			);	
		}
		$from 			= 'tb_soal_ujian';
		$where 			= array('id_soalujian' => $id_soalujian);
		$table			= array('tb_guru','tb_kelas');
		$join 			= array('tb_soal_ujian.nip = tb_guru.nip','tb_soal_ujian.id_kelas=tb_kelas.id_kelas');
		$data['ujian']	= $this->mymodel->joinwhere($from, $where, $table, $join)->row_array();


		$this->load->library('pdf');
		$this->pdf->setPaper('A4', 'potrait');
	    $this->pdf->filename = "Nilai ".$data['ujian']['judul_soal_ujian']." Kelas ".$data['ujian']['nama_kelas'].".pdf";
	    $this->pdf->load_view('report/nilai',$data);
		// $this->load->view("report/nilai", $data);
		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
	}
}
?>