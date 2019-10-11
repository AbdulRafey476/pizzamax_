<?php
class deals extends MY_Controller{
	function __construct()
	{
		parent::__construct();
		if(!isset($_SESSION['user'])){
			redirect('admin/dashboard');
		}else{
			$user=$_SESSION['user'][0];
			if($user->perm==USER){
				redirect('admin/denied');
			}
		}
        $this->load->model('deals_model');
        $this->load->model('deal_item_model');
        $this->load->model('deal_categories_model');
        $this->load->model('deal_lists_model');
		$this->load->model('food_model');
		$this->form_validation->set_error_delimiters('<span class="help-inline msg-error" generated="true">', '</span>');
	}

	function index(){
		$base_url=base_url().'admin/deals';
		$page=$this->uri->segment(3);
		if(!is_numeric($page) || $page<=0){
			$page=1;
		}
		$first=($page-1)*$this->pg_per_page;
		$total_rows=$this->deals_model->total(array(),array());
		$data['list'] = $this->deals_model->get("*", array(),array(),$first, $this->pg_per_page, array('id' => 'DESC'));
		$data['page_link'] =parent::pagination_config($base_url,$total_rows,$this->pg_per_page);
		$this->render_backend_tp('backends/deals/index', $data);
	}

	public function create(){
		if(isset($_POST['name'])){
			
			$data['name'] = $this->input->post('name');
			$data['description'] = $this->input->post('description');
			$data['price'] = $this->input->post('price');
			$data['cat_id'] = $this->input->post('cat');
			$data['is_active'] = $this->input->post('isActive') == 'on' ? 1 : 0;
		
			$this->form_validation->set_rules('name','name', 'trim|required|min_length[2]|max_length[60]|xss_clean|callback_check_name_exist_add');
			$this->form_validation->set_rules('description','description', 'trim|required|min_length[2]|max_length[200]|xss_clean');
			$this->form_validation->set_rules('price','price', 'trim|required|numeric|xss_clean');
			$this->form_validation->set_rules('cat','cat', 'trim|required|numeric|xss_clean');
			
			if($this->form_validation->run()!=false){
                
				$insert_id=$this->deals_model->insert($data);
				
				if($insert_id!=0){
				    
					foreach($this->input->post('list') as $list) {
						$list_data = array();
						$list_data['deal_id'] 	= $insert_id;
						$list_data['title']		= $list['title'];
						$list_data['list_min_limit']	= $list['min'];
						$list_data['list_max_limit']	= $list['max'];
						$listId = $this->deal_lists_model->insert($list_data);
					}
					foreach($this->input->post('item') as $item) {
						$list = $this->deal_lists_model->get('*', array('title' => $item['list'], 'deal_id' => $insert_id));
						$item_data = array();
						$item_data['deal_id'] = $insert_id;
						$item_data['food_id'] = $item['food_id'];
						$item_data['size']	=	$item['size'];
						$item_data['list_id']	=	$list[0]->id;
						
						$this->deal_item_model->insert($item_data);
					}
					if(isset($_FILES['image'])){
						//$this->load->helper('Ultils');
						$dir=create_sub_dir_upload('uploads/deals/');
						$filename=$_FILES['image']['name'];
						$_FILES['image']['name']=rename_upload_file($filename);
						$config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|JPEG|GIF|PNG';
						$config['max_size']	= '5000';
						$config['upload_path']=$dir;
						$this->load->library('upload',$config);
						if ($this->upload->do_upload('image'))
						{
							//$this->load->model('image_model');
							$data['path']=$dir.'/'.$_FILES['image']['name'];
							//$this->image_model->insert($data);
							$this->deals_model->update($data,array('id'=>$insert_id));

							$this->session->set_flashdata('msg_ok', $this->lang->line('add_successfully'));
							redirect(base_url().'admin/deals/create');
						}else{
							$this->session->set_flashdata('msg_error', $this->upload->display_errors());
							redirect(base_url().'admin/deals/create');
						}
					}

					$this->session->set_flashdata('msg_ok', $this->lang->line('add_successfully'));
							redirect(base_url().'admin/deals/create');
				}
			}
        }
		$data['categories'] = $this->deal_categories_model->get();
        $data['foods'] = $this->food_model->get();
		$this->template->write_view('content','backends/deals/add',$data);
		$this->template->render();
	}

