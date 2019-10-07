<?php
class foods extends MY_Controller{
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
		$this->load->model('food_model');
		$this->form_validation->set_error_delimiters('<span class="help-inline msg-error" generated="true">', '</span>');
	}

	function index(){
		//parent::authentication_backend();
		$base_url=base_url().'admin/foods';
		$page=$this->uri->segment(3);
		if(!is_numeric($page) || $page<=0){
			$page=1;
		}

		$first=($page-1)*$this->pg_per_page;
		$total_rows=$this->food_model->total(array(),array());
		$data['list'] = $this->food_model->get("*,foods.id as id, foods.name as name,foods.activated as activated", array(),array(),$first,$this->pg_per_page, array('foods.id' => 'DESC'));
		$data['page_link'] =parent::pagination_config($base_url,$total_rows,$this->pg_per_page);
		$this->render_backend_tp('backends/foods/index', $data);
	}

	public function create(){
		if(isset($_POST['name'])){
			$this->form_validation->set_rules('name',$this->lang->line('msg_name'), 'trim|required|min_length[2]|max_length[100]|xss_clean');
			$this->form_validation->set_rules('price', $this->lang->line('msg_price'), 'trim|required|numeric|xss_clean');
			$this->form_validation->set_rules('description',$this->lang->line('msg_description'), 'trim');
			$this->form_validation->set_rules('categories', $this->lang->line('msg_categories'), 'trim|required|xss_clean');

			if($this->input->post('active_offer')!=null){
				$this->form_validation->set_rules('discount_percent',$this->lang->line('msg_discount_percent') , 'trim|required|xss_clean|numeric');
				$this->form_validation->set_rules('offer_description', $this->lang->line('msg_offer_description'), 'trim|required|xss_clean');
				$data['discount_percent']=$this->input->post('discount_percent');
				$data['offer_description']=$this->input->post('offer_description');
				$data['is_offered']=1;
			}

			$user=$_SESSION['user'][0];
			if($this->form_validation->run()!=false){
				$data['name']=preg_replace('/[\r\n]+/', "", $this->input->post('name'));
				$data['price']=$this->input->post('price');
				$data['description']=preg_replace('/[\r\n]+/', "", htmlspecialchars($this->input->post('description')));
				$data['user_id']=$user->id;
				$data['categories_id']=$this->input->post('categories');
				$data['tag']=$this->input->post('tag');
				$data['tag']=str_replace(',',' ', $data['tag']);
				$insert_id = $this->food_model->insert($data);
				$this->load->model('sizes_model');
				$sizes=$this->sizes_model->get();
				$this->load->model('food_sizes_model');
				if($insert_id!=0){
					foreach ($sizes as $r) {
						if($_POST['size_'.$r->id]!=null){
							$size_data=array();
							$size_data['food_id']=$insert_id;
							$size_data['size_id']=$this->input->post('size_id_'.$r->id);
							$size_data['price']=$this->input->post('size_'.$r->id);
							$this->food_sizes_model->insert($size_data);
						}
					}

					if($_POST['extras_list']!=null && $_POST['extras_list']!=''){
						$this->load->model('food_extras_model');
						$extras = json_decode($this->input->post('extras_list'), true);
						foreach ($extras as $r) {
							$extras_data['food_id']=$insert_id;
							$extras_data['extra_id']=$r;
							$this->food_extras_model->insert($extras_data);
						}
					}

					if(isset($_FILES['image']) && !empty($_FILES['image']['name'])){
						$config=array();
						$dir=create_sub_dir_upload('uploads/foods/');
						$filename=$_FILES['image']['name'];
						$_FILES['image']['name']=rename_upload_file($filename);
						$config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|JPEG|GIF|PNG';
						$config['max_size']	= '5000';
						$config['upload_path']=$dir;
						$this->load->library('upload',$config);
						if ($this->upload->do_upload('image'))
						{
							$data['image']=$dir.'/'.$_FILES['image']['name'];
							$this->food_model->update($data,array('id'=>$insert_id));
							$this->session->set_flashdata('msg_ok', $this->lang->line('add_successfully'));
							redirect(base_url().'admin/foods/create');
						}else{
							$this->session->set_flashdata('msg_error', $this->upload->display_errors());
							redirect(base_url().'admin/foods/create');
						}
					}

					$this->session->set_flashdata('msg_ok', $this->lang->line('add_successfully'));
					redirect(base_url().'admin/foods/create');
				}else{
					$this->session->set_flashdata('msg_error', $this->lang->line('add_failed'));
				}
			}
		}//end exist name

		$this->load->model('categories_model');
		$data['categories']=$this->categories_model->get();
		$this->load->model('sizes_model');
		$data['sizes']=$this->sizes_model->get();
		$this->template->write_view('content','backends/foods/add',$data);
		$this->template->render();
	}

	public function upload(){
		if(isset($_FILES['image'])){
			$filename=$_FILES['image']['name'];
			$_FILES['image']['name']=rename_upload_file($filename);
		}
		if ($this->upload->do_upload('image'))
		{
			return $_FILES['image']['name'];
		}
		else
		{
			return null;
		}
	}

	public function edit_get(){
		if(isset($_GET['id'])){
			$id=$this->input->get('id');
			$data['obj']=$this->food_model->get_by_id($id);
			$this->load->model('categories_model');
			$data['categories']=$this->categories_model->get();
			$this->load->model('sizes_model');
			$data['sizes']=$this->sizes_model->get();
			$this->load->model('food_sizes_model');
			$data['food_sizes']=$this->food_sizes_model->get('*',array('food_id'=>$id));
			$this->load->model('food_extras_model');
			$data['food_extras']=$this->food_extras_model->get('*',array('food_id'=>$id));
			$this->template->write_view('content','backends/foods/edit',$data);
			$this->template->render();
		}
	}


	public function edit_post(){
		$id=$this->input->post('id');
		$edit['obj']=$this->food_model->get_by_id($id);
		if($edit['obj']==null){
			redirect('notfound');
		}

		if(isset($_POST['id'])){
			$id=$this->input->post('id');
			$this->load->model('food_model');
			$this->form_validation->set_rules('name','name', 'trim|required|min_length[2]|max_length[100]|xss_clean');
			$this->form_validation->set_rules('price', 'price', 'trim|numeric|xss_clean');
			$this->form_validation->set_rules('description', 'description', 'trim|max_length[2000]|xss_clean');
			$this->form_validation->set_rules('categories', 'categories', 'trim|required|xss_clean');
			$data['is_offered']=0;
			if($this->input->post('active_offer')!=null){
				$this->form_validation->set_rules('discount_percent',$this->lang->line('msg_discount_percent') , 'trim|required|xss_clean|numeric');
				$this->form_validation->set_rules('offer_description', $this->lang->line('msg_offer_description'), 'trim|required|xss_clean');
				$data['discount_percent']=$this->input->post('discount_percent');
				$data['offer_description']=$this->input->post('offer_description');
				$data['is_offered']=1;
			}

			if($this->input->post('featured_offer')!=null){
				$data['featured']=1;
			} else {
				$data['featured']=0;
			}

			if($this->form_validation->run()!=false){
				$data['name']=preg_replace('/[\r\n]+/', "", $this->input->post('name'));
				$data['price']=$this->input->post('price');
				$data['description']=preg_replace('/[\r\n]+/', "", htmlspecialchars($this->input->post('description')));
				$data['categories_id']=$this->input->post('categories');
				$this->food_model->update($data,array('id'=>$id));

				$this->load->model('sizes_model');
				$sizes=$this->sizes_model->get();
				$this->load->model('food_sizes_model');
				foreach ($sizes as $r) {
					if($_POST['size_'.$r->id]!=null){
						$size_data=array();
						$size_data['food_id']=$id;
						$size_data['size_id']=$this->input->post('size_id_'.$r->id);
						$size_data['price']=$this->input->post('size_'.$r->id);

						if($this->food_sizes_model->get('*',array('food_id'=>$id,'size_id'=>$r->id))!=null){
							$this->food_sizes_model->update($size_data,array('food_id'=>$id,'size_id'=>$r->id));
						}else{
							$this->food_sizes_model->insert($size_data);
						}
					}else{
						$this->food_sizes_model->remove_by_sizeid_foodid($r->id,$id);
					}
				}

				if($_POST['extras_list']!=null && $_POST['extras_list']!=''){
					$this->load->model('food_extras_model');
					$extras = json_decode($this->input->post('extras_list'), true);
					$this->food_extras_model->remove(array('food_id'=>$id));
					foreach ($extras as $r) {
						$extras_data['food_id']=$id;
						$extras_data['extra_id']=$r;
						$this->food_extras_model->insert($extras_data,array('food_id'=>$id));
					}
				}

				if(isset($_FILES['image']) && !empty($_FILES['image']['name'])){
					$config=array();
					$dir=create_sub_dir_upload('uploads/foods/');
					$filename=$_FILES['image']['name'];
					$_FILES['image']['name']=rename_upload_file($filename);
					$config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|JPEG|GIF|PNG';
					$config['max_size']	= '5000';
					$config['upload_path']=$dir;
					$this->load->library('upload',$config);
					if ($this->upload->do_upload('image'))
					{
						$data['image']=$dir.'/'.$_FILES['image']['name'];
						try {
							unlink($edit['obj'][0]->image);
						} catch (Exception $e) {
							echo $e;
						}

						$this->session->set_flashdata('msg_ok', $this->lang->line('add_successfully'));
						$this->food_model->update($data, array('id'=>$id));
						redirect(base_url().'admin/foods/edit_get?id='.$id);
					}else{
						$this->session->set_flashdata('msg_error', $this->upload->display_errors());
						redirect(base_url().'admin/foods/edit_get?id='.$id);
					}
				}

				$this->session->set_flashdata('msg_ok',$this->lang->line('edit_successfully'));
				redirect(base_url().'admin/foods/edit_get?id='.$id);
			}
		}
		$this->load->model('categories_model');
		$data['categories']=$this->categories_model->get();
		$this->render_backend_tp('backends/foods/edit',$data);
	}

	public function delete(){
		if(isset($_GET['id'])){
			$id=$this->input->get('id');
			$product=$this->food_model->get_by_id($id);
			if($product!=null){
				try {
					unlink($product[0]->image);
				} catch (Exception $e) {

				}
			}
			$this->food_model->remove_by_id($id);
			redirect('admin/foods');
		}
	}

	public function activate(){
		if(isset($_GET['id'])){
			$id=$this->input->get('id');
			echo $id;
			$this->food_model->update(array('activated'=>1),array('id'=>$id));
		}
		redirect('admin/foods');
	}

	public function lock(){
		if(isset($_GET['id'])){
			$id=$this->input->get('id');
			$this->food_model->update(array('activated'=>0),array('id'=>$id));
		}
		redirect('admin/foods');
	}

	public function search(){
		if(isset($_GET['query'])){
			$query=$this->input->get('query');
			$data=parent::getDataView();
			$page     = $this->input->get('page') ? $this->input->get('page') : 0;
			$per_page = $this->input->get('per_page') ? $this->input->get('per_page') : 10;
			$order    = $this->input->get('order') ? $this->input->get('order') : 'DESC';
			$config['total_rows'] = $this->food_model->total(array(), array('name'=>$query));
			$config['base_url']= base_url() . 'admin/foods/search?order='.$order.'&query='.$query;
			$config['per_page']=$per_page;
			$data['msg_label']=$this->config->item('msg_label');
			$this->pagination->initialize($config);
			$data['list'] = $this->food_model->get_by_name($query,$page,$per_page);
			$data['page_link'] = $this->pagination->create_links();
			$data['search_title']='Result search for "'.$query.'"';
			$this->template->write_view('content','backends/foods/index',$data);
			$this->template->render();
		}
	}
}
?>
