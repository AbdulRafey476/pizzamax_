<?php 
class Home extends MY_Controller{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('settings_helper');
		$this->template->master = $this->template->config['frontend']['template'];
		/** DB MODELS */
		$this->load->model('deals_model');
        $this->load->model('deal_item_model');
        $this->load->model('deal_categories_model');
        $this->load->model('categories_model');
        $this->load->model('deal_lists_model');
		$this->load->model('food_model');
		$this->load->model('food_extras_model');
	}


	function index(){
		
		$sql = $this->db->query("SELECT * FROM deals WHERE featured=1");
		$data['featured_deals'] = $sql->result();

		$this->load->view('frontends/index', $data);
	}
	
    function sendMessage() {
    $content      = array(
        "en" => 'English Message'
    );
    $hashes_array = array();
    array_push($hashes_array, array(
        "id" => "like-button",
        "text" => "Like",
        "icon" => "http://i.imgur.com/N8SN8ZS.png",
        "url" => "https://yoursite.com"
    ));
    array_push($hashes_array, array(
        "id" => "like-button-2",
        "text" => "Like2",
        "icon" => "http://i.imgur.com/N8SN8ZS.png",
        "url" => "https://yoursite.com"
    ));
    $fields = array(
        'app_id' => "a6de92f5-f354-4058-bd89-f2bb236d9cf4",
        'included_segments' => array(
            'All'
        ),
        'data' => array(
            "foo" => "bar"
        ),
        'contents' => $content,
        'web_buttons' => $hashes_array
    );
    
    $fields = json_encode($fields);
    print("\nJSON sent:\n");
    print($fields);
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json; charset=utf-8',
        'Authorization: Basic NzA5MDE4MTctMzMzMC00ZGVjLWI1MzgtMTk4YTM2MWM2YzU1'
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    
    $response = curl_exec($ch);
    curl_close($ch);
    
    return $response;
}   function send_message(){
	echo "started";
	    $response = sendMessage();
$return["allresponses"] = $response;
$return = json_encode($return);

$data = json_decode($response, true);
echo $data;
$id = $data['id'];
echo $id;

print("\n\nJSON received:\n");
print($return);
print("\n");
	}
	public function deals()
	{
		$data = [];
		$data['cat']['deals'] = $this->deal_categories_model->get('*');
		$data['cat']['foods'] = $this->categories_model->get('*');
		$data['deals'] = $this->deals_model->get('*', ['is_active' =>1]);
		$data['foods'] = $this->food_model->get('*,foods.id as id,categories.name as cat_name,foods.name as name,foods.image as path');
		//$data['dLists'][] = $this->deal_lists_model->get('*', ['deal_id' =>$deal->id]);
		$data['dItems'][] = $this->db->select('di.*,dl.title,dl.list_min_limit as min, dl.list_max_limit as max,di.size as size_id,fd.description as description,fd.image as image,sz.name as size,fd.name as item_name')
					->from('deal_items as di')
					//->where('di.deal_id', '')
					->join('foods as fd', 'di.food_id = fd.id')
					->join('sizes as sz', 'di.size = sz.id')
					->join('deal_lists as dl', 'di.list_id	 = dl.id','right outer')
					->get()->result();
		$this->template->write_view('content', 'frontends/deals',$data);
		$this->template->render();

	}
		public function get_deals_cat()
	{
		$data = [];
		$data['cat']['deals'] = $this->deal_categories_model->get('*');
	    echo json_encode($data['cat']['deals']);

	
	

	}
	public function get_foods_cat()
	{
		$data = [];
		$data['cat']['foods'] = $this->categories_model->get('*');
	    echo json_encode($data['cat']['foods']);

	
	

	}
		public function get_foods()
	{
		$data = [];
// 		$data['cat']['deals'] = $this->deal_categories_model->get('*');
// 		$data['cat']['foods'] = $this->categories_model->get('*');
// 		$data['deals'] = $this->deals_model->get('*', ['is_active' =>1]);
		$data['foods'] = $this->food_model->get('foods.id as id,foods.name,foods.description,foods.price,foods.image,foods.featured,foods.categories_id,categories.name as cat_name,foods.name as name,foods.image as path');
// $data['foods'] = $this->food_model->get('*,categories.name as cat_name,foods.name as name,foods.image as path');
		//$data['dLists'][] = $this->deal_lists_model->get('*', ['deal_id' =>$deal->id]);
// 		$data['dItems'][] = $this->db->select('di.*,dl.title,dl.list_min_limit as min, dl.list_max_limit as max,di.size as size_id,fd.description as description,fd.image as image,sz.name as size,fd.name as item_name')
// 					->from('deal_items as di')
// 					//->where('di.deal_id', '')
// 					->join('foods as fd', 'di.food_id = fd.id')
// 					->join('sizes as sz', 'di.size = sz.id')
// 					->join('deal_lists as dl', 'di.list_id	 = dl.id','right outer')
// 					->get()->result();
		// $this->template->write_view('content', 'frontends/deals',$data);
		// $this->template->render();
		 echo json_encode($data['foods']);

	}
	public function get_deals()
	{
		$data = [];
// 		$data['cat']['deals'] = $this->deal_categories_model->get('*');
// 		$data['cat']['foods'] = $this->categories_model->get('*');
				$data['deals'] = $this->deals_model->get('*', ['is_active' =>1]);

// 		$data['deals'] = $this->deals_model->get('deals.id,deals.name,deals.price,deals.cat_id,deals.path,deals.featured', ['is_active' =>1]);
// 		$data['foods'] = $this->food_model->get('*,foods.id as id,categories.name as cat_name,foods.name as name,foods.image as path');
// 		$data['dLists'][] = $this->deal_lists_model->get('*', ['deal_id' =>$deal->id]);
// 		$data['dItems'][] = $this->db->select('di.*,dl.title,dl.list_min_limit as min, dl.list_max_limit as max,di.size as size_id,fd.description as description,fd.image as image,sz.name as size,fd.name as item_name')
// 					->from('deal_items as di')
// 					->where('di.deal_id', '')
// 					->join('foods as fd', 'di.food_id = fd.id')
// 					->join('sizes as sz', 'di.size = sz.id')
// 					->join('deal_lists as dl', 'di.list_id	 = dl.id','right outer')
// 					->get()->result();
		// $this->template->write_view('content', 'frontends/deals',$data);
		// $this->template->render();
		 echo json_encode($data['deals']);

	}
	public function get_deals_items()
	{
		$data = [];
		$data['cat']['deals'] = $this->deal_categories_model->get('*');
		$data['cat']['foods'] = $this->categories_model->get('*');
		$data['deals'] = $this->deals_model->get('*', ['is_active' =>1]);
		$data['foods'] = $this->food_model->get('*,foods.id as id,categories.name as cat_name,foods.name as name,foods.image as path');
		//$data['dLists'][] = $this->deal_lists_model->get('*', ['deal_id' =>$deal->id]);
		$data['dItems'][] = $this->db->select('di.id,di.food_id,di.list_id,di.deal_id,dl.title,dl.list_min_limit as min, dl.list_max_limit as max,di.size as size_id,fd.description as description,fd.image as image,sz.name as size,fd.name as item_name')
					->from('deal_items as di')
					//->where('di.deal_id', '')
					->join('foods as fd', 'di.food_id = fd.id')
					->join('sizes as sz', 'di.size = sz.id')
					->join('deal_lists as dl', 'di.list_id	 = dl.id','right outer')
					->get()->result();
		// $this->template->write_view('content', 'frontends/deals',$data);
		// $this->template->render();
		 echo json_encode($data['dItems']);

	}


	public function deal($param)
	{	
		$data['loadmap'] = true;
		$data = $dItems = [];
		$param = urldecode($param);
		// $deals = $this->deals_model->get_by_name($param,null,null);
		$deals = $this->db->select('*')->from('deals')->where('id', $param)->where('is_active',1)->get()->result();
		$data['deals'] = $deals;
		if(!is_null($deals) && count($deals) > 0) {
			foreach($deals as $deal) {
				$data['dLists'][] = $this->deal_lists_model->get('*', ['deal_id' =>$deal->id]);
				$data['dItems'][] = $this->db->select('di.*,dl.title,dl.list_min_limit as min, dl.list_max_limit as max,di.size as size_id,fd.description as description,fd.image as image,sz.name as size,fd.name as item_name')
					->from('deal_items as di')
					->where('di.deal_id', $deal->id)
					->join('foods as fd', 'di.food_id = fd.id')
					->join('sizes as sz', 'di.size = sz.id')
					->join('deal_lists as dl', 'di.list_id	 = dl.id','right outer')
					->get()->result();
			}

		}
		$data['cart'] = $this->dealCart();
		$this->template->write_view('content','frontends/deal',$data);
		$this->template->render();
	}

	function dealCart() {
		$cart = isset($_COOKIE['cartDeal']) ? $_COOKIE['cartDeal'] : [];
		if(count($cart) > 0) {
			return json_decode($cart);
		}
		return null;
	}
	
	function food(){
		$settings=getSettings(GENERAL_SETTING_FILE);
		$id=$this->input->get('id');
		$this->load->model('food_model');
		$obj=$this->food_model->get_by_id($id);
		$data['obj']=$obj[0];

		$data['settings']=$settings;
		$this->load->view('food',$data);
	}

	public function generateCode($id = 0)
	{
		// $ukey = strtoupper(substr(sha1(microtime() . $id), rand(0, 5), 25));
		// $collection = implode("-", str_split($ukey, 5));
		$code = strtoupper(uniqid('PM'));
		return $code;
	}

	public function checkout()
	{
	   $this->load->view('frontends/checkout');
	}
	function SearchInDict($array, $key, $val) {
		foreach ($array as $item)
			if (isset($item->{$key}) && $item->{$key} == $val)
				return true;
		return false;
	}
	public function loadCart()
	{
		$cart = [];
		$food = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart']) : [];
		$deal = isset($_COOKIE['cartDeal']) ? json_decode($_COOKIE['cartDeal']) : [];
		$fd = [];
		if(count($food) > 0) {
			foreach($food as $ke => $f) {
				$rep = $this->food_model->get('foods.*,foods.id as id,categories.name as cat_name,foods.name as name,foods.image as path',['foods.id'=>$f->itemId], false, true);
				if($rep) {
					$fd[$ke] = $rep[0];
					$sizes = $this->db->select('fs.*')
								->from('food_sizes as fs')
								->where('size_id', $f->size)
								->where('food_id', $rep[0]->id)->get()->result();
					$fd[$ke]->size = $sizes;
					$sp = array();
					foreach($fd[$ke]->extras as $i => $v){
						if($this->SearchInDict($f->extras,'name',$v->name)){
							array_push($sp,$v);
						}
					}
					$fd[$ke]->extras = $sp;
				}
			}
		}
		$deals = [];
		if(count($deal) > 0) {
			foreach($deal as $k => $d) {
				if(empty($d)) {
					continue;
				}
				$deals[$k]['deal'] = $this->deals_model->get('*', ['is_active' =>1,'id'=>$d->id]);
				foreach($d->items as $it) {
					$deals[$k]['dItems'] = $this->db->select('di.*,dl.title,dl.list_min_limit as min, dl.list_max_limit as max,di.size as size_id,fd.description as description,fd.image as image,sz.name as size,fd.name as item_name')
						->from('deal_items as di')
						->where('di.id', $it->id)
						->join('foods as fd', 'di.food_id = fd.id')
						->join('sizes as sz', 'di.size = sz.id')
						->join('deal_lists as dl', 'di.list_id	 = dl.id','right outer')
						->get()->result();
				}
			}
		}
		$cart['food'] = $fd;
		$cart['deals'] = $deal;
		header('Content-Type: application/json');
    	echo json_encode( $cart );
	}

	public function checkoutPost(){
		$data = ['msg'=>'loaded'];
		header("Content-Type: application/json");
		echo json_encode($data);
	}

	public function orderStatus() 
	{
		try {

			$code = $this->input->post('code');
			$order = $this->db->select('status')->where('code',$code)->from('orders')->get()->row();
			
			if(count($order)<0){
				throw new Exception('invalid order');
			}

			header("Content-Type: application/json");
			$status = [
				'0'=>'pending',
				'1'=>'accepted',
				'2'=>'dispatched',
				'3'=>'delivered'
			];
			echo json_encode(['status'=>$status[$order->status]]);

		} catch(Exception $ex) {
			header("Content-Type: application/json");
			echo json_encode($ex->getMessage());
		}
	}

	public function trackOrder() 
	{
		$code = $this->input->post('code');
		if($code){
			redirect('/order_tracking/'.$code, 'refresh');
			exit;
		}
		$data = [];
		$data = $this->input->get();
		$this->template->write_view('content', 'frontends/track_order_search', $data);
		$this->template->render();
	}

	public function track_order() 
	{
// 		$data = [];
// 		$order = $this->db->select('*')->where('code', $code)->from('orders')->get()->row();
// 		if($order) {

// 				if(count($order) > 0) {
// 					$data['deals'] = $this->db->select("do.*, d.name as name")->where('order_id', $order->id)
// 					->from('deal_orders as do')
// 					->join('deals as d','do.deal_id = d.id')
// 					->get()->result();
// 					$data['items'] = $this->db->select('fo.*,fo.name as name,sz.name as size,fsz.price')
// 							->where('order_id',$order->id)
// 							->from('food_orders as fo')
// 							->join('sizes as sz', 'fo.size = sz.id')
// 							->join('food_sizes as fsz', 'fo.id = fsz.food_id AND sz.id = fsz.size_id')
// 							->get()->result();
							
// 			}
// 			$data['order'] = $order;
// 			$data['status'] = [
// 				'0'=>'pending',
// 				'1'=>'accepted',
// 				'2'=>'dispatched',
// 				'3'=>'delivered'
// 			];
		$this->template->write_view('content', 'frontends/track-order', $data);
		$this->template->render();
// 		} else {
// 			redirect('/track-order?invalidOrder', 'refresh');
// 			exit;
// 		}

	}

	public function cart()
	{
		$this->load->view('frontends/cart');
	}

	public function menu()
	{
		$appetizer_sql = $this->db->query("SELECT foods.* FROM foods JOIN categories ON foods.categories_id=categories.id WHERE categories.name='Appetizers'");
		$pizza_sql = $this->db->query("SELECT foods.* FROM foods JOIN categories ON foods.categories_id=categories.id WHERE categories.name='Pizza'");
		$pastas_sql = $this->db->query("SELECT foods.* FROM foods JOIN categories ON foods.categories_id=categories.id WHERE categories.name='Pastas'");
		$sandwiches_sql = $this->db->query("SELECT foods.* FROM foods JOIN categories ON foods.categories_id=categories.id WHERE categories.name='Sandwiches'");
		$beverages_sql = $this->db->query("SELECT foods.* FROM foods JOIN categories ON foods.categories_id=categories.id WHERE categories.name='Beverages'");

		$data['appetizer'] = $appetizer_sql->result();
		$data['pizza'] = $pizza_sql->result();
		$data['pastas'] = $pastas_sql->result();
		$data['sandwiches'] = $sandwiches_sql->result();
		$data['beverages'] = $beverages_sql->result();

		$this->load->view('frontends/menu', $data);
	}

	public function midnight_deals()
	{
		$sql = $this->db->query("SELECT deals.* FROM deals JOIN deal_categories ON deals.cat_id=deal_categories.id WHERE deal_categories.name='Midnight Deals'");
		$data['midnight_deals'] = $sql->result();

		$this->load->view('frontends/midnight-deals', $data);
	}

	public function real_big_deals()
	{
		$sql = $this->db->query("SELECT deals.* FROM deals JOIN deal_categories ON deals.cat_id=deal_categories.id WHERE deal_categories.name='Real Big Deals'");
		$data['real_big_deals'] = $sql->result();

		$this->load->view('frontends/real-big-deals', $data);
	}

	public function tempting_deals()
	{
		$sql = $this->db->query("SELECT deals.* FROM deals JOIN deal_categories ON deals.cat_id=deal_categories.id WHERE deal_categories.name='Tempting Deals'");
		$data['tempting_deals'] = $sql->result();

		$this->load->view('frontends/tempting-deals', $data);
	}

	public function order_confirmation()
	{
		$this->load->view('frontends/order-confirmation');
	}

	public function outlets()
	{
		$this->load->view('frontends/outlets');
	}

	public function profile()
	{
		$this->load->view('frontends/profile');
	}
}
