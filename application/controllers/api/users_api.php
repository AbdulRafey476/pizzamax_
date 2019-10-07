<?php
require APPPATH.'/libraries/REST_Controller.php';
class users_api extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
		$this->load->helper('Ultils');
	}

	function user_get() 
	{ 

		$this->load->model('users_model');
		$first=$this->get('first');
		$offset=$this->get('offset');
		$order=array('created_at'=>'DESC');
		$where=array();
		$like=array();
		$where['activated']=1;

		$fb_id=$this->get('fb_id');
		if($fb_id!=null){
			$where['fb_id']=$fb_id;
		}

		$id=$this->get('id');
		if($id!=null){
			$where['id']=$id;
		}
		
		$data=$this->users_model->get('*',$where,$like,$first,$offset,$order);
		if($data!=null){
			$this->response($data); 
		}else{
			$this->response(array('empty'=>'empty_data'));
		}

	} 

	function pwd_post(){
		$id=$this->post('id');
		if($id!=null){
			$new_pass=$this->post("new_pass");
			$old_pass=$this->post("old_pass");
			$data=$this->users_model->get_by_id($id);

			if($data[0]->pwd==""){
				$new_pass=encrypt_pwd($new_pass);
				$this->users_model->update(array('pwd'=>$new_pass), array('id'=>$id));
				$this->response(array('ok'=>'1'));
			}

			if($data[0]->pwd== encrypt_pwd($old_pass)){
				$new_pass=encrypt_pwd($new_pass);
				$this->users_model->update(array('pwd'=>$new_pass), array('id'=>$id));
				$this->response(array('ok'=>'1'));

			}else{
				$this->response(array('ok'=>'0'));
			}
		}
	}

	function login_post(){
		$user_name=$this->post('user_name');
		$pwd=$this->post('pwd');
		if($user_name!=null && $pwd!=null){
			$data=$this->users_model->get_by_username_and_pwd($user_name,encrypt_pwd($pwd));
			if($data!=null){
				$this->response($data);
			}else{
				$this->response(array('empty'=>'empty_data'));
			}
		}else{
			$this->response(array('empty'=>'empty_data'));
		}
	}

	function update_post(){
		$id=$this->post('id');

		$full_name=$this->post('full_name');
		$phone=$this->post('phone');
		$address=$this->post('address');
		$user=$this->users_model->get_by_id($id);
		if($user!=null){
			$data=array('phone'=>$phone,'address'=>$address,'full_name'=>$full_name);
			$this->users_model->update($data,array('id'=>$id));
			$obj = null;
			$obj = $this->users_model->get_by_id($id);
			$this->response($obj);
			$this->response(array('ok'=>'1'));
		}else{
			$this->response(array('ok'=>'0'));
		}
	}

	function cancel_register_post(){
		$email=$this->input->post('email');
		$this->load->model('verified_account_model');
		$this->verified_account_model->remove(array('email'=>$email));
	}

	function resend_verified_code_post(){
		$email=$this->input->post('email');
		$phone=$this->input->post('phone');
		$send_code_method=$this->input->post('send_code_method');

		$this->load->model('verified_account_model');
		if($send_code_method==0){
			//if sms method
			$data=$this->verified_account_model->get_by_email($email);
			if($data!=null){
				$this->load->helper('sms');
				$code=substr(md5(uniqid(rand(), true)), 6, 6);
				send_verified_sms($code,$phone);
				$data=array();
				$data['code']=$code;
				$this->verified_account_model->update($data, array('email'=>$email));
			}
		}else{
			//if email method
			$data=$this->verified_account_model->get_by_email($email);
			if($data!=null){
				$this->load->helper('email_ultils');
				$code=substr(md5(uniqid(rand(), true)), 6, 6);
				send_verified_mail($code,$email);
				$data=array();
				$data['code']=$code;
				$this->verified_account_model->update($data, array('email'=>$email));
			}
		}
	}

    //reponse code
    //0 : dont exist user
	function facebook_user_check_get() 
	{ 
		$fb_id=$this->input->get('fb_id');
		$data=$this->users_model->get_by_fb_id($fb_id);
		if($data==null){
			$this->response(array('success'=>'0'));
		}else{
			$this->response(array('success'=>'1','data'=>$this->users_model->get_by_fb_id($fb_id)));
		}
	} 

	//response code
	//0 : email error
	//1 : name error
	//2 : unkown

	function facebook_user_register_post(){
		$fb_id=$this->post('fb_id');
		$fullname=$this->post('fullname');
		$email=$this->post('email');
		$username=$this->post('user_name');
		$this->load->model('users_model');
		$data=$this->users_model->get_by_exact_email($email);
		if($data!=null){
			$this->response(array('success'=>'0'));
		}

		$data=null;
		$data=$this->users_model->get_by_exact_name($username);
		if($data!=null){
			$this->response(array('success'=>'1'));
		}

		$data=array(
			'fb_id'=>$fb_id,
			'user_name'=>$username,
			'email'=>$email,
			'full_name'=>$fullname,
			'avt'=> get_facebook_avt($fb_id, 200, 200),
			'perm'=>USER
			);
		$insert_id = $this->users_model->insert($data);
		if($insert_id!=0){
			$this->response($this->users_model->get_by_fb_id($fb_id));
		}else{
			$this->response(array('success'=>'2'));
		}
		$this->response(array('success'=>'2'));
	}

	function register_post() 
	{ 
		$code=$this->post('code');
		$email=$this->post('email');
		if($code==null && $email==null){
			$this->response(array('success'=>'0'));
		}
		$this->load->model('verified_account_model');
		$data=$this->verified_account_model->get_by_email_and_code($email,$code);
		if($data!=null){
			$insert_data['email']=$data[0]->email;
			$insert_data['user_name']=$data[0]->user_name;
			$insert_data['full_name']=$data[0]->full_name;
			$insert_data['address']=$data[0]->address;
			$insert_data['pwd']=$data[0]->pwd;
			$insert_data['perm']=USER;
			$insert_id = $this->users_model->insert($insert_data);
			if($insert_id!=0){
				$this->verified_account_model->remove(array('email'=>$email));
				$this->response(array('success'=>'1'));
			}else{
				$this->response(array('success'=>'0'));
			}
		}else{
			$this->response(array('success'=>'0'));
		}
	} 

	function check_mail_register_valid_post(){
		$email=$this->post('email');
		$user_name=$this->post('user_name');
		$phone=$this->post('phone');
		$address=$this->post('address');
		$full_name=$this->post('full_name');
		$pwd=$this->post('pwd');
		if($email!=null && $user_name!=null){
			$data=$this->users_model->get_by_exact_email($email);
			if($data!=null){
				//email exist
				$this->response(array('success'=>0));
				exit();
			}

			$data=$this->users_model->get_by_exact_name($user_name);
			if($data!=null){
				//username exist
				$this->response(array('success'=>1));
				exit();
			}

			$data=$this->users_model->get_by_exact_phone($phone);
			if($data!=null){
				//phone exist
				$this->response(array('success'=>2));
				exit();
			}

			$this->load->helper('ultils');
			$this->load->model('verified_account_model');
			$this->load->helper('email_ultils');
			$code=substr(md5(uniqid(rand(), true)), 6, 6);
			send_verified_mail($code,$email);

			$data['email']=$email;
			$data['user_name']=$user_name;
			$data['full_name']=$full_name;
			$data['phone']=$phone;
			$data['address']=$address;
			$data['code']=$code;
			$data['pwd']=encrypt_pwd($pwd);

			if($this->verified_account_model->get_by_email($email)!=null){
				$this->verified_account_model->update($data,array('email'=>$email));
			}else{
				$this->verified_account_model->insert($data);
			}
			$this->response(array('success'=>3));
		}
	}

	function check_sms_register_valid_post(){
		$email=$this->post('email');
		$user_name=$this->post('user_name');
		$phone=$this->post('phone');
		$address=$this->post('address');
		$full_name=$this->post('full_name');
		$pwd=$this->post('pwd');
		
		if($phone!=null && $user_name!=null){
			$data=$this->users_model->get_by_exact_email($email);
			if($data!=null){
				//email exist
				$this->response(array('success'=>0));
				exit();
			}

			$data=$this->users_model->get_by_exact_name($user_name);
			if($data!=null){
				//username exist
				$this->response(array('success'=>1));
				exit();
			}

			$data=$this->users_model->get_by_exact_phone($phone);
			if($data!=null){
				//phone exist
				$this->response(array('success'=>2));
				exit();
			}


			$this->load->helper('ultils');
			$this->load->model('verified_account_model');
			$this->load->helper('sms');
			$code=substr(md5(uniqid(rand(), true)), 6, 6);
			send_verified_sms($code,$phone);

			$data['email']=$email;
			$data['user_name']=$user_name;
			$data['full_name']=$full_name;
			$data['phone']=$phone;
			$data['address']=$address;
			$data['code']=$code;
			$data['pwd']=encrypt_pwd($pwd);

			if($this->verified_account_model->get_by_email($email)!=null){
				$this->verified_account_model->update($data,array('email'=>$email));
			}else{
				$this->verified_account_model->insert($data);
			}
			$this->response(array('success'=>3));
		}
	}

	function remove_verified_account_post(){
		$email=$this->post('email');
		$this->load->model('verified_account_model');
		$this->verified_account_model->remove_by_email($email);
	}



	function update_avt_post(){
		if(isset($_FILES['avt'])){
			$id=$this->input->post('user_id');
			$config['upload_path'] = 'uploads/avts';
			$config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|JPEG|GIF|PNG';
			$config['max_size']	= '15000';
			$this->load->library('upload', $config);
			$filename=$_FILES['avt']['name'];
			$_FILES['avt']['name']=rename_upload_file($filename);	
			if ($this->upload->do_upload('avt'))
			{
				try {
					$user=$this->users_model->get_by_id($id);
					unlink($user[0]->avt);
				} catch (Exception $e) {
					echo $e;
				}
				$image_path='uploads/avts/'.$_FILES['avt']['name'];
				$data=array('avt'=>$image_path);
				$this->users_model->update($data,array('id'=>$id));	
				$this->response(array('avt'=>$image_path));
			}else{
				echo $this->upload->display_errors();
			}
		}
	}


	function send_enquiry_post(){
		if(isset($_POST['email'])){
			$this->load->model('spam_model');
			$reply_to=$this->input->post('reply_to');
			$email=$this->input->post('email');
			$message=$this->input->post('message');
			$user_name=$this->input->post('user_name');
			$data=$this->spam_model->get_by_sender_and_receiver($reply_to,$email);
			$this->load->helper('email_ultils');
			if($data!=null){
				if((time()-strtotime($data[0]->updated_at))>120){
					send_enquiry($message,$email,$reply_to,$user_name);
					$insert_data['sender']=$reply_to;
					$insert_data['receiver']=$email;
					$insert_data['content']=$message;
					$this->spam_model->insert($insert_data);
					$this->response(array('success'=>'1'));
					exit();
				}else{
					//block send email, display error
					$this->response(array('success'=>'0'));
					exit();
				}
			}else{
				send_enquiry($message,$email,$reply_to,$user_name);
				$insert_data['sender']=$reply_to;
				$insert_data['receiver']=$email;
				$insert_data['content']=$message;
				$this->spam_model->insert($insert_data);
				$this->response(array('success'=>'1'));
				exit();
			}
		}	
	}

	function reset_pwd_post(){
		$type=$this->input->post('type');
		$data=$this->input->post('data');
		if($type==0){
			//send sms
			$new_pass=gen_uuid();

			$new_pass=encrypt_pwd($new_pass);
			$this->users_model->update(array('pwd'=>$new_pass),array('phone'=>$data));
		}else{
			//send email
			$new_pass=gen_uuid();

			$new_pass=encrypt_pwd($new_pass);
			$this->users_model->update(array('pwd'=>$new_pass),array('email'=>$data));
		}
	}

	function user_put() 
	{ 
		$data = array('this not available'); 
		$this->response($data); 
	} 

	function user_delete() 
	{ 
		$data = array('this not available');
		$this->response($data); 
	}  




}
?>