<?php 
/* -----------------------------------------------------------------------------------------
   VaM Shop
   http://vamshop.com
   http://vamshop.ru
   Copyright 2009 VaM Shop
   -----------------------------------------------------------------------------------------
   Portions Copyright:
   Copyright 2007 by Kevin Grandon (kevingrandon@hotmail.com)
   -----------------------------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------------------------*/

class GoogleHtmlController extends PaymentAppController {
	var $uses = array('PaymentMethod');
	var $components = array('OrderBase');

	function settings ()
	{
		$this->set('data', $this->PaymentMethod->find(array('alias' => 'google_html')));
	}

	function install()
	{

		$new_module = array();
		$new_module['PaymentMethod']['active'] = '1';
		$new_module['PaymentMethod']['name'] = 'Google Html';
		$new_module['PaymentMethod']['alias'] = 'google_html';
		$this->PaymentMethod->save($new_module);

		$new_module_values = array();
		$new_module_values['PaymentMethodValue']['payment_method_id'] = $this->PaymentMethod->id;
		$new_module_values['PaymentMethodValue']['key'] = 'google_html_merchant_id';
		$new_module_values['PaymentMethodValue']['value'] = 'your-google-merchant-id';

		$this->PaymentMethod->PaymentMethodValue->save($new_module_values);
			
		$this->Session->setFlash(__('Module Installed', true));
		$this->redirect('/payment_methods/admin/');
	}

	function uninstall()
	{

		$module_id = $this->PaymentMethod->findByAlias('google_html');

		$this->PaymentMethod->del($module_id['PaymentMethod']['id'], true);
			
		$this->Session->setFlash(__('Module Uninstalled', true));
		$this->redirect('/payment_methods/admin/');
	}

	function before_process () 
	{
		global $order;
		
		App::import('Model', 'PaymentMethod');
		$this->PaymentMethod =& new PaymentMethod();
		
		$google_merchant_id = $this->PaymentMethod->PaymentMethodValue->find(array('key' => 'google_html_merchant_id'));
		$merchant_id = $google_merchant_id['PaymentMethodValue']['value'];
		
		
		$return_url = $_SERVER['HTTP_HOST'] .'/orders/place_order/';
		$cancel_url = $_SERVER['HTTP_HOST'];
		
		$content = '<form method="POST" action="https://sandbox.google.com/checkout/cws/v2/Merchant/' . $merchant_id . '/checkout">';
		
		$product_count = 1;
		foreach($order['OrderProduct'] AS $product)
		{
			$content .= '<input type="hidden" name="item_name_' . $product_count . '" value="' . $product['name'] . '">
						 <input type="hidden" name="item_quantity_' . $product_count . '" value="' . $product['quantity'] . '">
						 <input type="hidden" name="item_price_' . $product_count . '" value="' . $product['price'] . '">';

			++$product_count;
		}
		$content .= '
						<input type="hidden" name="ship_method_name" value="' . $order['ShippingMethod']['name'] . '">
						<input type="hidden" name="ship_method_price" value="' . $order['Order']['shipping'] . '">
					';		
						
		$content .= '
			    <input type="image" name="Google Checkout" alt="Fast checkout through Google"
        		src="http://sandbox.google.com/checkout/buttons/checkout.gif?merchant_id=' . $merchant_id . '
             	&w=180&h=46&style=white&variant=text&loc=en_US"  height="46" width="180">
			</form>';
		return $content;
	}
}

?>