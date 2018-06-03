<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Log_rcaf_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->CI = get_instance();
	}
	
	function insert_log_weight($data)
	{
		$this->db->insert('log_indikator_rcaf',$data);
	}

	//delete rcaf value for update
	function delete($id_aplikasi)
	{
		$this->db->where('ID_APLIKASI', $id_aplikasi);
		$this->db->delete('log_indikator_rcaf');
		return $this->db->affected_rows() ? true : false;
	}
	
	function update_log($data)
	{
		$this->db->where('ID_APLIKASI',$id);
		$this->db->update('log_indikator_rcaf',$data);
		return $this->db->affected_rows() ? true : false;
	}
	
	function count()
	{
	$query = $this->db->query("SELECT count(*) as JUMLAH  from pembobotan_rcaf ");
	return $query;
	}
	
	function sumLog($id_aplikasi)
	{
	$query = $this->db->query("SELECT sum(lpt.VALUE*pt.BOBOT) as VALUE  from log_indikator_rcaf lpt
		INNER JOIN pembobotan_rcaf as pt ON lpt.ID_P_RCAF=pt.ID_P_RCAF
		WHERE ID_APLIKASI=".$id_aplikasi."");
		return $query;
	}
	
	function get_data_log($id_aplikasi)
	{
		$query = $this->db->query("SELECT *  from log_indikator_rcaf as ltw
		INNER JOIN pembobotan_rcaf as tf ON ltw.ID_P_RCAF= tf.ID_P_RCAF
		WHERE ID_APLIKASI=".$id_aplikasi." ");
		return $query;
	}
}
?>