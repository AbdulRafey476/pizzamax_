<?php 
class User extends MY_Controller{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('settings_helper');
		$this->template->master = $this->template->config['frontend']['template'];
		/** DB MODELS */
		$this->load->model('deals_model');
        $this->load->model('deal_item_model');
        $this->load->model('deal_categories_model');
        $this->load->model('deal_lists_model');
		$this->load->model('food_model');
	}


	function index(){
		
		$settings=getSettings(GENERAL_SETTING_FILE);
		$data = [];
		// echo '<pre>';
		// print_r($this->template);
		// die();
		$this->template->write_view('content','frontends/home',array());
		$this->template->render();
    }
    
    public function register()
    {
        if(isset($_POST['email'])) {

        }

        $this->template->write_view('content','frontends/user/register',[]);
        $this->template->render();
	}

    public function login()
    {
        if(isset($_POST['email'])) {

        }

        $this->template->write_view('content','frontends/user/register',[]);
        $this->template->render();
	}
	
	public function otp()
	{
		$this->template->write_view('content', 'frontends/user/otp',[]);
		$this->template->render();
	}

	public function portal()
	{
		$this->template->write_view('content','frontends/user/portal');
		$this->template->render();
	}

}
?>