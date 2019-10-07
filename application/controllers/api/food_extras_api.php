<?php
require APPPATH.'/libraries/REST_Controller.php';
class food_extras_api extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('food_extras_model');
	}

	function extra_get() 
	{ 
		$food_id=$this->input->get('food_id');
		$data=$this->food_extras_model->get_by_food_id($food_id);
		if($data!=null){
			$this->response($data); 
		}else{
			$this->response(array('empty'=>'empty_data'));
		}
	} 

}
?>