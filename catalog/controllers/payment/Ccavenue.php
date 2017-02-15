<?php

class Ccavenue extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		
		$this->load->library('tax');
		$this->load->library('mycart');
		$this->load->library('customer');
		$this->lang->load('payment/ccavenue_lang','english');
		
		$this->load->model('account/address_model','address');

		$this->load->model('system/country_model','country');

		$this->load->model('system/zone_model','zone');

		$this->load->model('account/customer_model','customers');
	}
	public function index() {
		
		$data['button_confirm'] = $this->lang->line('button_confirm');
		$data['action'] = $this->common->config('ccavenue_action');
		
		if(empty($data['action'])){
			$data['action']='https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction';
		}
		
		$data['access_code'] = $this->common->config('ccavenue_access_code');
		$this->load->model('account/order_model','order');

		$order_info = $this->order->getOrder(11);
		
		if ($order_info) {
			
			$merchant_id=$this->common->config('ccavenue_Merchant_Id');  
			$order_id=$this->session->data['order_id'];        
			$amount=$order_info['total'];            
			$currency=$order_info['currency_code'];
			$redirect_url=urlencode(site_url('payment/ccavenue/callback'));         
			$cancel_url=urlencode(site_url('checkout/checkout'));
			$language='EN';
			$billing_name=html_entity_decode($order_info['payment_firstname'], ENT_QUOTES, 'UTF-8').' '.html_entity_decode($order_info['payment_lastname'], ENT_QUOTES, 'UTF-8');
			$billing_address=html_entity_decode($order_info['payment_address_1'], ENT_QUOTES, 'UTF-8');
			$billing_city=html_entity_decode($order_info['payment_city'], ENT_QUOTES, 'UTF-8');
			$billing_state=html_entity_decode($order_info['payment_zone'], ENT_QUOTES, 'UTF-8');
			$billing_zip=html_entity_decode($order_info['payment_postcode'], ENT_QUOTES, 'UTF-8');
			$billing_country= $order_info['payment_country'];
			$billing_tel=$order_info['telephone'];
			$billing_email=$order_info['email'];
			$delivery_name=html_entity_decode($order_info['shipping_firstname'], ENT_QUOTES, 'UTF-8').''.html_entity_decode($order_info['shipping_lastname'], ENT_QUOTES, 'UTF-8');
			$delivery_address=html_entity_decode($order_info['shipping_address_1'], ENT_QUOTES, 'UTF-8');
			$delivery_city=html_entity_decode($order_info['shipping_city'], ENT_QUOTES, 'UTF-8');
			$delivery_state=html_entity_decode($order_info['shipping_zone'], ENT_QUOTES, 'UTF-8');
			$delivery_zip=html_entity_decode($order_info['shipping_postcode'], ENT_QUOTES, 'UTF-8');
			$delivery_country=$order_info['shipping_country'];
			$delivery_tel=$order_info['email'];
			$merchant_param1='';
			$merchant_param2='';
			$merchant_param3='';
			$merchant_param4='';
			$merchant_param5='';
			$promo_code='';
			$customer_identifier='';
			$working_key=$this->common->config('ccavenue_workingkey');
			$access_code=$this->common->config('ccavenue_access_code');
			
			$merchant_data=	'merchant_id='.$merchant_id.'&order_id='.$order_id.'&amount='.$amount.'&currency='.$currency.'&redirect_url='.$redirect_url.
					'&cancel_url='.$cancel_url.'&language='.$language.'&billing_name='.$billing_name.'&billing_address='.$billing_address.
					'&billing_city='.$billing_city.'&billing_state='.$billing_state.'&billing_zip='.$billing_zip.'&billing_country='.$billing_country.
					'&billing_tel='.$billing_tel.'&billing_email='.$billing_email.'&delivery_name='.$delivery_name.'&delivery_address='.$delivery_address.
					'&delivery_city='.$delivery_city.'&delivery_state='.$delivery_state.'&delivery_zip='.$delivery_zip.'&delivery_country='.$delivery_country.
					'&delivery_tel='.$delivery_tel.'&merchant_param1='.$merchant_param1.'&merchant_param2='.$merchant_param2.
					'&merchant_param3='.$merchant_param3.'&merchant_param4='.$merchant_param4.'&merchant_param5='.$merchant_param5.'&promo_code='.$promo_code.
					'&customer_identifier='.$customer_identifier;
			
		
			$data['encrypted_data']=$this->encrypt($merchant_data,$working_key); 
			
			$data['checkout_method'] = $this->common->config('ccavenue_checkout_method');
			

					
			$data['iframeaction']= $data['action'].'&encRequest='.$data['encrypted_data'].'&access_code='.$data['access_code'];
			
			$site_theme = $this->common->config('catalog_theme');
		$this->load->view("themes/".$site_theme."/payment/ccavenue",$data);
			
			
		}
	}
	
	
	public function callback() {
		
		$this->load->model('checkout/order_model','order');
		
		$workingKey=$this->common->config('ccavenue_workingkey');
		if(isset($_POST["encResp"]))
		{
		$encResponse=$_POST["encResp"];
		
		$rcvdString=$this->decrypt($encResponse,$workingKey);
		$order_status="";
		$decryptValues=explode('&', $rcvdString);
		$dataSize=sizeof($decryptValues);
		
		for($i = 0; $i < $dataSize; $i++) 
		{
			$information=explode('=',$decryptValues[$i]);
			if($i==3)	$order_status=$information[1];
		}
		
		$orderid=explode('=',$decryptValues[0]);
		
		$order_info = $this->order->getOrder($orderid['1']);
		if ($order_info) {
					if($order_status==="Success")
					{
					$order_status_id = $this->common->config('ccavenue_completed_status_id');
					}
					else if($order_status==="Failure")
					{
					$order_status_id = $this->common->config('ccavenue_failed_status_id');
					}
					else if($order_status==="Aborted")
					{
					$order_status_id = $this->common->config('ccavenue_pending_status_id');
					}
					
				
					$this->order->addOrderHistory($order_info['order_id'], $order_status_id);
				
					redirect('checkout/success');
				
				
				} 
			}else
			{
				redirect('checkout/checkout');
			
			}
			
			
		}
	public function encrypt($plainText,$key)
	{
		$secretKey = $this->hextobin(md5($key));
		$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
	  	$openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '','cbc', '');
	  	$blockSize = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, 'cbc');
		$plainPad = $this->pkcs5_pad($plainText, $blockSize);
	  	if (mcrypt_generic_init($openMode, $secretKey, $initVector) != -1) 
		{
		      $encryptedText = mcrypt_generic($openMode, $plainPad);
	      	      mcrypt_generic_deinit($openMode);
		      			
		} 
		return bin2hex($encryptedText);
	}

	public function decrypt($encryptedText,$key)
	{
		$secretKey = $this->hextobin(md5($key));
		$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
		$encryptedText= $this->hextobin($encryptedText);
	  	$openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '','cbc', '');
		mcrypt_generic_init($openMode, $secretKey, $initVector);
		$decryptedText = mdecrypt_generic($openMode, $encryptedText);
		$decryptedText = rtrim($decryptedText, "\0");
	 	mcrypt_generic_deinit($openMode);
		return $decryptedText;
		
	}
	//*********** Padding Function *********************

	public  function pkcs5_pad ($plainText, $blockSize)
	{
	    $pad = $blockSize - (strlen($plainText) % $blockSize);
	    return $plainText . str_repeat(chr($pad), $pad);
	}

	//********** Hexadecimal to Binary function for php 4.0 version ********

	public function hextobin($hexString) 
   	 { 
        	$length = strlen($hexString); 
        	$binString="";   
        	$count=0; 
        	while($count<$length) 
        	{       
        	    $subString =substr($hexString,$count,2);           
        	    $packedString = pack("H*",$subString); 
        	    if ($count==0)
		    {
				$binString=$packedString;
		    } 
        	    
		    else 
		    {
				$binString.=$packedString;
		    } 
        	    
		    $count+=2; 
        	} 
  	        return $binString; 
    	  }
}
 
?>