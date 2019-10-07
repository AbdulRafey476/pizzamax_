<?php
/**
Location: application/models/foods_model
*/
class food_model extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->load->helper('settings');
		$this->load->model('food_sizes_model');
		$this->load->model('food_extras_model');
	}

	function get($select = "*,foods.id as id,categories.name as cat_name,foods.name as name", $array_where = false, $array_like = false, $first = false, $offset = false, $order_by = false) {
		if( $order_by != false){
			$order = key($order_by);
			if ($order != null) {
				$sort = $order_by[$order];
				$this -> db -> order_by($order, $sort);
			}
		}else{
			$this->db->order_by('foods.id','DESC');
		}

		$this -> db -> select($select);
		$this -> db -> from('foods');
		if($array_where != false)
			$this -> db -> where($array_where);
		if($array_like != false)
			$this -> db -> like($array_like);
		if($offset != false){
			$this -> db -> limit($offset, $first);
		}

		$this->db->join('categories','foods.categories_id = categories.id');
		$this->db->join('users','foods.user_id=users.id');
		$query = $this -> db -> get();
		if ($query -> num_rows() > 0) {
			foreach ($query->result() as $rows) {
				$data[] = $rows;
			}
			foreach ($data as $r) {
				$r->image=base_url().'/'.$r->image;
				$r->name=preg_replace('/[\r\n]+/', "", $r->name);
				$tmp_data=$this->food_sizes_model->get("*",array('food_id'=>$r->id),array());
				if($tmp_data!=null){
					$r->size=$tmp_data;
				}

				$tmp_data=$this->food_extras_model->get("*",array('food_id'=>$r->id),array());
				if($tmp_data!=null){
					$r->extras=$tmp_data;
				}

				if(isset($r->created_at) && isset($r->updated_at)){
					$r->created_at=date('d-m-Y H:i:s',strtotime($r->created_at));
					$r->updated_at=date('d-m-Y H:i:s',strtotime($r->updated_at));
				}
				continue;
			}
			$query -> free_result();
			return $data;
		} else {
			return null;
		}
	}

	function total($array_where, $array_like) {
		$this -> db -> select('count(*) as total');
		$this -> db -> where($array_where);
		$this -> db -> like($array_like);
		$this -> db -> from('foods');
		$query = $this -> db -> get();
		$rows = $query -> result();
		$query -> free_result();
		return $rows[0] -> total;
	}

	function get_by_id($id) {
		$select = '*,foods.id as id,foods.name as name,foods.created_at as created_at,foods.updated_at as updated_at';
		$array_where = array('foods.id' => $id);
		$array_like = array();
		$order_by = array();
		return $this -> get($select, $array_where, $array_like, 0, 1, $order_by);
	}

	function get_by_cat_id($id) {
		$select = '*,foods.id as id,foods.name as name,foods.created_at as created_at,foods.updated_at as updated_at';
		$array_where = array('foods.categories_id' => $id);
		$array_like = array();
		$order_by = array();
		return $this -> get($select, $array_where, $array_like, 0, 10000, $order_by);
	}

	function get_by_exact_name($name){
		$select = '*';
		$array_like=array();
		$array_where = array('foods.name'=>$name);
		$order_by = array();
		return $this -> get($select, $array_where, $array_like, 0, 1, $order_by);
	}

	function get_by_name($name, $first, $offset) {
		$select = '*';
		$array_where = array();
		$array_like = array('foods.name'=>$name);
		$order_by = array();
		return $this -> get($select, $array_where, $array_like, $first, $offset, $order_by);
	}

	function get_by_name_and_diff_id($id,$name){
		$select = '*';
		$array_where = array('foods.name'=>$name,'foods.id <>'=>$id);
		$array_like = array();
		$order_by = array();
		return $this -> get($select, $array_where, $array_like, 0, 1, $order_by);
	}

	function get_by_id_and_name($id,$name, $first, $offset) {
		$select = '*';
		$array_where = array();
		$array_like = array('foods.name'=>$name,'foods.id'=>$id);
		$order_by = array();
		return $this -> get($select, $array_where, $array_like, $first, $offset, $order_by);
	}

	function insert($data_array) {
		$data_array['created_at']=date('Y-m-d H:i:s');
		$data_array['updated_at']=date('Y-m-d H:i:s');
		$this -> db -> insert('foods', $data_array);
		return $this -> db -> insert_id();
	}

	public function remove($arr_where) {
		$this -> db -> where($arr_where);
		$this -> db -> delete('foods');
		return $this->db->affected_rows();
	}

	public function remove_by_id($id) {
		$array_where = array('id' => $id);
		return $this -> remove($array_where);
	}

	function update($data_array, $array_where) {
		$this -> db -> where($array_where);
		$this -> db -> update('foods', $data_array);
	}

	function update_query($query){
		$this->db->query($query);
	}
}
?>
