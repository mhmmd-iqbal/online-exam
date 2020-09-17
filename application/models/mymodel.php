<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mymodel extends CI_Model{
	// Input Data
	public function inputData($table,$data){
		$this->db->insert($table,$data);
	}
	public function getData($table)
	{
		return $this->db->get($table);
	}
	// getwhere
	public function getWhere($table,$where){
		return $this->db->get_where($table,$where);
	}
	public function updateData($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}
	// hapus data
	public function hapusData($where,$table){
		$this->db->where($where);
		$this->db->delete($table);
	}

	public function getDataorder($table, $bycolumn, $order)
	{
		$this->db->order_by($bycolumn, $order);
		$query = $this->db->get($table);
		return $query;
	}
	
	public function joinOrder($from, &$table, &$join, $bycolumn, $order){
		$i = 0;
		foreach ($table as $data ) {
			$tabel = $table[$i];
			$relasi = $join[$i];			
			$this->db->join($tabel, $relasi);
		$i++;
		}
		$this->db->order_by($bycolumn, $order);
		return $this->db->get($from);
	}

	public function join($from, &$table, &$join){
		$i = 0;
		foreach ($table as $data ) {
			$tabel = $table[$i];
			$relasi = $join[$i];			
			$this->db->join($tabel, $relasi);
		$i++;
		}
		return $this->db->get($from);
	}
	public function joinwhere($from, $where, &$table, &$join){
		$i = 0;
		foreach ($table as $data ) {
			$tabel = $table[$i];
			$relasi = $join[$i];			
			$this->db->join($tabel, $relasi);
		$i++;
		}
		return $this->db->get_where($from,$where);
	}

	public function joinwhereorder($from, $where, &$table, &$join, $bycolumn, $order){
		$i = 0;
		foreach ($table as $data ) {
			$tabel = $table[$i];
			$relasi = $join[$i];			
			$this->db->join($tabel, $relasi);
		$i++;
		}
		$this->db->where($where);
		$this->db->order_by($bycolumn, $order);
		return $this->db->get($from);
	}

	public function pengacakan(&$baris, $n){
		for ($i = $n; $i >= 0; $i--) { 
			$j 			= rand(0, $i);
			$tmp		= $baris[$i];
			$baris[$i]	= $baris[$j];
			$baris[$j]	= $tmp;
		}
		return $baris;
	}
}
?>