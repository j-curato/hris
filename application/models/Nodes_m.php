<?php

class Nodes_m extends CI_Model {
    private $table = "node";
 
  function get_node_list() {
    $this->db->select('title,type');
    $this->db->order_by('created','DESC');
    $this->db->limit(30,0);
    $query = $this->db->get($this->table);
 
    return $query->result();
  }
 
  function get_node_by_type($type) {
    $this->db->select('title,type');
    $this->db->where('type',$type,'=');
    $this->db->order_by('created','DESC');
    $query = $this->db->get($this->table);
 
    return $query->result();
  }
}