	public function check_name_exist_add($name){
		$data=$this->deals_model->get_by_exact_name($name, 0, 1);
		if ($data!=null)
		{
			$this->form_validation->set_message('check_name_exist_add', 'This name has exist');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	public function check_name_exist_edit(){
		$id=$this->input->post('id');
		$name=$this->input->post('name');
		$data=$this->deals_model->get_by_name_and_diff_id($id,$name);
		if($data!=null) {
			$this->form_validation->set_message('check_name_exist_edit', 'This name has exist');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function edit_get(){
		if(isset($_GET['id'])){
			$id=$this->input->get('id');
			$data['obj'] = $this->deals_model->get_by_id($id)[0];
			$this->load->model('deals_model');
			
			$data['obj_items'] = $this->db->select('di.*,dl.title,dl.list_min_limit as min, dl.list_max_limit as max,di.size as size_id,fd.description as description,fd.image as image,sz.name as size,fd.name as item_name')
							->from('deal_items as di')
							->where('di.deal_id', $_GET['id'])
							->join('foods as fd', 'di.food_id = fd.id')
							->join('sizes as sz', 'di.size = sz.id')
							->join('deal_lists as dl', 'di.list_id	 = dl.id','right outer')
							->get()->result();
			$data['obj_list'] = $this->deal_lists_model->get('*', ['deal_id' => $id]);
			$data['categories'] = $this->deal_categories_model->get();
        	$data['foods'] = $this->food_model->get();
			$this->template->write_view('content','backends/deals/edit',$data);
			$this->template->render();
		}
	}
    public function edit_deal_title(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            $data['title'] = $_POST['title'];
            $id = $_POST['id'];
            // $this->deal_lists_model->update($data,['id'=>$id]);
            echo "cool";
            // return response()->json([
            //         'success' =>  true ,
            //         'message' => "title updated",
            //     ]);
        }
    }
	public function edit_post(){
		if(isset($_POST['dealId']) && !empty($_POST['dealId'])){
			$data['name'] = $this->input->post('name');
			$data['description'] = $this->input->post('description');
			$data['price'] = $this->input->post('price');
			$data['cat_id'] = $this->input->post('cat');
			$data['is_active'] = $this->input->post('isActive') == 'on' ? 1 : 0;
			$data['featured'] = $this->input->post('featured') == 'on' ? 1 : 0;

			if($this->input->post('only_for_promo')!=null){
				$data['only_for_promo']=1;
			} else {
				$data['only_for_promo']=0;
			}

			$this->form_validation->set_rules('name','name', 'trim|required|min_length[2]|max_length[60]|xss_clean');
			$this->form_validation->set_rules('description','description', 'trim|required|min_length[2]|max_length[200]|xss_clean');
			$this->form_validation->set_rules('price','price', 'trim|required|numeric|xss_clean');
			$this->form_validation->set_rules('cat','cat', 'trim|required|numeric|xss_clean');
			
			if($this->form_validation->run()!=false){
				$this->deals_model->update($data,['id'=>$_POST['dealId']]);
				$insert_id=$_POST['dealId'];
				if($insert_id!=0){
					$this->db->where(['deal_id' => $insert_id]);
					$this->db->delete('deal_lists');
					foreach($this->input->post('list') as $list) {
						$list_data = array();
						$list_data['deal_id'] 	= $insert_id;
						$list_data['title']		= $list['title'];
						$list_data['list_min_limit']	= $list['min'];
						$list_data['list_max_limit']	= $list['max'];
						$listId = $this->deal_lists_model->insert($list_data);
					}
					
					$this->db->where(['deal_id' => $insert_id]);
					$this->db->delete('deal_items');
					foreach($this->input->post('item') as $item) {
						$list = $this->deal_lists_model->get('*', array('title' => $item['list'], 'deal_id' => $insert_id));
						$item_data = array();
						$item_data['deal_id'] = $insert_id;
						$item_data['food_id'] = $item['food_id'];
						$item_data['size']	=	$item['size'];
						$item_data['list_id']	=	$list[0]->id;
						
						$this->deal_item_model->insert($item_data);
					}
					if(isset($_FILES['image'])){
						$this->load->helper('Ultils');
						$dir=create_sub_dir_upload('uploads/deals/');
						$filename=$_FILES['image']['name'];
						$_FILES['image']['name']=rename_upload_file($filename);
						$config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|JPEG|GIF|PNG';
						$config['max_size']	= '5000';
						$config['upload_path']=$dir;
						$this->load->library('upload',$config);
						if ($this->upload->do_upload('image'))
						{
							//$this->load->model('image_model');
							$data['path']=$dir.'/'.$_FILES['image']['name'];
							//$this->image_model->insert($data);
							$this->deals_model->update($data,array('id'=>$insert_id));

							$this->session->set_flashdata('msg_ok', $this->lang->line('edit_successfully'));
							redirect(base_url().'admin/deals/edit_get?id='.$insert_id);
						}else{
							$this->session->set_flashdata('msg_error', $this->upload->display_errors());
							redirect(base_url().'admin/deals/edit_get?id='.$insert_id);
						}
					}

					$this->session->set_flashdata('msg_ok', $this->lang->line('edit_successfully'));
							redirect(base_url().'admin/deals/edit_get?id='.$insert_id);
				}
			}else {
				$this->session->set_flashdata('msg_ok', $this->lang->line('edit_successfully'));
								redirect(base_url().'admin/deals/edit_get?id='.$_POST['dealId']);
			}
        } else {
			$this->session->set_flashdata('msg_ok', $this->lang->line('edit_successfully'));
							redirect(base_url().'admin/deals/edit_get?id='.$_POST['dealId']);
		}
	}

	public function set_default(){
		if(isset($_GET['id'])){
			$id = $this->input->get('id');
			$this->deals_model->update(array('default'=>0),array());
			$this->deals_model->update(array('default'=>1),array('id'=>$id));
			redirect(base_url().'admin/deals');
		}
	}

	public function delete(){
		if(isset($_GET['id'])){
			$id=$this->input->get('id');
			$obj=$this->deals_model->get_by_id($id);
			try {
				unlink($obj[0]->path);
			} catch (Exception $e) {

			}
			$this->deals_model->remove_by_id($id);
			redirect('admin/deals');
		}
	}

	public function search(){
		if(isset($_GET['query'])){
			$query=$this->input->get('query');
			$data=parent::getDataView();
			$page     = $this->input->get('page') ? $this->input->get('page') : 0;
			$per_page = $this->input->get('per_page') ? $this->input->get('per_page') : 10;
			$order    = $this->input->get('order') ? $this->input->get('order') : 'DESC';
			$config['total_rows'] = $this->deals_model->total(array(), array('name'=>$query));
			$config['base_url']= base_url() . 'index.php/admin/deals/search?order='.$order.'&query='.$query;
			$config['per_page']=$per_page;
			$data['msg_label']=$this->config->item('msg_label');
			$this->pagination->initialize($config);
			$data['list'] = $this->deals_model->get_by_name($query,$page,$per_page);
			$data['page_link'] = $this->pagination->create_links();
			$data['search_title']='Result search for "'.$query.'"';
			$this->template->write_view('content','backends/deals/index',$data);
			$this->template->render();
		}
	}
}
?>
