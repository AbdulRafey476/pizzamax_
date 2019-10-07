<?php
class promotions_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function insert($data_array)
	{
		$this->db->insert('promotions', $data_array);
		return $this->db->insert_id();
	}

	public function update($data_array, $array_where)
	{
		$this->db->where($array_where);
		$this->db->update('promotions', $data_array);
	}
}
