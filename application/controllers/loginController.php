<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class loginController extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('mymodel');
	}

	function index(){
		$this->load->view('login');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(site_url());
	}

	public function aksiLogin()
	{
		$username	= $this->input->post('username');
		$pass		= $this->input->post('password');

		$cekSiswa	= $this->mymodel->getWhere('tb_siswa',	array('nis' => $username, 'pass_siswa' => md5($pass)))->num_rows();
		$cekGuru	= $this->mymodel->getWhere('tb_guru',	array('nip' => $username, 'pass_guru' => md5($pass)))->num_rows();
		$cekOperator= $this->mymodel->getWhere('tb_operator',	array('id_operator' => $username, 'pass_operator' => md5($pass)))->num_rows();

		if ($cekOperator > 0) {
			$operator	= $this->mymodel->getWhere('tb_operator',	array('id_operator' => $username, 'pass_operator' => md5($pass)))->row_array();
			$user 	= array(
					'level'		=> 'operator',
					'username'	=> $username,
					'nama'		=> $operator['nama_operator'],
					'photo'		=> 'photo_operator/'.$operator['photo_operator'],
					);
			$this->session->set_userdata($user);
			redirect(site_url());
		}
		elseif ($cekGuru > 0) {
			$guru	= $this->mymodel->getWhere('tb_guru',	array('nip' => $username, 'pass_guru' => md5($pass)))->row_array();
			$user 	= array(
					'level'		=> 'guru',
					'username'	=> $username,
					'nama'		=> $guru['nama_guru'],
					'photo'		=> 'photo_guru/'.$guru['photo_guru'],
					);
			$this->session->set_userdata($user);
			redirect(site_url());
		}
		elseif ($cekSiswa > 0) {
			$siswa	= $this->mymodel->getWhere('tb_siswa',	array('nis' => $username, 'pass_siswa' => md5($pass)))->row_array();
			$user 	= array(
					'level'		=> 'siswa',
					'username'	=> $username,
					'nama'		=> $siswa['nama_siswa'],
					'photo'		=> 'photo_siswa/'.$siswa['photo_siswa'],
					);
			$this->session->set_userdata($user);
			redirect(site_url('Welcome'));
		}
		else{
			$this->session->set_flashdata('error', 'Password dan username tidak sesuai');
			redirect(site_url('loginController'));
		}
	}
}
