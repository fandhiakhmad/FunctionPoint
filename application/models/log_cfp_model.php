<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Log_cfp_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->CI = get_instance();
	}

	function insert_log_weight($data) {
		$this->db->insert('log_indikator_cfp', $data);
	}

	//delete cfp value for update
	function delete($id_aplikasi) {
		$this->db->where('ID_APLIKASI', $id_aplikasi);
		$this->db->delete('log_indikator_cfp');
		return $this->db->affected_rows() ? true : false;
	}

	function update_log($data) {
		$this->db->where('ID_APLIKASI',$id);
		$this->db->update('log_indikator_cfp', $data);
		return $this->db->affected_rows() ? true : false;
	}

	function count() {
		$query = $this->db->count_all_results('pembobotan_cfp');
		return $query;
	}

	function sumLog($id_aplikasi) {
		$query = $this->db->query("SELECT sum(lpt.VALUE*pt.BOBOT) as VALUE from log_indikator_cfp lpt INNER JOIN pembobotan_cfp as pt ON lpt.ID_P_CFP=pt.ID_P_CFP
			WHERE ID_APLIKASI=".$id_aplikasi."");
		return $query;
	}
	
	function get_data_log($id_aplikasi)
	{
		$query = $this->db->query ("SELECT * from log_indikator_cfp as ltw INNER JOIN pembobotan_cfp as cfp ON ltw.ID_P_CFP= cfp.ID_P_CFP
			WHERE ID_APLIKASI=".$id_aplikasi." ");
		return $query;
	}
}
?>