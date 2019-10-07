<?php
require APPPATH.'/libraries/REST_Controller.php';
class extras_api extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('extras_model');
	}

	function extras_get() 
	{ 
		$data=$this->extras_model->get('id,name');
		if($data!=null){
			$this->response($data); 
		}else{
			$this->response(array('empty'=>'empty_data'));
		}
	} 

	function extras_by_county_id_get(){
		$county_id=$this->get('id');
		$data=$this->extras_model->get_by_county_id($county_id);
		if($data!=null){
			$this->response($data); 
		}else{
			$this->response(array('empty'=>'empty_data'));
		}	
	}

	function extras_post() 
	{ 
		$data = array('this not available');
		$this->response($data); 
	} 

	function extras_put() 
	{ 
		$data = array('this not available'); 
		$this->response($data); 
	} 

	function extras_delete() 
	{ 
		$data = array('this not available');
		$this->response($data); 
	}  
}
?>