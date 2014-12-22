<?php 
/* -----------------------------------------------------------------------------------------
   VamShop - http://vamshop.com
   -----------------------------------------------------------------------------------------
   Copyright (c) 2014 VamSoft Ltd.
   License - http://vamshop.com/license.html
   ---------------------------------------------------------------------------------------*/
App::uses('PaymentAppController', 'Payment.Controller');

class WebmoneyController extends PaymentAppController {
	public $uses = array('PaymentMethod', 'Order');
	public $module_name = 'Webmoney';
	public $icon = 'webmoney.png';

	public function settings ()
	{
		$this->set('data', $this->PaymentMethod->findByAlias($this->module_name));
	}

	public function install()
	{
		$new_module = array();
		$new_module['PaymentMethod']['active'] = '1';
		$new_module['PaymentMethod']['default'] = '0';
		$new_module['PaymentMethod']['name'] = Inflector::humanize($this->module_name);
		$new_module['PaymentMethod']['icon'] = $this->icon;
		$new_module['PaymentMethod']['alias'] = $this->module_name;

		$new_module['PaymentMethodValue'][0]['payment_method_id'] = $this->PaymentMethod->id;
		$new_module['PaymentMethodValue'][0]['key'] = 'webmoney_purse';
		$new_module['PaymentMethodValue'][0]['value'] = '';

		$new_module['PaymentMethodValue'][1]['payment_method_id'] = $this->PaymentMethod->id;
		$new_module['PaymentMethodValue'][1]['key'] = 'webmoney_secret_key';
		$new_module['PaymentMethodValue'][1]['value'] = '';

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

	public function before_process () 
	{
			
		$order = $this->Order->read(null,$_SESSION['Customer']['order_id']);
		
		$payment_method = $this->PaymentMethod->find('first', array('conditions' => array('alias' => $this->module_name)));

		$webmoney_settings = $this->PaymentMethod->PaymentMethodValue->find('first', array('conditions' => array('key' => 'webmoney_purse')));
		$webmoney_purse = $webmoney_settings['PaymentMethodValue']['value'];
		
		$content = '<form action="https://merchant.webmoney.ru/lmi/payment.asp" method="post">
			<input type="hidden" name="LMI_PAYMENT_NO" value="' . $_SESSION['Customer']['order_id'] . '">
			<input type="hidden" name="LMI_PAYEE_PURSE" value="'.$webmoney_purse.'">
			<input type="hidden" name="LMI_PAYMENT_DESC" value="' . $_SESSION['Customer']['order_id'] . ' ' . $order['Order']['email'] . '">
			<input type="hidden" name="LMI_PAYMENT_AMOUNT" value="' . $order['Order']['total'] . '">
			<input type="hidden" name="LMI_SIM_MODE" value="0">';
						
		$content .= '
			<button class="btn btn-default" type="submit" value="{lang}Process to Payment{/lang}"><i class="fa fa-check"></i> {lang}Process to Payment{/lang}</button>
			</form>';
	
	// Save the order
	
		foreach($_POST AS $key => $value)
			$order['Order'][$key] = $value;
		
		// Get the default order status
		$default_status = $this->Order->OrderStatus->find('first', array('conditions' => array('default' => '1')));
		$order['Order']['order_status_id'] = $default_status['OrderStatus']['id'];

		// Save the order
		$this->Order->save($order);

		return $content;
	}

	public function after_process()
	{
	}
	
	
	public function result()
	{
		$this->layout = false;
      $webmoney_data = $this->PaymentMethod->PaymentMethodValue->find('first', array('conditions' => array('key' => 'webmoney_secret_key')));
      $webmoney_secret_key = $webmoney_data['PaymentMethodValue']['value'];
		$order = $this->Order->read(null,$_POST['LMI_PAYMENT_NO']);
		$crc = $_POST['LMI_HASH'];
		$hash = strtoupper(md5($_POST['LMI_PAYEE_PURSE'].$_POST['LMI_PAYMENT_AMOUNT'].$_POST['LMI_PAYMENT_NO'].$_POST['LMI_MODE'].$_POST['LMI_SYS_INVS_NO'].$_POST['LMI_SYS_TRANS_NO'].$_POST['LMI_SYS_TRANS_DATE'].$webmoney_secret_key. 
$_POST['LMI_PAYER_PURSE'].$_POST['LMI_PAYER_WM']));
		$merchant_summ = number_format($_POST['LMI_PAYMENT_AMOUNT'], 2);
		$order_summ = number_format($order['Order']['total'], 2);

		if (($crc == $hash) && ($merchant_summ == $order_summ)) {
		
		$payment_method = $this->PaymentMethod->find('first', array('conditions' => array('alias' => $this->module_name)));
		$order_data = $this->Order->find('first', array('conditions' => array('Order.id' => $_POST['LMI_PAYMENT_NO'])));
		$order_data['Order']['order_status_id'] = $payment_method['PaymentMethod']['order_status_id'];
		
		$this->Order->save($order_data);
		
		}
	
	}
	
}

?>