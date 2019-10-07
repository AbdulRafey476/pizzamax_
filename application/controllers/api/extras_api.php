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
		$q=$this->input->get('q');
		$data=$this->extras_model->get('*',array(),array('name'=>$q));
		if($data!=null){
			$this->response($data); 
		}else{
			$this->response(array('empty'=>'empty_data'));
		}
	} 

	function extra_by_id_get() 
	{ 
		$id = $this->input->get('id');
		$data=$this->extras_model->get_by_id($id);
		if($data!=null){
			$this->response($data);
		}else{
			$this->response(array('empty'=>'empty_data'));
		}
	} 

	function extra_by_name_get() 
	{ 
		$name = $this->input->get('name');
		$data=$this->extras_model->get_by_name($name, 0, 1);
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