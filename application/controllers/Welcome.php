<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('mymodel');
	}
	public function index()
	{
		$data['jml_guru'] 	= $this->mymodel->getData('tb_guru')->num_rows();
		$data['jml_kelas'] 	= $this->mymodel->getData('tb_kelas')->num_rows();
		$data['jml_siswa'] 	= $this->mymodel->getData('tb_siswa')->num_rows();
		$data['jml_mapel'] 	= $this->mymodel->getData('tb_mapel')->num_rows();
		$data['jml_materi'] = $this->mymodel->getData('tb_materi')->num_rows();
		$data['level']		= $this->session->userdata('level');
		if ($data['level'] == 'siswa') {
			$wherediri 			= array('nis'=>$this->session->userdata('username'));
			$diri 				= $this->mymodel->getWhere('tb_siswa',$wherediri)->row_array();
			$where 				= array('tb_soal_ujian.id_kelas' => $diri['id_kelas'],'tb_ujian.nis' => $diri['nis'] );
			$table 				= array('tb_ujian', 'tb_siswa');
			$join 				= array(
									'tb_soal_ujian.id_soalujian = tb_ujian.id_soalujian',
									'tb_ujian.nis = tb_siswa.nis',
									);
			$data['ujian_baru'] = $this->mymodel->joinwhere('tb_soal_ujian', $where, $table, $join)->num_rows();
		}
		$this->load->view('index',$data);
	}
	public function lihatData($aksi)
	{
		switch ($aksi) {
			case 'kelas':
				$kelas 			= $this->mymodel->getData('tb_kelas')->result_array();
				$data['sukses']	= $this->session->flashdata('sukses');
				$data['error']	= $this->session->flashdata('error');

				foreach ($kelas as $key => $value) {
					$where 		= array('id_kelas' => $value['id_kelas'] );
					$jml_siswa 	=	$this->mymodel->getWhere('tb_siswa',$where)->num_rows();

					$data['kelas'][$key]	= array(
												'id_kelas' 		=> $value['id_kelas'], 
												'nama_kelas' 	=> $value['nama_kelas'], 
												'jml_siswa' 	=> $jml_siswa, 
											);
					}
				$this->load->view('data/kelas',$data);
			break;

			case 'siswa':
				$data['sukses']	= $this->session->flashdata('sukses');
				$data['error']	= $this->session->flashdata('error');

				$from 			= 'tb_siswa';
				$table 			= array('tb_kelas');
				$join 			= array('tb_siswa.id_kelas = tb_kelas.id_kelas');
				$bycolumn 		= 'tb_kelas.nama_kelas';
				$order 			= 'ASC';
				$data['siswa']	= $this->mymodel->joinOrder($from, $table, $join, $bycolumn, $order)->result_array();
				$data['kelas']	= $this->mymodel->getData('tb_kelas')->result_array();
				$this->load->view('data/siswa',$data);
			break;
			
			case 'guru':
				$data['guru'] 	= $this->mymodel->getData('tb_guru')->result_array();
				$data['level'] 	= $this->session->userdata('level');
				$data['sukses']	= $this->session->flashdata('sukses');
				$data['error']	= $this->session->flashdata('error');
				$this->load->view('data/guru', $data);
			break;

			case 'pelajaran':
				$data['mapel'] 	= $this->mymodel->getData('tb_mapel')->result_array();
				$data['sukses']	= $this->session->flashdata('sukses');
				$data['error']	= $this->session->flashdata('error');
				$data['level'] 	= $this->session->userdata('level');
				$this->load->view('data/mapel', $data);
			break;

			case 'materi':
				$from 			= 'tb_materi';
				$table 			= array('tb_mapel','tb_guru');
				$join			= array(
										'tb_mapel.id_mapel = tb_materi.id_mapel',
										'tb_guru.nip = tb_materi.nip'
									);
				$data['materi'] = $this->mymodel->join($from, $table, $join)->result_array();
				$data['level'] 	= $this->session->userdata('level');
				$data['sukses']	= $this->session->flashdata('sukses');
				$data['error']	= $this->session->flashdata('error');
				$this->load->view('data/materi', $data);
			break;

			case 'soal':
				$data     		= array(
					'level'  => $this->session->userdata('level'),
					'nip'    => $this->session->userdata('username'),
					'nama'   => $this->session->userdata('nama'),
				);
				$from 			= 'tb_soal';
				$table			= array('tb_mapel','tb_guru');
				$join			= array(
									'tb_mapel.id_mapel = tb_soal.id_mapel',
									'tb_guru.nip = tb_soal.nip',
								);
				$bycolumn		= 'tb_soal.id_soal';
				$order 			= 'ASC';
				$soal	= $this->mymodel->joinOrder($from, $table, $join, $bycolumn, $order)->result_array();
				
				foreach ($soal as $key => $value) {
					$count 	= $this->mymodel->getWhere('tmp_list_soal',array('nip' => $data['nip'],'id_soal'=>$value['id_soal'] ))->num_rows();
					$data['soal'][$key] 	= array(
						'id_soal' 	=> $value['id_soal'],
						'nip' 		=> $data['nip'],
						'soal' 		=> $value['soal'],
						'a' 		=> $value['a'],
						'b' 		=> $value['b'],
						'c' 		=> $value['c'],
						'd' 		=> $value['d'],
						'kunci' 	=> $value['kunci'],
						'img_soal' 	=> $value['img_soal'],
						'id_mapel' 	=> $value['id_mapel'],
						'mapel' 	=> $value['mapel'],
						'nama_guru' => $value['nama_guru'],
						'aktivasi' 	=> $count > 0 ? '1' : '0',
					);
				}
				$data['level'] 	= $this->session->userdata('level');
				$data['sukses']	= $this->session->flashdata('sukses');
				$data['error']	= $this->session->flashdata('error');
				$data['kelas']	= $this->mymodel->getData('tb_kelas')->result_array(); 
				$this->load->view('data/soal', $data);
			break;

			case 'operator':
				$data['operator']	= $this->mymodel->getData('tb_operator')->result_array();
				$data['sukses']		= $this->session->flashdata('sukses');
				$data['error']		= $this->session->flashdata('error');
				$this->load->view('data/operator', $data);
			break;
			default:
			break;
		}
	}
	public function form($master,$id){
		switch ($master) {
			case 'addMateri':
				$data['guru'] 	= $this->mymodel->getData('tb_guru')->result_array();
				$data['mapel'] 	= $this->mymodel->getData('tb_mapel')->result_array();
				$this->load->view('form/materipelajaran',$data);
			break;
			
			case 'editMateri':
				$where = array('id_materi' => $id  );
				$data['materi'] 	= $this->mymodel->getWhere('tb_materi',$where)->row_array();
				$data['mapel']		= $this->mymodel->getData('tb_mapel')->result_array();
				$data['guru']		= $this->mymodel->getData('tb_guru')->result_array();
				$data['cek']		= 1;
				$this->load->view('form/materipelajaran',$data);
			break;
			case 'addSoal':
				$data['guru'] 	= $this->mymodel->getData('tb_guru')->result_array();
				$data['mapel'] 	= $this->mymodel->getData('tb_mapel')->result_array();
				$this->load->view('form/soal',$data);
			break;
			case 'editSoal':
				$where = array('id_soal' => $id  );
				$data['soal'] 		= $this->mymodel->getWhere('tb_soal',$where)->row_array();
				$data['mapel']		= $this->mymodel->getData('tb_mapel')->result_array();
				$data['guru']		= $this->mymodel->getData('tb_guru')->result_array();
				$data['cek']		= 1;
				$this->load->view('form/soal',$data);
			break;
			default:
			break;
		}
	}
	public function listUjian()
	{
		$data['sukses']		= $this->session->flashdata('sukses');
		$data['error']		= $this->session->flashdata('error');
		$data     = array(
					'level'  => $this->session->userdata('level'),
					'nip_now'    => $this->session->userdata('username'),
					'nama_now'   => $this->session->userdata('nama'),);
		$from 		= 'tb_soal_ujian';
		$table 		= array( 'tb_guru','tb_kelas' );
		$join 		= array( 'tb_soal_ujian.nip = tb_guru.nip','tb_soal_ujian.id_kelas = tb_kelas.id_kelas' );
		$bycolumn 	= 'tb_soal_ujian.id_soalujian';
		$order 		= 'ASC';
		$ujian		= $this->mymodel->joinOrder($from, $table, $join, $bycolumn, $order)->result_array();

		foreach ($ujian as $key => $value) {
			$where 			= array( 'id_soalujian' => $value['id_soalujian'], 'nis' => $data['nip_now'] );
			$sudahUjian 	= $this->mymodel->getWhere('tb_ujian',$where)->row_array();
			$jmlsudahUjian 	= $this->mymodel->getWhere('tb_ujian',$where)->num_rows();
			$data['ujian'][$key] 	= array(
									'id_soalujian' 		=> $value['id_soalujian'],
									'nip' 				=> $value['nip'],
									'token' 			=> $value['token'],
									'waktu_ujian' 		=> $value['waktu_ujian'],
									'lama_pengerjaan'	=> $value['lama_pengerjaan'],
									'keterangan'		=> $value['keterangan'],
									'log_soal_ujian'	=> $value['log_soal_ujian'],
									'nama_guru'			=> $value['nama_guru'],
									'sudah_ujian'		=> ($jmlsudahUjian>0)?'sudah':'belum',
									'nis' 				=> $sudahUjian['nis'],
									'nis_now'			=> $data['nip_now'],
									'judul_soal_ujian'	=> $value['judul_soal_ujian'],
									'id_kelas'			=> $value['id_kelas'],
									'nama_kelas'		=> $value['nama_kelas']
								);
		}
		$data['diri'] 		= $this->mymodel->getWhere('tb_siswa',array('nis' => $data['nip_now']))->row_array();
		$this->load->view('data/list_ujian',$data);
	}

	public function ceksoal($id)
	{
		$from 			= 'tb_list_soal_ujian';
		$table 			= array('tb_soal', 'tb_mapel');
		$where 			= array('id_soalujian' => $id);
		$join 			= array(
							'tb_list_soal_ujian.id_soal = tb_soal.id_soal',
							'tb_soal.id_mapel = tb_mapel.id_mapel'
						);
		$data['soal'] 	= $this->mymodel->joinwhere($from, $where, $table, $join)->result_array();
		$this->load->view('halaman/soal',$data);
	}

	function bacaMateri($id_materi){
		$from 			= 'tb_materi';
		$table 			= array(
						'tb_mapel', 'tb_guru',
						);
		$join 			= array(
						'tb_materi.id_mapel = tb_mapel.id_mapel',
						'tb_materi.nip 		= tb_guru.nip',
						);
		$bycolumn 		= 'tb_materi.id_mapel';
		$order 			= 'ASC';
		$data['materi'] = $this->mymodel->join($from, $table, $join)->result_array();
		if($id_materi>0){
			$data['baca']	= $this->mymodel->joinwhere($from, array('id_materi' => $id_materi), $table, $join)->row_array();
		}
		$this->load->view('halaman/materi', $data);
	}
	public function akun()
	{
		$level 				 = $this->session->userdata('level');
		$data['sukses']		 = $this->session->flashdata('sukses');
		$data['error']		 = $this->session->flashdata('error');
		switch ($level) {
			case 'operator':
				$id_operator = $this->session->userdata('username');
				$data['diri']= $this->mymodel->getWhere('tb_operator',array('id_operator' => $id_operator))->row_array();
				$this->load->view('halaman/biodataoperator', $data);
			break;

			case 'guru':
				$nip 		 = $this->session->userdata('username');
				$data['diri']= $this->mymodel->getWhere('tb_guru',array('nip' => $nip))->row_array();
				$this->load->view('halaman/biodataguru', $data);
			break;
			
			case 'siswa':
				$nis		 = $this->session->userdata('username');
				$data['diri']= $this->mymodel->getWhere('tb_siswa',array('nis' => $nis))->row_array();
				$this->load->view('halaman/biodatasiswa', $data);
			break;
			
			default:
			break;
		}
	}

}
?>