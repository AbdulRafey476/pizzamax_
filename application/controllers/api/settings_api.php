<?php
require APPPATH.'/libraries/REST_Controller.php';
class settings_api extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	function settings_get() 
	{ 
		$this->load->helper('settings');
		$data=getSettings(GENERAL_SETTING_FILE);
		$this->response($data);
	} 
}
?>