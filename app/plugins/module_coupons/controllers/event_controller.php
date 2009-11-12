<?php 
/* -----------------------------------------------------------------------------------------
   VaM Cart
   http://vamcart.com
   http://vamcart.ru
   Copyright 2009 VaM Cart
   -----------------------------------------------------------------------------------------
   Portions Copyright:
   Copyright 2007 by Kevin Grandon (kevingrandon@hotmail.com)
   -----------------------------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------------------------*/

class EventController extends ModuleCouponsAppController {
	var $uses = null;
	
	function utilize_coupon()
	{
		global $order;
				
		if(empty($_POST['module_coupon_code']))
			return;
		
		App::import('Model', 'ModuleCoupons.ModuleCoupon');
		$this->ModuleCoupon =& new ModuleCoupon();			
		
		$coupon = $this->ModuleCoupon->find(array('code' => $_POST['module_coupon_code']));
		// Check restrictions
		if(count($order['OrderProduct']) < $coupon['ModuleCoupon']['min_product_count'])
			$invalid_msg = __('Not enough products in cart for coupon. Requires: ', true) . $coupon['ModuleCoupon']['min_product_count'] . __(' products.', true);
		elseif(count($order['OrderProduct']) > $coupon['ModuleCoupon']['max_product_count'])
			$invalid_msg = __('Too many products in cart for coupon. Requires less than: ', true) . $coupon['ModuleCoupon']['min_product_count'] . __(' products.', true);
		elseif($order['Order']['total'] < $coupon['ModuleCoupon']['min_order_total'])
			$invalid_msg = __('Order total not enough. Requires at least: ', true) . $coupon['ModuleCoupon']['min_order_total'] . '.';	
		elseif($order['Order']['total'] > $coupon['ModuleCoupon']['max_order_total'])
			$invalid_msg = __('Order total too high. Requires less than: ', true) . $coupon['ModuleCoupon']['min_order_total'] . '.';				
	
		if(isset($invalid_msg))
		{
			echo '<div class="error">' . $invalid_msg . '</div>';
			return;
		}
	
		// Take off the discounts
		$discount = 0;	
		if($coupon['ModuleCoupon']['percent_off_total'] > 0)
			$discount = $discount - (($coupon['ModuleCoupon']['percent_off_total']/100)*$order['Order']['total']);
		if($coupon['ModuleCoupon']['amount_off_total'] > 0)
			$discount = $discount - $coupon['ModuleCoupon']['amount_off_total'];
		if($coupon['ModuleCoupon']['free_shipping'] == 1)
			$discount = $discount - $order['Order']['shipping'];
		
		$coupon_product = array();
		$coupon_product['OrderProduct']['order_id'] = $order['Order']['id'];
		$coupon_product['OrderProduct']['order_id'] = $order['Order']['id'];
		$coupon_product['OrderProduct']['name'] = 'Coupon: ' . $coupon['ModuleCoupon']['name'] . ' - ' . $coupon['ModuleCoupon']['code'];
		$coupon_product['OrderProduct']['quantity'] = 1;
		$coupon_product['OrderProduct']['price'] = $discount;	

		// Get the content_id for the new product
		App::import('Model', 'Content');
		$this->Content =& new Content();
		$content_page = $this->Content->findByAlias('coupon-details');
		$coupon_product['OrderProduct']['content_id'] = $content_page['Content']['id'];
	
		// Load the OrderProduct model for saving and error checking
		App::import('Model', 'OrderProduct');
		$this->OrderProduct =& new OrderProduct();
		
		// Make sure this coupon isn't already in our 'cart'	
		$coupon_count = $this->OrderProduct->findCount(array('order_id' => $order['Order']['id'], 'name' => $coupon_product['OrderProduct']['name']));
		if($coupon_count > 0)
		{
			echo '<div class="error">'.__('Error: Coupon already used.', true).'</div>';
			return;
		}
		
		// Save the new coupon as an order product
		$this->OrderProduct->save($coupon_product);
		
		// Save the new order totals
		App::import('Component', 'Order');
		$this->Order =& new Order();
		
		$order = $this->Order->read(null,$_SESSION['Customer']['order_id']);
		$order['Order']['total'] = 	$order['Order']['total'] + $discount;

		$this->Order->save($order);
	}
	
}

?>