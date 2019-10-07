<?php
require APPPATH.'/libraries/REST_Controller.php';
class payments_api extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function pay_get(){

		$stripe = array(
			"secret_key"      => "sk_test_0QUpPBXgii1P5AIAMi7uUXaY",
			"publishable_key" => "pk_test_nqykHcHCdCnWPJCD6pguqShK"
			);

		\Stripe\Stripe::setApiKey($stripe['secret_key']);

		$charge = \Stripe\Charge::create(array(
         'amount'   => 5.00,
         'currency' => 'GBP',
         'source' => 'tok_1AewqMAKRfWcmYdi3Q6LJqmV'
  		));


	}
}
?>
