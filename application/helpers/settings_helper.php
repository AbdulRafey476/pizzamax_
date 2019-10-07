<?php
$CI =& get_instance();
$CI->load->helper('ultils');
$CI->load->helper('file');

function getSettings($file){
	return object_2_array(json_decode(read_file($file, true)));
}

$settings = array();
$settings = getSettings(EMAIL_SETTING_FILE);
if(!$settings){
	resetEmail();
}


$settings = getSettings(GENERAL_SETTING_FILE);
if(!$settings){
	resetGeneral();
}


function resetGeneral(){
	/*
	$settings['terms_and_conditions'] = '';
	$settings['tax']=0;
	$settings['position']  =  CURRENCY_SYMBOL_BEFORE;
	$settings['currency_symbol']='$';
	$settings['currency_id']=227;
	$settings['website']='http://lrandomdev.com';
	$settings['twitter']='https://twitter.com/lrandomdev';
	$settings['facebook']='https://www.facebook.com/pages/LrandomDev/541746319279638';
	$settings['mail']='luann4099@gmail.com';
	$settings['phone']='01639917553';
	*/
	resetSettings($settings,GENERAL_SETTING_FILE);
}

function resetEmail(){
	/*Email settings*/
	$settings['useragent']        = 'PHPMailer';              // Mail engine switcher: 'CodeIgniter' or 'PHPMailer'
	$settings['protocol']         = 'smtp';                   // 'mail', 'sendmail', or 'smtp'
	$settings['smtp_timeout']     = 5;                        // (in seconds)
	$settings['smtp_crypto']      = '';                       // '' or 'tls' or 'ssl'
	$settings['smtp_debug']       = 0;                        // PHPMailer's SMTP debug info level: 0 = off, 1 = commands, 2 = commands and data
	$settings['wordwrap']         = true;
	$settings['wrapchars']        = 76;
	$settings['mailtype']         = 'html';                   // 'text' or 'html'
	$settings['charset']          = 'utf-8';
	$settings['validate']         = true;
	$settings['priority']         = 3;                        // 1, 2, 3, 4, 5
	$settings['crlf']             = "\n";                     // "\r\n" or "\n" or "\r"
	$settings['newline']          = "\n";                     // "\r\n" or "\n" or "\r"
	$settings['bcc_batch_mode']   = false;
	$settings['bcc_batch_size']   = 200;
	$settings['smtp_host']        = 'ssl://smtp.googlemail.com';
	$settings['smtp_user']        = '';
	$settings['smtp_pass']        = '';
	$settings['smtp_port']        = 465;
	$settings['from_email']       = '';
	$settings['from_user'] = SITE_NAME;
	$settings['mailpath']         = '';
	/*end email settings*/
	resetSettings($settings,EMAIL_SETTING_FILE);
}

function resetCurrency(){
	/*
	$settings['position']  =  CURRENCY_SYMBOL_BEFORE;
	$settings['currency_symbol']='$';
	$settings['currency_id']=227;
	$settings['website']='http://lrandomdev.com';
	$settings['twitter']='https://twitter.com/lrandomdev';
	$settings['facebook']='https://www.facebook.com/pages/LrandomDev/541746319279638';
	$settings['mail']='luann4099@gmail.com';
	$settings['phone']='01639917553';
	resetSettings($settings,CURRENCY_SETTING_FILE);
	*/
}


function setSettings($settings,$file){
	$json=json_encode($settings);
	write_file($file,$json);
}

function resetSettings($settings,$file){
	$json = json_encode($settings);
	write_file($file, $json);
}

?>
