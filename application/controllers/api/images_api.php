<?php
require APPPATH.'/libraries/REST_Controller.php';
class images_api extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('images_model');
	}

	function images_get() 
	{ 
		$where=array();
		$like=array();
		$order=array('created_at'=>'DESC');
		$data=$this->images_model->get();
		$product_id=$this->get('product_id');
		if($product_id!=null){
			$where['product_id']=$product_id;
		}
		$data=$this->images_model->get("*", $where, $like, false, false, $order);
		if($data!=null){
			$this->response($data); 
		}else{
			$this->response(array('empty'=>'empty_data'));
		}
	} 

	function images_post() 
	{ 
		$data = array('this not available');
		$this->response($data); 
	} 

	function images_put() 
	{ 
		$data = array('this not available'); 
		$this->response($data); 
	} 

	function images_delete() 
	{ 
		$data = array('this not available');
		$this->response($data); 
	}  
}
?>