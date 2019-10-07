<?php
require APPPATH.'/libraries/REST_Controller.php';
class categories_api extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('food_model');
		$this->load->model('categories_model');
	}

	function categories_get()
	{
		$first=$this->get('first');
		$offset=$this->get('offset');
		$data=$this->categories_model->get('id,name,path',array(),array(),$first,$offset,array('id'=>'DESC'));
		if($data!=null){
			foreach ($data as $key => $value) {
				$data[$key]->total = count($this->food_model->get_by_cat_id($value->id));
			}
			$this->response($data);
		}else{
			$this->response(array('empty'=>'empty_data'));
		}
	}

	function categories_post()
	{
		$data = array('this not available');
		$this->response($data);
	}

	function categories_put()
	{
		$data = array('this not available');
		$this->response($data);
	}

	function categories_delete()
	{
		$data = array('this not available');
		$this->response($data);
	}
}
?>
