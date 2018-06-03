<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cfp_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->CI = get_instance();
	}

	function insert($data) {
		$this->db->insert('pembobotan_cfp', $data);
		return $this->db->affected_rows() ? true : false;	
	}

	function get_data() {
		$this->db->select("*");
		$this->db->from('pembobotan_cfp');
		$query = $this->db->get();
		return $query;
	}

	function delete($id) {
		$this->db->where('ID_CFP', $id);
		$this->db->delete('pembobotan_cfp');
		return $this->db->affected_rows() ? true : false;
	}

	function selectone($id) {
		$this->db->select("*");
		$this->db->from('pembobotan_cfp');
		$this->db->where('ID_CFP', $id);
		$query = $this->db->get();
		return $query;
	}

	function update($data,$id) {
		$this->db->where('ID_CFP', $id);
		$this->db->update('pembobotan_cfp', $data);
		return $this->db->affected_rows() ? true : false;
	}

	function get_weight() {
		$this->db->select("*");
		$this->db->from('pembobotan_cfp');
		$query = $this->db->get();
		return $query;
	}
	
}
?>