<?php
require APPPATH.'/libraries/REST_Controller.php';
class food_sizes_api extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('food_sizes_model');
	}

	function size_get() { 
		$food_id=$this->input->get('food_id');
		$data=$this->food_sizes_model->get_by_food_id($food_id);
		if($data!=null){
			$this->response($data);
		}else{
			$this->response(array('empty'=>'empty_data'));
		}
	}
	
}
?>