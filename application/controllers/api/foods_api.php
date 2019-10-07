<?php
require APPPATH.'/libraries/REST_Controller.php';
class foods_api extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('food_model');
		$this->load->helper('Ultils');
	}

	function foods_get()
	{
		$first=$this->input->get('first');
		$offset=$this->input->get('offset');
		$where=array();
		$like=array();
		$order=array('foods.updated_at'=>'DESC');
		$categories_id=$this->input->get('categories_id');
		$sort_by=$this->input->get('sort_by');
		$where['users.activated']=1;
		$where['foods.activated']=1;

		if($categories_id!=null){
			$where['categories_id']=$categories_id;
		}

       $is_offered=$this->input->get('is_offered');
       if($is_offered!=null){
       	    $where['is_offered']=1;
       }
		$product_id=$this->input->get('product_id');
		if($product_id!=null){
			$where['foods.id']=$product_id;
		}

		if($sort_by!=null){
			$order=array('foods.updated_at'=>$sort_by);
		}

		$id=$this->input->get('pull');
		if($id!=null){
			$product=$this->food_model->get_by_id($id);
			$where['foods.id <>']=$id;
			$where['foods.created_at >=']= date('Y-m-d H:i:s',strtotime($product[0]->created_at));
		}

		$title=$this->input->get('title');
		if($title!=null){
			$like['foods.name']=$title;
		}

		$aim=$this->input->get('aim');
		if($aim!=null){
			$where['aim']=$aim;
		}
		$select='
		*,
		foods.image as image,
		foods.name as name,
		categories.id as category,
		foods.id as id,
		foods.user_id as user_id';

		$user_id=$this->input->get('user_id');
		if($user_id!=null){
			$where['foods.user_id']=$user_id;
		}

		$data=$this->food_model->get($select,$where,$like,$first,$offset,$order);
		if($data!=null){
			$this->response($data);
		}else{
			$this->response(array("empty"=>1));
		}
	}

	function foods_put()
	{
		$data = array('this not available');
		$this->response($data);
	}

	function foods_delete()
	{
		$data = array('this not available');
		$this->response($data);
	}

	function update_post(){
		$user_id=$this->post('user_id');
		if($user_id!=null){
			$query= 'update foods SET updated_at="'.date('Y-m-d H:i:s',time()).'" where DATE(updated_at) < "'.date('Y-m-d',time()).'" AND user_id='.$user_id;
			$this->food_model->update_query($query);
		}
	}

	function delete_post(){
		if(isset($_POST['id'])){
			$id=$this->input->post('id');
			$product=$this->food_model->get_by_id($id);
			if($product!=null){
				$this->load->model('images_model');
				$images=$this->images_model->get_by_product_id($id);
				foreach ($images as $r) {
					try {
						unlink($r->path);
						$this->images_model->remove_by_id($r->id);
					} catch (Exception $e) {

					}
				}
				try {
					unlink($product[0]->image_path);
				} catch (Exception $e) {

				}
			}
			$this->food_model->remove_by_id($id);
		}
	}
}
?>
