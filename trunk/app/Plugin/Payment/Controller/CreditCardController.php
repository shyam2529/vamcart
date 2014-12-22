<?php 
/* -----------------------------------------------------------------------------------------
   VamShop - http://vamshop.com
   -----------------------------------------------------------------------------------------
   Copyright (c) 2014 VamSoft Ltd.
   License - http://vamshop.com/license.html
   ---------------------------------------------------------------------------------------*/
App::uses('PaymentAppController', 'Payment.Controller');

class CreditCardController extends PaymentAppController {
	public $uses = array('PaymentMethod', 'Order');
	public $module_name = 'CreditCard';
	public $icon = 'creditcard.png';

	public function settings ()
	{
	}

	public function display_fields ()
	{
	}

	public function install()
	{

		$new_module = array();
		$new_module['PaymentMethod']['active'] = '1';
		$new_module['PaymentMethod']['name'] = Inflector::humanize($this->module_name);
		$new_module['PaymentMethod']['icon'] = $this->icon;
		$new_module['PaymentMethod']['alias'] = $this->module_name;

		$this->PaymentMethod->saveAll($new_module);

		$this->Session->setFlash(__('Module Installed'));
		$this->redirect('/payment_methods/admin/');
	}

	public function uninstall()
	{

		$module_id = $this->PaymentMethod->findByAlias($this->module_name);

		$this->PaymentMethod->delete($module_id['PaymentMethod']['id'], true);
			
		$this->Session->setFlash(__('Module Uninstalled'));
		$this->redirect('/payment_methods/admin/');
	}

	public function process_payment ()
	{
		App::uses('CustomerBaseComponent', 'Controller/Component');	
		$this->CustomerBase = new CustomerBaseComponent(new ComponentCollection());
		
		$this->CustomerBase->save_customer_details($this->data['CreditCard']);
		
		$this->redirect('/orders/place_order/');
	}

	public function before_process () 
	{
	
		$content = '
		<form action="' . BASE . '/orders/place_order/" method="post">
		<button class="btn btn-default" type="submit" value="{lang}Confirm Order{/lang}"><i class="fa fa-check"></i> {lang}Confirm Order{/lang}</button>
		</form>';
		return $content;	
	}

	public function after_process()
	{
		$payment_method = $this->PaymentMethod->find('first', array('conditions' => array('alias' => $this->module_name)));
		$order_data = $this->Order->find('first', array('conditions' => array('Order.id' => $_SESSION['Customer']['order_id'])));
		if ($payment_method['PaymentMethod']['order_status_id'] > 0) {
		$order_data['Order']['order_status_id'] = $payment_method['PaymentMethod']['order_status_id'];
		
		$this->Order->save($order_data);
		}
	}

}

?>