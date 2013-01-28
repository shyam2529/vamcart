<?php
/* -----------------------------------------------------------------------------------------
   VamCart - http://vamcart.com
   -----------------------------------------------------------------------------------------
   Copyright (c) 2011 VamSoft Ltd.
   License - http://vamcart.com/license.html
   ---------------------------------------------------------------------------------------*/
App::uses('AppController', 'Controller');
class ContactUsController extends AppController {
	var $name = 'ContactUs';
	var $uses = null;
	var $components = array('Email', 'ConfigurationBase');

	function send_email ()
	{
		// Clean up the post
		uses('sanitize');
		$clean = new Sanitize();
		$clean->paranoid($_POST);
		
		$config = $this->ConfigurationBase->load_configuration();
		
		// Send to admin
		if($config['SEND_CONTACT_US_EMAIL'] != '')
		{
		
		// Set up mail
		$this->Email->init();
		$this->Email->From = $_POST['email'];
		$this->Email->FromName = $_POST['name'];
		$this->Email->AddAddress($config['SEND_CONTACT_US_EMAIL']);
		$this->Email->Subject = $config['SITE_NAME'] . ' - ' . __('Contact Us' ,true);

		// Email Body
		$this->Email->Body = $_POST['message'];
		
		// Sending mail
		$this->Email->send();
		
		}

		$this->redirect('/');
	}
	

}
?>