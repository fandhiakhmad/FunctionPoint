<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class rcaf_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->CI = get_instance();
	}
	
	function insert($data)
	{
		$this->db->insert('pembobotan_rcaf',$data);
		return $this->db->affected_rows() ? true : false;
	}
	
	//list flexy
	function get_data(){
		//Select table name
		$this->db->select("*");
		$this->db->from('pembobotan_rcaf');
		$query = $this->db->get();
		return $query;	
	}
	
	function delete($id){
		$this->db->where('ID_RCAF', $id);
		$this->db->delete('pembobotan_rcaf');
		return $this->db->affected_rows() ? true : false;
	}
	
	function selectone($id)
	{
		$this->db->select("*");
		$this->db->from('pembobotan_rcaf');
		$this->db->where('ID_RCAF',$id);
		$query = $this->db->get();
		return $query;
	}
	
	function update($data,$id )
	{
		$this->db->where('ID_RCAF',$id);
		$this->db->update('pembobotan_rcaf',$data);
		return $this->db->affected_rows() ? true : false;
	}
        
	function get_weight()
	{
		$this->db->select("*");
		$this->db->from('pembobotan_rcaf');
		$query = $this->db->get();
		return $query;
	}
}
?>