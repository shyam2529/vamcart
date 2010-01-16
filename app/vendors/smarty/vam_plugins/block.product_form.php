<?php
/* -----------------------------------------------------------------------------------------
   VaM Cart
   http://vamcart.ru
   http://vamcart.com
   Copyright 2010 VaM Cart
   -----------------------------------------------------------------------------------------
   Portions Copyright:
   Copyright 2007 by Kevin Grandon (kevingrandon@hotmail.com)
   -----------------------------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------------------------*/

function smarty_block_product_form($params, $product_form, &$smarty)
{
	
    if (is_null($product_form)) 
	{
        return;
    }
	
	global $content;
	
	$output = '<form method="post" action="' . BASE . '/cart/purchase_product/">
				<input type="hidden" name="product_id" value="' . $content['Content']['id'] . '">';
	$output .= $product_form;		
	$output .= '</form>';
		
	echo $output;
}

function smarty_help_function_product_form() {
	?>
	<h3><?php echo __('What does this tag do?') ?></h3>
	<p><?php echo __('Wraps the product purchase button with a form.') ?></p>
	<h3><?php echo __('How do I use it?') ?></h3>
	<p><?php echo __('Just wrap your product purchase with:') ?> <code>{product_form}<?php echo __('stuff') ?>{/product_form}</code></p>
	<?php
}

function smarty_about_function_product_form() {
	?>
	<p><?php echo __('Author: Kevin Grandon &lt;kevingrandon@hotmail.com&gt;') ?></p>
	<p><?php echo __('Version:') ?> 0.1</p>
	<p>
	<?php echo __('Change History:') ?><br/>
	<?php echo __('None') ?>
	</p>
	<?php
}
?>