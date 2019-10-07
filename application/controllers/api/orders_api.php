<?php
require APPPATH.'/libraries/REST_Controller.php';
class orders_api extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('orders_model');
		$this->load->model('food_orders_model');
		$this->load->helper('settings_helper');
	}

	function orders_get() { 
		$data=$this->orders_model->get('*');
		if($data!=null){
			$this->response($data); 
		}else{
			$this->response(array('empty'=>'empty_data'));
		}
	} 

	function transactions_get() { 
		$first=$this->input->get('first');
		$offset=$this->input->get('offset');
		$where=array();
		$like=array();
		$order=array('orders.updated_at'=>'DESC');
		$sort_by=$this->input->get('sort_by');

		if($sort_by!=null){
			$order=array('orders.created_at'=>$sort_by);
		}

		$user_id=$this->input->get('user_id');
		if($user_id!=null){
			$where['orders.user_id']=$user_id;
		}

		$select='*';

		$data=$this->orders_model->get($select,$where,$like,$first,$offset,$order);
		
		if($data!=null){
			$price=0;
			$settings= getSettings(GENERAL_SETTING_FILE);
			$shipfee=$settings['ship_fee'];
			foreach ($data as $key) {
				$food_order = $this->food_orders_model->get('*',array('order_id'=>$key->id),array());
				$key->lst_food_order = $food_order;
				foreach ($food_order as $r) {
					$price+=$r->price;
				}
				$tax=$price*($settings['tax']/100);
			    $total=$price+$tax+$shipfee;
			    $key->total=$total;
			}
			$this->response($data);
		}else{
			$this->response(array("empty"=>1));
		}
	} 

	function add_order_post() 
	{ 
		$items = json_decode($this->post('items'));

		if($items != null){
			$data['full_name']=$this->post('full_name');
			$data['phone']=$this->post('phone');
			$data['address']=$this->post('address');
			$data['message']=$this->post('message');
			$data['user_id']=$this->post('user_id');
			$email=$this->post('email');

			$insert_id = $this->orders_model->insert($data);
			$body='';
			if($insert_id!=0){
				foreach ($items as $key) {

					$data_item = array();
					$data_item['order_id']=$insert_id;
					$data_item['food_id']=$key->id;
					$data_item['name']=$key->name;

					$body.=$key->name.',';
					$data_item['price']=$key->total_price*$key->quantity;
					$data_item['quantity']=$key->quantity;
					$data_item['image']=$key->image;

					$data_item['size']=$key->size_name.' - '.$key->size_price;
					if(isset($key->lst_extras_name)){
						$data_item['extras_name']=$key->lst_extras_name;
					}if(isset($key->lst_extras_price)){
						$data_item['extras_price']=$key->lst_extras_price;
					}if(isset($key->lst_extras_id)){
						$data_item['extras_id']=$key->lst_extras_id;
					}

					$this->load->model('food_orders_model');
					$this->food_orders_model->insert($data_item);
				}

			//send email order 
			$CI =& get_instance();
			$CI->load->helper('settings');
			$settings= getSettings(GENERAL_SETTING_FILE);
			$configs = getSettings(EMAIL_SETTING_FILE);

			$CI->load->library('email',$configs);
			$CI->email->initialize($configs);

			$total=$this->input->post('total');
			
			$body.='<br>tax:'.$settings['tax'].' %'; 
			$body.='<br>Ship Fee: '.format_money($settings['ship_fee']);
			$body.='<br>Total: '.format_money($total);
			$body.='<br>'.$this->lang->line('thank_for_order');

			$subject = $this->lang->line('order_confirm');
			$body ='<p>'.$body.'</p>';
			$result = $CI->email
			->from($configs['from_email'],$configs['from_user'])
			->to($email)
			->subject($subject)
			->message($body)
			->send();
			}
		}
		$this->response($items);
	} 

	function orders_put() 
	{ 
		$data = array('this not available'); 
		$this->response($data); 
	} 

	function orders_delete() 
	{ 
		$data = array('this not available');
		$this->response($data); 
	}  
}
?>