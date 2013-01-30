<?php
/* -----------------------------------------------------------------------------------------
   VamCart - http://vamcart.com
   -----------------------------------------------------------------------------------------
   Copyright (c) 2011 VamSoft Ltd.
   License - http://vamcart.com/license.html
   ---------------------------------------------------------------------------------------*/

$html->script(array(
	'selectall.js'
), array('inline' => false));

echo $admin->ShowPageHeaderStart($current_crumb, 'currencies.png');

echo $form->create('Discount', array('action' => '/discounts/admin_modify_selected/', 'url' => '/discounts/admin_modify_selected/'));

echo '<table class="contentTable">';

echo $html->tableHeaders(array( __('Quantity', true), __('Price', true), __('Action', true), '<input type="checkbox" onclick="checkAll(this)" />'));

foreach ($discount_data AS $discount)
{
	echo $admin->TableCells(
		  array(
				$discount['ContentProductPrice']['quantity'],
                                array($discount['ContentProductPrice']['price'], array('align'=>'center')),
                                array($admin->ActionButton('edit','/discounts/admin_edit/'. $content_product_id . '/' . $discount['ContentProductPrice']['id'],__('Edit', true)) . $admin->ActionButton('delete','/discounts/admin_delete/' . $content_product_id . '/' . $discount['ContentProductPrice']['id'],__('Delete', true)), array('align'=>'center')),
                                array($form->checkbox('modify][', array('value' => $discount['ContentProductPrice']['id'])), array('align'=>'center'))
		   ));
}

echo '</table>';

echo $admin->ActionBar(array('delete'=>__('Delete',true)), true, $content_product_id);

echo $admin->ShowPageHeaderEnd();

?>