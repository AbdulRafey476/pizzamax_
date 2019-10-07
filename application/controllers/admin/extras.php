<?php
class extras extends MY_Controller{
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
		$this->load->model('extras_model');
		$this->form_validation->set_error_delimiters('<span class="help-inline msg-error" generated="true">', '</span>');
	}

	function index(){
		$base_url=base_url().'admin/extras';
		$page=$this->uri->segment(3);
		if(!is_numeric($page) || $page<=0){
			$page=1;
		}
		$first=($page-1)*$this->pg_per_page;
		$total_rows=$this->extras_model->total(array(),array());
		$data['list'] = $this->extras_model->get("*", array(),array(),$first, $this->pg_per_page, array('id' => 'DESC'));
		$data['page_link'] =parent::pagination_config($base_url,$total_rows,$this->pg_per_page);
		$this->render_backend_tp('backends/extras/index', $data);
	}

	public function create(){
		if(isset($_POST['name'])){
			$this->form_validation->set_rules('name','name', 'trim|required|min_length[2]|max_length[60]|xss_clean|callback_check_name_exist_add');
			$this->form_validation->set_rules('price', 'price', 'trim|required|numeric');
			if($this->form_validation->run()!=false){
				$data['name']=$this->input->post('name');
				$data['price']=$this->input->post('price');
				$insert_id=$this->extras_model->insert($data);
				if($insert_id!=0){
					$this->session->set_flashdata('msg_ok', $this->lang->line('add_successfully'));
					redirect(base_url().'admin/extras/create');
				}
			}
		}
		$this->template->write_view('content','backends/extras/add');
		$this->template->render();
	}

	public function check_name_exist_add($name){
		$data=$this->extras_model->get_by_exact_name($name, 0, 1);
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
		$data=$this->extras_model->get_by_name_and_diff_id($id,$name);
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
			$data['obj']=$this->extras_model->get_by_id($id);
			$this->load->model('extras_model');
			$this->template->write_view('content','backends/extras/edit',$data);
			$this->template->render();
		}
	}

	public function edit_post(){
		if(isset($_POST['id'])){
			$id=$_POST['id'];
			$this->form_validation->set_rules('name','name', 'trim|required|min_length[2]|max_length[60]|xss_clean|callback_check_name_exist_edit');
			$this->form_validation->set_rules('price', 'price', 'trim|required|numeric');
			if($this->form_validation->run()){
				$name=$this->input->post('name');
				$price=$this->input->post('price');
				$this->extras_model->update(array('name'=>$name,'price'=>$price),array('id'=>$id));
				$this->session->set_flashdata('msg_ok',$this->lang->line('edit_successfully'));
				redirect(base_url().'admin/extras/edit_get?id='.$id);
			}

			$data['obj']=$this->extras_model->get_by_id($id);
			$this->load->model('extras_model');
			$this->template->write_view('content','backends/extras/edit',$data);
			$this->template->render();
		}
	}

	public function delete(){
		if(isset($_GET['id'])){
			$id=$this->input->get('id');
			$obj=$this->extras_model->get_by_id($id);
			try {
				unlink($obj[0]->path);
			} catch (Exception $e) {

			}
			$this->extras_model->remove_by_id($id);
			redirect('admin/extras');
		}
	}

	public function search(){
		if(isset($_GET['query'])){
			$query=$this->input->get('query');
			$data=parent::getDataView();
			$page     = $this->input->get('page') ? $this->input->get('page') : 0;
			$per_page = $this->input->get('per_page') ? $this->input->get('per_page') : 10;
			$order    = $this->input->get('order') ? $this->input->get('order') : 'DESC';
			$config['total_rows'] = $this->extras_model->total(array(), array('name'=>$query));
			$config['base_url']= base_url() . 'index.php/admin/extras/search?order='.$order.'&query='.$query;
			$config['per_page']=$per_page;
			$data['msg_label']=$this->config->item('msg_label');
			$this->pagination->initialize($config);
			$data['list'] = $this->extras_model->get_by_name($query,$page,$per_page);
			$data['page_link'] = $this->pagination->create_links();
			$data['search_title']='Result search for "'.$query.'"';
			$this->template->write_view('content','backends/extras/index',$data);
			$this->template->render();
		}
	}
}
?>
