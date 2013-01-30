<?php
/* -----------------------------------------------------------------------------------------
   VamCart - http://vamcart.com
   -----------------------------------------------------------------------------------------
   Copyright (c) 2011 VamSoft Ltd.
   License - http://vamcart.com/license.html
   ---------------------------------------------------------------------------------------*/

echo '<p>' .__('Table based shipping can be set to work off of number of products in cart, weight of products, or total price of products. In the textarea below specify value to cost pairs with a colon followed by a comma. Example: 0:1.00,1:2.50,2:3.00. Units of measure must be integers.', true) . '</p>';

$types = array('weight' => __('Weight', true),
			   'total' => __('Total', true),
			   'products' => __('Products', true));

echo $form->inputs(array(
	'legend' => null,
	'key_values.table_based_type' => array(
		'type' => 'select',
		'selected' => $data['ShippingMethodValue'][0]['value'],
		'label' => __('Based Off',true),
		'options' => $types
	),
	'key_values.table_based_rates' => array(
		'type' => 'textarea',
		'class' => 'pagesmalltextarea',
		'label' => __('Rates',true),
		'type' => 'text',
		'value' => $data['ShippingMethodValue'][1]['value']
	)
	
));

?>