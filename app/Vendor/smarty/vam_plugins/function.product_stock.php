<?php
/* -----------------------------------------------------------------------------------------
   VamShop - http://vamshop.com
   -----------------------------------------------------------------------------------------
   Copyright (c) 2014 VamSoft Ltd.
   License - http://vamshop.com/license.html
   ---------------------------------------------------------------------------------------*/

function smarty_function_product_stock($params, $template)
{
	global $content;

	$content_type = 'ContentProduct';
	if ($content['Content']['content_type_id'] == 7) $content_type = 'ContentDownloadable';
	
	$stock = $content[$content_type]['stock'];

	if ($stock > 0) {
	echo $stock;
	}
	
}

function smarty_help_function_product_stock () {
	?>
	<h3><?php echo __('What does this tag do?') ?></h3>
	<p><?php echo __('Displays the product stock quantity for the current content.') ?></p>
	<h3><?php echo __('How do I use it?') ?></h3>
	<p><?php echo __('Just insert the tag into your template like:') ?> <code>{product_stock}</code></p>
	<h3><?php echo __('What parameters does it take?') ?></h3>
	<ul>
		<li><em>(<?php echo __('None') ?>)</em></li>
	</ul>
	<?php
}

function smarty_about_function_product_stock () {
}
?>