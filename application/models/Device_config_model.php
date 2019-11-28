<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Device_config_model extends CI_Model{

	public $table_name = "device_config";

	public function __construct()	{
		parent::__construct();
	  	$this->load->database(); 
	}


	public function last_id(){
		$this->db->select_max('id');
     	$result= $this->db->get($this->table_name)->row_array();
     return $result['id'];
	}

	public function insert($data){
		$this->db->insert($this->table_name, $data);
	}

}