<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class crudController extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('mymodel');
	}
	public function crudSiswa($aksi, $id)
	{
		$where = array('nis' =>$id, );
		switch ($aksi) {
			case 'add':
				// IMAGE 
				$ekstensi = $_FILES['photo']['type'];
				if($_FILES['photo']['name']){
					switch ($ekstensi) {
						case 'image/jpeg':
						$eks = 'jpg';
						break;
						case 'image/jpg':
							$eks = 'jpg';
							break;
						case 'image/png':
							$eks ='png';
						break;
						default:
						break;
					}
					$nmfile = "photo_".time().'_'.rand(1000,9999);
					$config['upload_path'] = './assets/img/photo_siswa';
					$config['allowed_types'] = 'jpg|png|jpeg';
					$config['file_name'] = $nmfile;
					$this->load->library('upload',$config); 
					$this->upload->do_upload('photo');
			        $photo = $config['file_name'].".".$eks;
				}
				else{
		           	$photo = "NOIMAGE.jpg";
				}

				$nama 		= $this->input->post('nama_siswa');
				$nis 		= $this->input->post('nis');
				$jk 		= $this->input->post('jk_siswa');
				$tmp_lahir 	= $this->input->post('tmp_lahir');
				$tgl_lahir 	= $this->input->post('tgl_lahir');
				$alamat 	= $this->input->post('alamat');
				$id_kelas 	= $this->input->post('id_kelas');

				$table	= 'tb_siswa';
				$data = array(
						'nis' 				=> $nis,
						'nama_siswa' 		=> $nama, 
						'jk_siswa' 			=> $jk, 
						'tmp_lahir_siswa'	=> $tmp_lahir,
						'tgl_lahir_siswa'	=> $tgl_lahir,
						'alamat_siswa'		=> $alamat,
						'photo_siswa'		=> $photo,
						'id_kelas'			=> $id_kelas,
						'log_siswa'			=> date('Y-m-d h:i:s'),
						'pass_siswa'		=> md5($nis), 
						);

				$this->mymodel->inputData($table, $data);
				$this->session->set_flashdata('sukses', '1 Data telah berhasil ditambahkan');
				redirect(site_url('/Welcome/lihatData/siswa'));
			break;
			
			case 'edit':
				//penyimpanan gambar
				$data['siswa'] = $this->mymodel->getWhere('tb_siswa',$where)->row_array();
				$photo = $_FILES['photo']['name'];
				if (($photo == '')||is_null($photo)) {
					$photo = $data['siswa']['photo_siswa'];
				}
				else{
					$ekstensi = $_FILES['photo']['type'];
					switch ($ekstensi) {
						case 'image/jpeg':
							$eks = 'jpg';
						break;
						case 'image/jpg':
							$eks = 'jpg';
						break;
						case 'image/png':
							$eks ='png';
						break;
						default:
						break; }
					$nmfile	 					= "photo_".time().'_'.rand(1000,9999);
					$config['upload_path'] 		= './assets/img/photo_siswa';
					$config['allowed_types'] 	= 'jpg|png|jpeg';
					$config['file_name'] 		= $nmfile;
					$this->load->library('upload',$config);
					$this->upload->do_upload('photo'); 
					$config['file_name'] 		= $nmfile;
		            $photo 						= $config['file_name'].".".$eks;
				}

				$nama 		= $this->input->post('nama_siswa');
				$nis 		= $this->input->post('nis');
				$jk 		= $this->input->post('jk_siswa');
				$tmp_lahir 	= $this->input->post('tmp_lahir');
				$tgl_lahir 	= $this->input->post('tgl_lahir');
				$alamat 	= $this->input->post('alamat');
				$id_kelas 	= $this->input->post('id_kelas');

				$table	= 'tb_siswa';
				$data = array(
						'nis' 				=> $nis,
						'nama_siswa' 		=> $nama, 
						'jk_siswa' 			=> $jk, 
						'tmp_lahir_siswa'	=> $tmp_lahir,
						'tgl_lahir_siswa'	=> $tgl_lahir,
						'alamat_siswa'		=> $alamat,
						'photo_siswa'		=> $photo,
						'id_kelas'			=> $id_kelas,
						'pass_siswa'		=> md5($nis), 
						);

				$this->mymodel->updateData($where,$data,$table);
				$this->session->set_flashdata('sukses', 'Data telah berhasil diubah');
				redirect(site_url('/Welcome/lihatData/siswa'));
			break;

			case 'delete':
				$this->mymodel->hapusData($where,'tb_siswa');
				$this->session->set_flashdata('error', '1 Data telah berhasil dihapus');
				redirect(site_url('/Welcome/lihatData/siswa'));
			break;
			case 'ganti_pass':
				$pass1 = $this->input->post('pass1');
				$pass2 = $this->input->post('pass2');
				if ($pass1 == $pass2) {
					$data 		= array('pass_siswa' => md5($pass1) );
					$this->mymodel->updateData($where,$data,'tb_siswa');
					$this->session->set_flashdata('sukses','Password Telah diganti');
					redirect(site_url('/Welcome/akun'));
				}
				else{
					$this->session->set_flashdata('error','Password tidak sama');
					redirect(site_url('/Welcome/akun'));
				}
			break;
			case 'reset_pass':
				$data 		= array('pass_siswa' => md5($id) );
				$this->mymodel->updateData($where,$data,'tb_siswa');
				$this->session->set_flashdata('error', 'Password telah berhasil di reset');
				redirect(site_url('/Welcome/lihatData/siswa'));
			break;
			default:
				$this->session->set_flashdata('error', 'Aksi tidak dapat diproses');
				redirect(site_url('/Welcome/lihatData/siswa'));
			break;
		}
	}
	
	public function crudGuru($aksi, $id)
	{
		$where = array('nip' =>$id, );
		switch ($aksi) {
			case 'add':
				// IMAGE 
				$ekstensi = $_FILES['photo']['type'];
				if($_FILES['photo']['name']){
					switch ($ekstensi) {
						case 'image/jpeg':
						$eks = 'jpg';
						break;
						case 'image/jpg':
							$eks = 'jpg';
							break;
						case 'image/png':
							$eks ='png';
						break;
						default:
						break;
					}
					$nmfile = "photo_".time().'_'.rand(1000,9999);
					$config['upload_path'] = './assets/img/photo_guru';
					$config['allowed_types'] = 'jpg|png|jpeg';
					$config['file_name'] = $nmfile;
					$this->load->library('upload',$config); 
					$this->upload->do_upload('photo');
			        $photo = $config['file_name'].".".$eks;
				}
				else{
		           	$photo = "NOIMAGE.jpg";
				}

				$nama 		= $this->input->post('nama_guru');
				$nip 		= $this->input->post('nip');
				$jk 		= $this->input->post('jk_guru');
				$tmp_lahir 	= $this->input->post('tmp_lahir');
				$tgl_lahir 	= $this->input->post('tgl_lahir');
				$alamat 	= $this->input->post('alamat');
				$table		= 'tb_guru';

				$data = array(
						'nip' 				=> $nip,
						'nama_guru' 		=> $nama, 
						'jk_guru' 			=> $jk, 
						'tmp_lahir_guru'	=> $tmp_lahir,
						'tgl_lahir_guru'	=> $tgl_lahir,
						'alamat_guru'		=> $alamat,
						'photo_guru'		=> $photo,
						'pass_guru'			=> md5($nip),
						'log_guru'			=> date('Y-m-d h:i:s') 
						);

				$this->mymodel->inputData($table, $data);
				$this->session->set_flashdata('sukses', '1 Data telah berhasil ditambahkan');
				redirect(site_url('/Welcome/lihatData/guru'));
			break;
			
			case 'edit':
				//penyimpanan gambar
				$data['guru'] = $this->mymodel->getWhere('tb_guru',$where)->row_array();
				$photo = $_FILES['photo']['name'];
				if (($photo == '')||is_null($photo)) {
					$photo = $data['guru']['photo_guru'];
				}
				else{
					$ekstensi = $_FILES['photo']['type'];
					switch ($ekstensi) {
						case 'image/jpeg':
							$eks = 'jpg';
						break;
						case 'image/jpg':
							$eks = 'jpg';
						break;
						case 'image/png':
							$eks ='png';
						break;
						default:
						break; }
					$nmfile = "photo_".time().'_'.rand(1000,9999);
					$config['upload_path'] = './assets/img/photo_guru';
					$config['allowed_types'] = 'jpg|png|jpeg';
					$config['file_name'] = $nmfile;
					$this->load->library('upload',$config);
					$this->upload->do_upload('photo'); 
					$config['file_name'] = $nmfile;
		            $photo = $config['file_name'].".".$eks;
				}

				$nama 		= $this->input->post('nama_guru');
				$nip 		= $this->input->post('nip');
				$jk 		= $this->input->post('jk_guru');
				$tmp_lahir 	= $this->input->post('tmp_lahir');
				$tgl_lahir 	= $this->input->post('tgl_lahir');
				$alamat 	= $this->input->post('alamat');
				$table	= 'tb_guru';
				$data = array(
						'nip' 				=> $nip,
						'nama_guru' 		=> $nama, 
						'jk_guru' 			=> $jk, 
						'tmp_lahir_guru'	=> $tmp_lahir,
						'tgl_lahir_guru'	=> $tgl_lahir,
						'alamat_guru'		=> $alamat,
						'photo_guru'		=> $photo, 
						'pass_guru'			=> md5($nip),
						);
				$this->mymodel->updateData($where,$data,$table);
				$this->session->set_flashdata('sukses', '1 Data telah berhasil diubah');
				redirect(site_url('/Welcome/lihatData/guru'));
			break;

			case 'delete':
				$this->mymodel->hapusData($where,'tb_guru');
				$this->session->set_flashdata('error', '1 Data telah berhasil dihapus');
				redirect(site_url('/Welcome/lihatData/guru'));
			break;
			case 'reset_pass':
				$data 		= array('pass_guru' => md5($id) );
				$this->mymodel->updateData($where,$data,'tb_guru');
				$this->session->set_flashdata('error', 'Password telah berhasil di reset');
				redirect(site_url('/Welcome/lihatData/guru'));
			break;
			case 'ganti_pass':
				$pass1 = $this->input->post('pass1');
				$pass2 = $this->input->post('pass2');
				if ($pass1 == $pass2) {
					$data 		= array('pass_guru' => md5($pass1) );
					$this->mymodel->updateData($where,$data,'tb_guru');
					$this->session->set_flashdata('sukses','Password Telah diganti');
					redirect(site_url('/Welcome/akun'));
				}
				else{
					$this->session->set_flashdata('error','Password tidak sama');
					redirect(site_url('/Welcome/akun'));
				}
			break;
			default:
				$this->session->set_flashdata('error', 'Aksi tidak dapat diproses');
				redirect(site_url('/Welcome/lihatData/guru'));
			break;
		}
	}
	public function crudMapel($aksi, $id){
		$where = array('id_mapel' => $id );
		switch ($aksi) {
			case 'add':
				$mapel 	= $this->input->post('mapel');
				$data = array(
						'mapel' 			=> $mapel,
						'log_mapel'			=> date('Y-m-d h:i:s') 
						);
				$this->mymodel->inputData('tb_mapel',$data);
				$this->session->set_flashdata('sukses', '1 Data telah berhasil ditambahkan');
				redirect(site_url('/Welcome/lihatData/pelajaran'));
			break;
			
			case 'edit':
				$mapel = $this->input->post('mapel');
				$data = array('mapel' => $mapel );
				$this->mymodel->updateData($where, $data, 'tb_mapel');
				$this->session->set_flashdata('sukses', '1 Data telah berhasil diubah');
				redirect(site_url('/Welcome/lihatData/pelajaran'));
			break;

			case 'delete':
				$this->mymodel->hapusData($where, 'tb_mapel');
				$this->session->set_flashdata('error', '1 Data telah berhasil dihapus');
				redirect(site_url('/Welcome/lihatData/pelajaran'));
			break;

			default:
				$this->session->set_flashdata('error', 'Aksi tidak dapat diproses');
				redirect(site_url('/Welcome/lihatData/pelajaran'));
			break;
		}
	}
	public function crudMateri($aksi, $id){
		$where = array('id_materi' => $id );
		switch ($aksi) {
			case 'add':
				$ekstensi = $_FILES['img_materi']['type'];
				if($_FILES['img_materi']['name']){
					switch ($ekstensi) {
						case 'image/jpeg':
						$eks = 'jpg';
						break;
						case 'image/jpg':
							$eks = 'jpg';
							break;
						case 'image/png':
							$eks ='png';
						break;
						default:
						break;
					}
					$nmfile 					= "photo_".time().'_'.rand(1000,9999);
					$config['upload_path'] 		= './assets/img/photo';
					$config['allowed_types'] 	= 'jpg|png|jpeg';
					$config['file_name'] 		= $nmfile;
					$this->load->library('upload',$config);
					$this->upload->initialize($config); 
					$this->upload->do_upload('img_materi');
			        $img_materi = $config['file_name'].".".$eks;
				}
				else{
		           	$img_materi = "NOIMAGE.jpg";
				}

				// FILE MODUL 
				if (($_FILES['modul']['name'])!='') {
					$modul 					= time().rand(01,99).$_FILES['modul']['name'];
					$config['upload_path'] 	= './assets/file';
					$config['allowed_types'] 	= 'pdf';
					$config['file_name'] 	= $modul;
					$this->load->library('upload',$config);
		   			$this->upload->initialize($config); 
					$this->upload->do_upload('modul');
				}
				else{
					$modul 					= NULL;
				}			
				// END MODUL
				$judul_materi	= $this->input->post('judul_materi');
				$materi			= $this->input->post('materi');
				$nip			= $this->input->post('nip');	
				$id_materi		= $this->input->post('id_materi');
				$id_mapel		= $this->input->post('id_mapel');
				$data 			= array(	
									'judul_materi' 	=> $judul_materi,
									'materi' 		=> $materi, 
									'nip' 			=> $nip, 
									'img_materi'	=> $img_materi,
									'id_mapel'		=> $id_mapel,
									'modul'			=> $modul,
									'log_materi'	=> date('Y-m-d h:i:s') 

								);
				$this->mymodel->inputData('tb_materi',$data);
				$this->session->set_flashdata('sukses','Materi telah ditambakan');
				redirect(site_url('/Welcome/lihatData/materi'));
			break;
			case 'edit':
				//penyimpanan gambar
				$data['materi'] = $this->mymodel->getWhere('tb_materi',$where)->row_array();
				$photo = $_FILES['img_materi']['name'];
				if (($photo == '')||is_null($photo)) {
					$img_materi = $data['materi']['img_materi'];
				}
				else{
					$ekstensi = $_FILES['img_materi']['type'];
					switch ($ekstensi) {
						case 'image/jpeg':
							$eks = 'jpg';
						break;
						case 'image/jpg':
							$eks = 'jpg';
						break;
						case 'image/png':
							$eks ='png';
						break;
						default:
						break; }
					$nmfile = "photo_".time().'_'.rand(1000,9999);
					$config['upload_path'] = './assets/img/photo';
					$config['allowed_types'] = 'jpg|png|jpeg';
					$config['file_name'] = $nmfile;
					$this->load->library('upload',$config);
					$this->upload->do_upload('img_materi'); 
					$config['file_name'] = $nmfile;
		            $img_materi = $config['file_name'].".".$eks;
				}
				
				// FILE MODUL 
				if (($_FILES['modul']['name'])!='') {
					$modul 					= time().rand(01,99).$_FILES['modul']['name'];
					$config['upload_path'] 	= './assets/file';
					$config['allowed_types'] 	= 'pdf';
					$config['file_name'] 	= $modul;
					$this->load->library('upload',$config);
		   			$this->upload->initialize($config); 
					$this->upload->do_upload('modul');
				}
				else{
					$modul 					= $data['materi']['modul'];
				}

				$judul_materi	= $this->input->post('judul_materi');
				$materi			= $this->input->post('materi');
				$id_mapel		= $this->input->post('id_mapel');
				$data 			= array(	
									'judul_materi' 	=> $judul_materi,
									'materi' 		=> $materi, 
									'img_materi'	=> $img_materi,
									'id_mapel'		=> $id_mapel,
									'modul'			=> $modul,
								);
				$this->mymodel->updateData($where,$data,'tb_materi');
				$this->session->set_flashdata('sukses','Materi telah dirubah');
				redirect(site_url('/Welcome/lihatData/materi'));
			break;
			case 'delete':
				$this->mymodel->hapusData($where, 'tb_materi');
				$this->session->set_flashdata('error', '1 Data telah berhasil dihapus');
				redirect(site_url('/Welcome/lihatData/materi'));
			break;

			case 'download':
				$materi 	= $this->mymodel->getWhere('tb_materi',$where)->row_array();
	            $file = 'assets/file/'.$materi['modul'];
	            force_download($file, NULL);
			break;
			default:
			break;
		}
	}
	public function crudKelas($aksi, $id)
	{
		$where = array('id_kelas' => $id );
		switch ($aksi) {
			case 'add':
				$nama_kelas		= $this->input->post('nama_kelas');
				$data 			= array(
									'nama_kelas' => $nama_kelas, 
									'log_kelas' => date('Y-m-d h:i:s'), 
								);
				$this->mymodel->inputData('tb_kelas',$data);
				$this->session->set_flashdata('sukses','Kelas telah ditambahkan');
				redirect(site_url('/Welcome/lihatData/kelas'));
			break;
			case 'delete':
				$this->mymodel->hapusData($where, 'tb_kelas');
				$this->session->set_flashdata('error','Kelas telah dihapus');
				redirect(site_url('/Welcome/lihatData/kelas'));
			break;

			case 'edit':
				$nama_kelas		= $this->input->post('nama_kelas');
				$data 			= array(
									'nama_kelas' => $nama_kelas, 
								);
				$this->mymodel->updateData($where,$data,'tb_kelas');
				$this->session->set_flashdata('sukses','Kelas telah diubah');
				redirect(site_url('/Welcome/lihatData/kelas'));
			break;
			default:
				# code...
				break;
		}
	}

	public function crudOperator($aksi,$id)
	{
		$where = array('id_operator' => $id, );
		switch ($aksi) {
			case 'add':
				// IMAGE 
				$ekstensi = $_FILES['photo']['type'];
				if($_FILES['photo']['name']){
					switch ($ekstensi) {
						case 'image/jpeg':
						$eks = 'jpg';
						break;
						case 'image/jpg':
							$eks = 'jpg';
							break;
						case 'image/png':
							$eks ='png';
						break;
						default:
						break;
					}
					$nmfile = "photo_".time().'_'.rand(1000,9999);
					$config['upload_path'] = './assets/img/photo_operator';
					$config['allowed_types'] = 'jpg|png|jpeg';
					$config['file_name'] = $nmfile;
					$this->load->library('upload',$config); 
					$this->upload->do_upload('photo');
			        $photo = $config['file_name'].".".$eks;
				}
				else{
		           	$photo = "NOIMAGE.jpg";
				}

				$table			= 'tb_operator';
				$nama_operator	= $this->input->post('nama_operator');
				$id_operator	= $this->input->post('id_operator');
				$jk_operator	= $this->input->post('jk_operator');
				$log_operator	= date('Y-m-d h:i:s');

				$data 			= array(
								'nama_operator' 	=> $nama_operator, 
								'id_operator' 		=> $id_operator, 
								'jk_operator' 		=> $jk_operator, 
								'photo_operator' 	=> $photo, 
								'pass_operator' 	=> md5($id_operator), 
								'log_operator' 		=> $log_operator, 
							);
				$this->mymodel->inputData($table, $data);
				$this->session->set_flashdata('sukses','operator baru telah ditambahkan');
				redirect(site_url('/Welcome/lihatData/operator'));
			break;
			
			case 'delete':
				$this->mymodel->hapusData($where,'tb_operator');
				$this->session->set_flashdata('error','Data telah dihapus');
				redirect(site_url('/Welcome/lihatData/operator'));
			break;

			case 'update':
				//penyimpanan gambar
				$data['operator'] = $this->mymodel->getWhere('tb_operator',$where)->row_array();
				$photo = $_FILES['photo']['name'];
				if (($photo == '')||is_null($photo)) {
					$photo = $data['operator']['photo_operator'];
				}
				else{
					$ekstensi = $_FILES['photo']['type'];
					switch ($ekstensi) {
						case 'image/jpeg':
							$eks = 'jpg';
						break;
						case 'image/jpg':
							$eks = 'jpg';
						break;
						case 'image/png':
							$eks ='png';
						break;
						default:
						break; }
					$nmfile = "photo_".time().'_'.rand(1000,9999);
					$config['upload_path'] = './assets/img/photo_operator';
					$config['allowed_types'] = 'jpg|png|jpeg';
					$config['file_name'] = $nmfile;
					$this->load->library('upload',$config);
					$this->upload->do_upload('photo'); 
					$config['file_name'] = $nmfile;
		            $photo = $config['file_name'].".".$eks;
				}
				$table			= 'tb_operator';
				$nama_operator	= $this->input->post('nama_operator');
				$id_operator	= $this->input->post('id_operator');
				$jk_operator	= $this->input->post('jk_operator');

				$data 			= array(
								'nama_operator' 	=> $nama_operator, 
								'id_operator' 		=> $id_operator, 
								'jk_operator' 		=> $jk_operator, 
								'photo_operator' 	=> $photo, 
							);
				$this->mymodel->updateData($where,$data,$table);
				$this->session->set_flashdata('sukses','Data telah diupdate');
				redirect(site_url('/Welcome/lihatData/operator'));
			break;

			case 'ganti_pass':
				$pass1 = $this->input->post('pass1');
				$pass2 = $this->input->post('pass2');
				if ($pass1 == $pass2) {
					$data 		= array('pass_operator' => md5($pass1) );
					$this->mymodel->updateData($where,$data,'tb_operator');
					$this->session->set_flashdata('sukses','Password Telah diganti');
					redirect(site_url('/Welcome/akun'));
				}
				else{
					$this->session->set_flashdata('error','Password tidak sama');
					redirect(site_url('/Welcome/akun'));
				}

			default:
				echo "Belum Buat";
				break;
		}
	}

	public function crudsoal($aksi, $id)
	{
		$where = array('id_soal' => $id, );
		switch ($aksi) {
			case 'add':
				// IMAGE 
				$ekstensi = $_FILES['img_soal']['type'];
				if($_FILES['img_soal']['name']){
					switch ($ekstensi) {
						case 'image/jpeg':
						$eks = 'jpg';
						break;
						case 'image/jpg':
							$eks = 'jpg';
							break;
						case 'image/png':
							$eks ='png';
						break;
						default:
						break;
					}
					$nmfile = "photo_".time().'_'.rand(1000,9999);
					$config['upload_path'] = './assets/img/photo';
					$config['allowed_types'] = 'jpg|png|jpeg';
					$config['file_name'] = $nmfile;
					$this->load->library('upload',$config); 
					$this->upload->do_upload('img_soal');
			        $photo = $config['file_name'].".".$eks;
				}
				else{
		           	$photo = "NOIMAGE.jpg";
				}

				$id_mapel		= $this->input->post('id_mapel');
				$nip			= $this->input->post('nip');
				$judul_soal		= $this->input->post('judul_soal');
				$a 				= $this->input->post('a');
				$b 				= $this->input->post('b');
				$c 				= $this->input->post('c');
				$d 				= $this->input->post('d');
				$kunci 			= $this->input->post('kunci');
				$log_soal		= date('Y-m-d h:i:s');

				$data 			= array(
									'id_mapel' 	=> $id_mapel, 
									'nip' 		=> $nip, 
									'soal'		=> $judul_soal, 
									'a' 		=> $a, 
									'b' 		=> $b, 
									'c' 		=> $c, 
									'd' 		=> $d, 
									'kunci' 	=> $kunci,
									'log_soal' 	=> $log_soal, 
									'img_soal' 	=> $photo, 
								);
				$this->mymodel->inputData('tb_soal',$data);
				$this->session->set_flashdata('sukses','Soal baru telah ditambahkan');
				redirect(site_url('Welcome/lihatData/soal'));
			break;

			case 'edit':
				//penyimpanan gambar
				$data['tb_soal'] = $this->mymodel->getWhere('tb_soal',$where)->row_array();
				$photo = $_FILES['img_soal']['name'];
				if (($photo == '')||is_null($photo)) {
					$photo = $data['tb_soal']['img_soal'];
				}
				else{
					$ekstensi = $_FILES['img_soal']['type'];
					switch ($ekstensi) {
						case 'image/jpeg':
							$eks = 'jpg';
						break;
						case 'image/jpg':
							$eks = 'jpg';
						break;
						case 'image/png':
							$eks ='png';
						break;
						default:
						break;
					}
					$nmfile = "photo_".time().'_'.rand(1000,9999);
					$config['upload_path'] = './assets/img/photo';
					$config['allowed_types'] = 'jpg|png|jpeg';
					$config['file_name'] = $nmfile;
					$this->load->library('upload',$config); 
					$this->upload->do_upload('img_soal');
				    $photo = $config['file_name'].".".$eks;
				}

				//Penyimpanan Data ke SQL Server
				$id_mapel		= $this->input->post('id_mapel');
				$nip			= $this->input->post('nip');
				$judul_soal		= $this->input->post('judul_soal');
				$a 				= $this->input->post('a');
				$b 				= $this->input->post('b');
				$c 				= $this->input->post('c');
				$d 				= $this->input->post('d');
				$kunci 			= $this->input->post('kunci');
				$data 			= array(
									'id_mapel' 	=> $id_mapel, 
									'nip' 		=> $nip, 
									'soal'		=> $judul_soal, 
									'a' 		=> $a, 
									'b' 		=> $b, 
									'c' 		=> $c, 
									'd' 		=> $d, 
									'kunci' 	=> $kunci,
									'img_soal' 	=> $photo, 
								);
				$this->mymodel->updateData($where,$data,'tb_soal');
				$this->session->set_flashdata('sukses','Soal telah diperbarui');
				redirect(site_url('Welcome/lihatData/soal'));
			break;
			
			case 'delete':
				$this->mymodel->hapusData($where,'tb_soal');
				$this->session->set_flashdata('error','Soal telah dihapus');
				redirect(site_url('Welcome/lihatData/soal'));
			break;
			default:
			break;
		}
	}
	public function aktivasiSoal($id, $nip){
		$data 	= array(
			'id_soal'	=> $id,
			'nip'		=> $nip,
		);
		$this->mymodel->inputData('tmp_list_soal',$data);
		redirect(site_url('Welcome/lihatData/soal'));
	}
	public function nonAktivasiSoal($id, $nip)
	{
		$where 	= array(
			'id_soal'	=> $id,
			'nip'		=> $nip,
		);
		$this->mymodel->hapusData($where,'tmp_list_soal');
		redirect(site_url('Welcome/lihatData/soal'));
	}

	public function getToken($token, $nip)
	{
		$cekSoal= $this->mymodel->getWhere('tmp_list_soal',array('nip' =>$nip))->num_rows();
		if ($cekSoal<1) { 
			$this->session->set_flashdata('error','Harap memilih soal terlebih dahulu');
			redirect(site_url('Welcome/lihatData/soal'));
		}
		else{
			$data 	= array(
				'nip'			 	=> $nip,
				'token'			 	=> $token,
				'waktu_ujian'	 	=> $this->input->post('waktu'),
				'lama_pengerjaan'  	=> $this->input->post('jam'),
				'keterangan'	 	=> $this->input->post('keterangan'),
				'judul_soal_ujian'  => $this->input->post('nama'),
				'id_kelas' 		 	=> $this->input->post('id_kelas'),
				'log_soal_ujian' 	=> date('Y-m-d h:i:s')
			);
			$this->mymodel->inputData('tb_soal_ujian',$data);
			$lastId		= $this->mymodel->getDataorder('tb_soal_ujian', 'id_soalujian', 'DESC')->row_array();
			
			$where 		= array(
				'nip'	=> $nip,
			);
			$getTmpSoal	= $this->mymodel->getWhere('tmp_list_soal',$where)->result_array();

			foreach ($getTmpSoal as $key => $value) {
				$data 	= array(
					'id_soal' 		=> $value['id_soal'],
					'id_soalujian'	=> $lastId['id_soalujian']
				);
				$this->mymodel->inputData('tb_list_soal_ujian',$data);
				$where 	= array(
					'id_soal'		=> $value['id_soal'],
					'nip' 			=> $nip, 
				);
				$this->mymodel->hapusData($where,'tmp_list_soal');
			}
			redirect(site_url('Welcome/listUjian'));
		}
	}

	public function hapusPaketUjian($id)
	{
		$where 	= array('id_soalujian' => $id);
		$this->mymodel->hapusData($where,'tb_soal_ujian');
		$this->session->set_flashdata('sukses','Paket Ujian Telah Berhasil Dihapus');
		redirect(site_url('Welcome/listUjian'));
	}

	public function updateAkun($master, $id)
	{
		switch ($master) {
			case 'operator':
				$where = array('id_operator' => $id, );
				//penyimpanan gambar
				$data['operator'] = $this->mymodel->getWhere('tb_operator',$where)->row_array();
				$photo = $_FILES['photo']['name'];
				if (($photo == '')||is_null($photo)) {
					$photo = $data['operator']['photo_operator'];
				}
				else{
					$ekstensi = $_FILES['photo']['type'];
					switch ($ekstensi) {
						case 'image/jpeg':
							$eks = 'jpg';
						break;
						case 'image/jpg':
							$eks = 'jpg';
						break;
						case 'image/png':
							$eks ='png';
						break;
						default:
						break; }
					$nmfile = "photo_".time().'_'.rand(1000,9999);
					$config['upload_path'] = './assets/img/photo_operator';
					$config['allowed_types'] = 'jpg|png|jpeg';
					$config['file_name'] = $nmfile;
					$this->load->library('upload',$config);
					$this->upload->do_upload('photo'); 
					$config['file_name'] = $nmfile;
		            $photo = $config['file_name'].".".$eks;
				}
				$table			= 'tb_operator';
				$nama_operator	= $this->input->post('nama_operator');
				$id_operator	= $this->input->post('id_operator');
				$jk_operator	= $this->input->post('jk_operator');

				$data 			= array(
								'nama_operator' 	=> $nama_operator, 
								'jk_operator' 		=> $jk_operator, 
								'photo_operator' 	=> $photo, 
							);
				$this->mymodel->updateData($where,$data,$table);
				$this->session->set_flashdata('sukses','Data telah diupdate');
				redirect(site_url('/Welcome/akun'));
			break;
			case 'guru':
				$where = array('nip' =>$id, );
				//penyimpanan gambar
				$data['guru'] = $this->mymodel->getWhere('tb_guru',$where)->row_array();
				$photo = $_FILES['photo']['name'];
				if (($photo == '')||is_null($photo)) {
					$photo = $data['guru']['photo_guru'];
				}
				else{
					$ekstensi = $_FILES['photo']['type'];
					switch ($ekstensi) {
						case 'image/jpeg':
							$eks = 'jpg';
						break;
						case 'image/jpg':
							$eks = 'jpg';
						break;
						case 'image/png':
							$eks ='png';
						break;
						default:
						break; }
					$nmfile = "photo_".time().'_'.rand(1000,9999);
					$config['upload_path'] = './assets/img/photo_guru';
					$config['allowed_types'] = 'jpg|png|jpeg';
					$config['file_name'] = $nmfile;
					$this->load->library('upload',$config);
					$this->upload->do_upload('photo'); 
					$config['file_name'] = $nmfile;
		            $photo = $config['file_name'].".".$eks;
				}

				$nama 		= $this->input->post('nama_guru');
				$nip 		= $this->input->post('nip');
				$jk 		= $this->input->post('jk_guru');
				$tmp_lahir 	= $this->input->post('tmp_lahir');
				$tgl_lahir 	= $this->input->post('tgl_lahir');
				$alamat 	= $this->input->post('alamat');
				$table	= 'tb_guru';
				$data = array(
						'nama_guru' 		=> $nama, 
						'jk_guru' 			=> $jk, 
						'tmp_lahir_guru'	=> $tmp_lahir,
						'tgl_lahir_guru'	=> $tgl_lahir,
						'alamat_guru'		=> $alamat,
						'photo_guru'		=> $photo, 
						'pass_guru'			=> md5($nip),
						);
				$this->mymodel->updateData($where,$data,$table);
				$this->session->set_flashdata('sukses', '1 Data telah berhasil diubah');
				redirect(site_url('/Welcome/akun'));	
			break;
			case 'siswa':
				$where = array('nis' =>$id, );
				//penyimpanan gambar
				$data['siswa'] = $this->mymodel->getWhere('tb_siswa',$where)->row_array();
				$photo = $_FILES['photo']['name'];
				if (($photo == '')||is_null($photo)) {
					$photo = $data['siswa']['photo_siswa'];
				}
				else{
					$ekstensi = $_FILES['photo']['type'];
					switch ($ekstensi) {
						case 'image/jpeg':
							$eks = 'jpg';
						break;
						case 'image/jpg':
							$eks = 'jpg';
						break;
						case 'image/png':
							$eks ='png';
						break;
						default:
						break; }
					$nmfile	 					= "photo_".time().'_'.rand(1000,9999);
					$config['upload_path'] 		= './assets/img/photo_siswa';
					$config['allowed_types'] 	= 'jpg|png|jpeg';
					$config['file_name'] 		= $nmfile;
					$this->load->library('upload',$config);
					$this->upload->do_upload('photo'); 
					$config['file_name'] 		= $nmfile;
		            $photo 						= $config['file_name'].".".$eks;
				}

				$nama 		= $this->input->post('nama_siswa');
				$nis 		= $this->input->post('nis');
				$jk 		= $this->input->post('jk_siswa');
				$tmp_lahir 	= $this->input->post('tmp_lahir');
				$tgl_lahir 	= $this->input->post('tgl_lahir');
				$alamat 	= $this->input->post('alamat');
				$id_kelas 	= $this->input->post('id_kelas');

				$table	= 'tb_siswa';
				$data = array(
						'nama_siswa' 		=> $nama, 
						'jk_siswa' 			=> $jk, 
						'tmp_lahir_siswa'	=> $tmp_lahir,
						'tgl_lahir_siswa'	=> $tgl_lahir,
						'alamat_siswa'		=> $alamat,
						'photo_siswa'		=> $photo,
						'pass_siswa'		=> md5($nis), 
						);

				$this->mymodel->updateData($where,$data,$table);
				$this->session->set_flashdata('sukses', 'Data telah berhasil diubah');
				redirect(site_url('/Welcome/akun'));	
			break;
			default:
			break;
		}
	}
}
?>