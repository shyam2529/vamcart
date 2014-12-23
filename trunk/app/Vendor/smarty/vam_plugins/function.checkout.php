<?php
/* -----------------------------------------------------------------------------------------
   VamShop - http://vamshop.com
   -----------------------------------------------------------------------------------------
   Copyright (c) 2014 VamSoft Ltd.
   License - http://vamshop.com/license.html
   ---------------------------------------------------------------------------------------*/

function default_template_checkout ()
{
$template = '
<script type="text/javascript" src="{base_path}/js/modified.js"></script>
<script type="text/javascript" src="{base_path}/js/focus-first-input.js"></script>
<script type="text/javascript" src="{base_path}/js/jquery/plugins/validate/jquery.validate.pack.js"></script>
<script type="text/javascript" src="{base_path}/js/jquery/plugins/maskedinput/jquery.maskedinput.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	
$("#phone").mask("(999) 999-9999");
      	
$("label.shipping-method").click(function(){
$("label.shipping-method").parent().removeClass("selected");
$(this).parent().addClass("selected");
});

$("label.payment-method").click(function(){
$("label.payment-method").parent().removeClass("selected");
$(this).parent().addClass("selected");
});
	
  // validate form
  $("#contentform").validate({
    rules: {
      bill_name: {
        required: true,
        minlength: 2      
     },
      email: {
        required: true,
        minlength: 6,
        email: true      
     },
      phone: {
        required: true,
        minlength: 10,
     },
    },
    messages: {
      bill_name: {
        required: "{lang}Required field{/lang}",
        minlength: "{lang}Required field{/lang}. {lang}Min length{/lang}: 2"
      },
      email: {
        required: "{lang}Required field{/lang}",
        minlength: "{lang}Required field{/lang}. {lang}Min length{/lang}: 6"
      },
      phone: {
        required: "{lang}Required field{/lang}",
        minlength: "{lang}Required field{/lang}. {lang}Min length{/lang}: 10"
      }
    }
  });
});
</script>
<script type="text/javascript">
  $(document).ready(function() {
	$(hidePay);		
		function hidePay()	{
		if ($("#diff_shipping").is(":checked") == "1")
			{
		$("#diff_shipping").attr("checked", true);
		}
		else
		{
		$("#diff_shipping").attr("checked", false);
		$("#ship_information").css("display","none");
		}
		
	
		$("#diff_shipping").click(function(){
	// If checked
	        if ($("#diff_shipping").is(":checked"))
			{
	            //show the hidden div
	            $("#ship_information").show("fast");
	        }
			else
			{
			$("#ship_information").hide("fast");
			}
		});
		;}

    $("#bill_country").change(function () {
      $("#bill_state_div").load(\'{base_path}/countries/billing_regions/\' + $(this).val());
    });
    $("#ship_country").change(function () {
      $("#ship_state_div").load(\'{base_path}/countries/shipping_regions/\' + $(this).val());
    });
  });
</script>
<div id="checkout">
<form action="{$checkout_form_action}" method="post" id="contentform" class="form-horizontal">

  <div id="bill_information">
    <div>
      <h3>{lang}Billing Information{/lang}</h3>
    </div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="bill_name">{lang}Name{/lang}:</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" name="bill_name" id="bill_name" value="{if $customer.AddressBook.ship_name}{$customer.AddressBook.ship_name}{else}{$order.bill_name}{/if}"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="bill_line_1">{lang}Address Line 1{/lang}:</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" name="bill_line_1" id="bill_line_1" value="{if $customer.AddressBook.ship_line_1}{$customer.AddressBook.ship_line_1}{else}{$order.bill_line_1}{/if}" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="bill_line_2">{lang}Address Line 2{/lang}:</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" name="bill_line_2" id="bill_line_2" value="{if $customer.AddressBook.ship_line_2}{$customer.AddressBook.ship_line_2}{else}{$order.bill_line_2}{/if}" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="bill_city">{lang}City{/lang}:</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" name="bill_city" id="bill_city" value="{if $customer.AddressBook.ship_city}{$customer.AddressBook.ship_city}{else}{$order.bill_city}{/if}" />
		</div>
	</div>    
	<div class="form-group">
		<label class="col-sm-3 control-label" for="bill_country">{lang}Country{/lang}:</label>
		<div class="col-sm-9">
			<select name="bill_country" class="form-control" id="bill_country">{if $customer.AddressBook.ship_country}{country_list selected={$customer.AddressBook.ship_country}}{else}{country_list}{/if}</select>
		</div>
	</div>
	<div class="form-group">
	<div id="bill_state_div">
		<label class="col-sm-3 control-label" for="bill_state">{lang}State{/lang}:</label>
		<div class="col-sm-9">
			<select name="bill_state" class="form-control" id="bill_state">{if $customer.AddressBook.ship_state}{state_list country={$customer.AddressBook.ship_country} selected={$customer.AddressBook.ship_state}}{else}{state_list}{/if}</select>
		</div>
	</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="bill_zip">{lang}Zipcode{/lang}:</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" name="bill_zip" id="bill_zip" value="{if $customer.AddressBook.ship_zip}{$customer.AddressBook.ship_zip}{else}{$order.bill_zip}{/if}" />
		</div>
	</div>    
  </div>    

  <div id="diff_ship">
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox" name="diff_shipping" id="diff_shipping" /> {lang}My delivery and billing addresses are not the same.{/lang}
        </label>
      </div>
    </div>
  </div>
  </div>

  <div id="ship_information">
    <div>
      <h3>{lang}Shipping Information{/lang}</h3>
    </div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="ship_name">{lang}Name{/lang}:</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" name="ship_name" id="ship_name" value="{$order.ship_name}" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="ship_line_1">{lang}Address Line 1{/lang}:</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" name="ship_line_1" id="ship_line_1" value="{$order.ship_line_1}" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="ship_line_2">{lang}Address Line 2{/lang}:</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" name="ship_line_2" id="ship_line_2" value="{$order.ship_line_2}" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="ship_city">{lang}City{/lang}:</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" name="ship_city" id="ship_city" value="{$order.ship_city}" />
		</div>
	</div>    
	<div class="form-group">
		<label class="col-sm-3 control-label" for="ship_country">{lang}Country{/lang}:</label>
		<div class="col-sm-9">
			<select name="ship_country" class="form-control" id="ship_country">{country_list}</select>
		</div>
	</div>
	<div class="form-group">
	<div id="ship_state_div">
		<label class="col-sm-3 control-label" for="ship_state">{lang}State{/lang}:</label>
		<div class="col-sm-9">
			<select name="ship_state" class="form-control" id="ship_state">{state_list}</select>
		</div>
	</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="ship_zip">{lang}Zipcode{/lang}:</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" name="ship_zip" id="ship_zip" value="{$order.ship_zip}" />
		</div>
	</div>    
  </div>
  <div id="contact_information">
    <div>
      <h3>{lang}Contact Information{/lang}</h3>
    </div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="email">{lang}E-mail{/lang}:</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" name="email" id="email" value="{if $customer.Customer.email}{$customer.Customer.email}{else}{$order.email}{/if}" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="phone">{lang}Phone{/lang}:</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" name="phone" id="phone" value="{if $customer.AddressBook.phone}{$customer.AddressBook.phone}{else}{$order.phone}{/if}" />
		</div>
	</div>
  </div>
  {module alias="coupons" action="checkout_box"}
  <div id="shipping_method">
    <div>
      <h3>{lang}Shipping Method{/lang}</h3>
    </div>  
	<div class="row">
	<ul class="shipping-methods">
    {foreach from=$ship_methods item=ship_method}
		<li class="item col-sm-6 col-md-4{if $ship_method.id == $order.shipping_method_id} selected{/if}">
      <label class="shipping-method">
      <span class="title">
        <input type="radio" name="shipping_method_id" value="{$ship_method.id}" id="ship_{$ship_method.id}" 
        {if $ship_method.id == $order.shipping_method_id}
          checked="checked"
         {/if}
        />
		<span class="name">{lang}{$ship_method.name}{/lang}</span>
		</span>
		<span class="image text-center">
				{if $ship_method.icon}<img src="{base_path}/img/icons/shipping/{$ship_method.icon}" alt="{$ship_method.name}" title="{$ship_method.name}" /> {/if}
		</span>
		{if $ship_method.cost_plain > 0}<span class="description">{$ship_method.cost}</span>{/if}
		{if $ship_method.description}<span class="description">{$ship_method.description}</span>{/if}
		</label>	
		</li>
    {/foreach}
	</ul>	</div>
		
  </div>
  <div id="payment_method">
    <div>
      <h3>{lang}Payment Method{/lang}</h3>
    </div>    

	<div class="row">
	<ul class="payment-methods">
    {foreach from=$payment_methods item=payment_method}
		<li class="item col-sm-6 col-md-4{if $payment_method.id == $order.payment_method_id} selected{/if}">
      <label class="payment-method">
      <span class="title">
        <input type="radio" name="payment_method_id" value="{$payment_method.id}" id="payment_{$payment_method.id}" 
        {if $payment_method.id == $order.payment_method_id}
          checked="checked"
         {/if}        
        />
		<span class="name">{lang}{$payment_method.name}{/lang}</span>
		</span>
		<span class="image text-center">
				{if $payment_method.icon}<img class="text-center" src="{base_path}/img/icons/payment/{$payment_method.icon}" alt="{$payment_method.name}" title="{$payment_method.name}" /> {/if}
		</span>
		{if $payment_method.description}<span class="description">{$payment_method.description}</span>{/if}
		</label>	
		</li>
    {/foreach}
	</ul>	</div>
	    
  </div>

  <button class="btn btn-default" type="submit" value="{lang}Continue{/lang}"><i class="fa fa-check"></i> {lang}Continue{/lang}</button>
</form>
</div>
';		

return $template;
}


function smarty_function_checkout($params, $template)
{

	global $config;

	/*
	 *  Load some necessary models
	 **/	
	App::uses('SmartyComponent', 'Controller/Component');
		$Smarty = new SmartyComponent(new ComponentCollection());

	App::uses('CurrencyBaseComponent', 'Controller/Component');
		$CurrencyBase = new CurrencyBaseComponent(new ComponentCollection());		
	
	App::import('Model', 'Order');
		$Order = new Order();
		
	App::import('Model', 'ShippingMethod');
		$ShippingMethod = new ShippingMethod();

	App::import('Model', 'PaymentMethod');
		$PaymentMethod = new PaymentMethod();

	// Assign the shipping methods
	$assignments = array();
	$active_ship_methods = $ShippingMethod->find('all', array('conditions' => array('active' => '1'),'order' => array('order')));

	$keyed_ship_methods = array();
	foreach($active_ship_methods AS $method)
	{
		$shipping = Inflector::classify($method['ShippingMethod']['code']);
		$shipping_controller =  Inflector::classify($method['ShippingMethod']['code']) . 'Controller';
		App::import('Controller', 'Shipping.'.$shipping);
		$MethodBase = new $shipping_controller();
		
		$ship_method_id = $method['ShippingMethod']['id'];
		
		$keyed_ship_methods[$ship_method_id] = array(
										  'id' => $ship_method_id,
										  'name' => $method['ShippingMethod']['name'],
										  'description' => (isset($method['ShippingMethod']['description'])) ? $method['ShippingMethod']['description'] : false,
										  'icon' => (isset($method['ShippingMethod']['icon']) && file_exists(IMAGES . 'icons/shipping/' . $method['ShippingMethod']['icon'])) ? $method['ShippingMethod']['icon'] : false,
										  'cost_plain' => $MethodBase->calculate(),
										  'cost' => $CurrencyBase->display_price($MethodBase->calculate())
										  );

	}	
	
	// Assign the payment methods
	$active_payment_methods = $PaymentMethod->find('all', array('conditions' => array('active' => '1'),'order' => array('order')));

	$keyed_payment_methods = array();
	foreach($active_payment_methods AS $method)
	{
		$payment_method_id = $method['PaymentMethod']['id'];

		$keyed_payment_methods[$payment_method_id] = array(
										  'id' => $payment_method_id,
										  'name' => $method['PaymentMethod']['name'],
										  'description' => (isset($method['PaymentMethod']['description'])) ? $method['PaymentMethod']['description'] : false,
										  'icon' => (isset($method['PaymentMethod']['icon']) && file_exists(IMAGES . 'icons/payment/' . $method['PaymentMethod']['icon'])) ? $method['PaymentMethod']['icon'] : false
										  );

	}			
		
	// Assign the current order
	$Order->unbindAll();
	$order = $Order->find('first', array('conditions' => array('Order.id' => $_SESSION['Customer']['order_id'])));

	App::import('Model', 'Customer');
	$Customer = new Customer();
		
	$customer = false;
			
	if (isset($_SESSION['Customer']['customer_id'])) {
		$customer = $Customer->find('first', array('conditions' => array('Customer.id' => $_SESSION['Customer']['customer_id'])));
	}
	
	global $config;

	$assignments = array(
		'ship_methods' => $keyed_ship_methods,
		'payment_methods' => $keyed_payment_methods,
		'order' => $order['Order'],
		'customer' => $customer,
		'checkout_form_action' => BASE . '/orders/confirmation/'
	);
	
	$display_template = $Smarty->load_template($params,'checkout');
	$Smarty->display($display_template,$assignments);
	
}

function smarty_help_function_checkout() {
	?>
	<h3><?php echo __('What does this tag do?') ?></h3>
	<p><?php echo __('This plugin handles the entire checkout process.') ?></p>
	<h3><?php echo __('How do I use it?') ?></h3>
	<p><?php echo __('Just insert the tag into your template/page like:') ?> <code>{checkout}</code></p>
	<h3><?php echo __('What parameters does it take?') ?></h3>
	<ul>
		<li><em><?php echo __('(template)') ?></em> - <?php echo __('Useful if you want to override the default content listing template. Setting this will utilize the template that matches this alias.') ?></li>
	</ul>
	<?php
}

function smarty_about_function_checkout() {
}
?>