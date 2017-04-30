<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Global_m extends CI_Model{

  public function __construct()
  {
    parent::__construct();
  }

  public function sidebar_lv1(){
    $table = 'sidebar';
    $query = $this->db->query("SELECT * FROM sidebar where sidebar_level = 1;");
    return $query;
  }

  public function sidebar_lv2($sidebar_lv1, $user_type){
    $table = 'sidebar';
    $query = $this->db->query("SELECT a.*, b.* FROM sidebar a
                               JOIN permits b on b.sidebar = a.sidebar_id
                               where sidebar_level = 2 and sidebar_parent = '$sidebar_lv1'
                               and b.permit_access != '' and b.user_type = '$user_type' group by a.sidebar_id");
    return $query;
  }

  public function create_config($table, $data)
  {
    $this->db->insert($table, $data);
    return $this->db->insert_id();
  }

  function select_config($table, $where){
    $query = $this->db->query("SELECT * FROM $table $where");
    return $query;
  }


  function select_config_array($table, $where){
    $this->db->select('*');
    $this->db->where($where);
    $query = $this->db->get($table);
    return $query;
  }

  function select_config_one($table, $val, $where){
    $this->db->select($val);
    $this->db->where($where);
    $query = $this->db->get($table)->row();
    return $query;
  }

  function update_config($table, $data, $where){
    $this->db->where($where);
		$this->db->update($table,$data);
  }

  function delete_config($table, $where){
    $this->db->where($where);
    $this->db->delete($table);
  }
}
