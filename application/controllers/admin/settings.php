<?php
class Settings extends CI_Controller{
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
		$this->load->helper('settings');
		$this->form_validation->set_error_delimiters('<div class="error-line">', '</div>');
	}

	function general(){
		$this->load->model('countries_model');
		if(isset($_POST['currency'])){
			$id=$this->input->post('currency');
			$settings['currency_id']=$id;
			$currency_symbol=$this->countries_model->get_by_id($id);
			$settings['currency_symbol']=$currency_symbol[0]->currency_symbol;
			$settings['currency_code']=$currency_symbol[0]->currency_code;
			$settings['tax']=$this->input->post('tax');
			$settings['ship_fee']=$this->input->post('ship_fee');
			$settings['terms_and_conditions']=$this->input->post('terms_and_conditions');

			$settings['address']=$this->input->post('address');
			$settings['sub_address']=$this->input->post('sub_address');

			$settings['website']=$this->input->post('website');
			$settings['twitter']=$this->input->post('twitter');
			$settings['facebook']=$this->input->post('facebook');
			$settings['instagram']=$this->input->post('instagram');
			$settings['pinterest']=$this->input->post('pinterest');
			$settings['google_plus']=$this->input->post('google_plus');
			$settings['youtube']=$this->input->post('youtube');
			$settings['mail']=$this->input->post('mail');
			$settings['sub_mail']=$this->input->post('sub_mail');
			$settings['phone']=$this->input->post('phone');
			$settings['sub_phone']=$this->input->post('sub_phone');
			$settings['ship_fee']=$this->input->post('ship_fee');

			if(isset($_POST['position'])){
				$position=$this->input->post('position');
				$settings['position']=$position;
				setSettings($settings,GENERAL_SETTING_FILE);
			}
		}
		$data['obj']=getSettings(GENERAL_SETTING_FILE);
		$data['list']=$this->countries_model->get_currency();
		$data['heading']=$this->lang->line('msg_settings').'-'.$this->lang->line('msg_general');
		$this->template->write_view('content','backends/settings/general',$data);
		$this->template->render();
	}

	function reset_general_settings(){
		resetGeneral();
		redirect('admin/settings/general');
	}

	function payments(){
		if(isset($_POST['public_key'])){
			$public_key=$this->input->post('public_key');
			$secret_key=$this->input->post('secret_key');
			$settings=array();
			$settings['public_key']=$public_key;
			$settings['secret_key']=$secret_key;
			setSettings($settings,PAYMENT_SETTING_FILE);
		}

		$data['obj']=getSettings(PAYMENT_SETTING_FILE);
		$this->template->write_view('content','backends/settings/payment',$data);
		$this->template->render();
	}

	function reset_payments_settings(){
		resetPayments();
		redirect('admin/settings/payments');
	}

	function mail(){
		if(isset($_POST['host'])){
			$host=$this->input->post('host');
			$user=$this->input->post('user');
			$pwd=$this->input->post('pwd');
			$port=$this->input->post('port');
			$mailpath=$this->input->post('mail_path');
			$from_user=$this->input->post('from_user');
			$from_email=$this->input->post('from_email');
			$settings=getSettings(EMAIL_SETTING_FILE);
			$settings['smtp_host']        = $host;
			$settings['smtp_user']        = $user;
			$settings['smtp_pass']        = $pwd;
			$settings['smtp_port']        = $port;
			$settings['from_email']       = $from_email;
			$settings['from_user'] =        $from_user;
			$settings['mailpath']         = $mailpath;
			setSettings($settings,EMAIL_SETTING_FILE);
		}
		$data['obj']=getSettings(EMAIL_SETTING_FILE);
		$this->template->write_view('content','backends/settings/email',$data);
		$this->template->render();
	}

	function reset_mail_settings(){
		resetEmail();
		redirect('admin/settings/mail');
	}

	function push(){
		if(isset($_POST['app_id'])){
			$app_id=$this->input->post('app_id');
			$rest_key=$this->input->post('rest_key');

			$settings=getSettings(PUSH_SETTING_FILE);
			$settings['app_id']        = $app_id;
			$settings['rest_key']        = $rest_key;
			setSettings($settings,PUSH_SETTING_FILE);
		}
		$data['obj']=getSettings(PUSH_SETTING_FILE);
		$this->template->write_view('content','backends/settings/push',$data);
		$this->template->render();
	}

	function reset_push(){
		resetPush();
		redirect('admin/settings/push');
	}

}
?>
