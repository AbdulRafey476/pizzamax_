<?php
/**
Location:application/food_sizes_model.php
*/

class food_sizes_model extends CI_Model {
  function __construct() {
    parent::__construct();
  }

  function get($select = "price,name", $array_where = false, $array_like = false, $first = false, $offset = false, $order_by = false) {
    $data = array();
    if( $order_by != false){
      $order = key($order_by);
      if ($order != null) {
        $sort = $order_by[$order];
        $this -> db -> order_by($order, $sort);
      }
    }

    $this -> db -> select($select);
    $this -> db -> from('food_sizes');
    if($array_where != false)
    $this -> db -> where($array_where);
    if($array_like != false)
    $this -> db -> like($array_like);
    if($offset != false){
      $this -> db -> limit($offset, $first);
    }
    $this->db->join('sizes','food_sizes.size_id = sizes.id','sizes.default = default');
    $query = $this -> db -> get();
    if ($query -> num_rows() > 0) {
      foreach ($query->result() as $rows) {
        $data[] = $rows;
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
    $this -> db -> from('food_sizes');
    $query = $this -> db -> get();
    $rows = $query -> result();
    $query -> free_result();
    return $rows[0] -> total;
  }

  function get_by_id($id) {
    $select = '*';
    $array_where = array('id' => $id);
    $array_like = array();
    $order_by = array();
    return $this -> get($select, $array_where, $array_like, 0, 1, $order_by);
  }

  function get_by_exact_name($name){
    $select = '*';
    $array_like=array();
    $array_where = array('name'=>$name);
    $order_by = array();
    return $this -> get($select, $array_where, $array_like, 0, 1, $order_by);
  }

  function get_by_name($name, $first, $offset) {
    $select = '*';
    $array_where = array();
    $array_like = array('name'=>$name);
    $order_by = array();
    return $this -> get($select, $array_where, $array_like, $first, $offset, $order_by);
  }

  function get_by_food_id($food_id){
    $select = 'price,name,food_id,size_id';
    $array_where = array('food_id'=>$food_id);
    $order_by = array('size_id'=>'ASC');
    return $this -> get($select, $array_where, array(), 0, 100, $order_by);
  }

  function get_by_size_id($estates_id){
    $select = '*';
    $array_where = array('size_id'=>$estates_id);
    $order_by = array();
    return $this -> get($select, $array_where, array(), 0, 100, $order_by);
  }

  function insert($data_array) {
    $data_array['created_at']=date('Y-m-d H:i:s');
    $data_array['updated_at']=date('Y-m-d H:i:s');
    $this -> db -> insert('food_sizes', $data_array);
    return $this -> db -> insert_id();
  }

  public function remove($arr_where) {
    $this -> db -> where($arr_where);
    $this -> db -> delete('food_sizes');
    return $this->db->affected_rows();
  }

  public function remove_by_id($id) {
    $array_where = array('id' => $id);
    return $this -> remove($array_where);
  }


  public function remove_by_sizeid_foodid($size_id,$food_id) {
    $array_where = array('size_id' => $size_id,'food_id'=>$food_id);
    return $this -> remove($array_where);
  }
  

  function update($data_array, $array_where) {
    $this -> db -> where($array_where);
    $this -> db -> update('food_sizes', $data_array);
  }
}
?>
