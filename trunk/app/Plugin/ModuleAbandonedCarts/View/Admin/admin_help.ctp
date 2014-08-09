<?php
/* -----------------------------------------------------------------------------------------
   VamShop - http://vamshop.com
   -----------------------------------------------------------------------------------------
   Copyright (c) 2014 VamSoft Ltd.
   License - http://vamshop.com/license.html
   ---------------------------------------------------------------------------------------*/

?>
<?php echo $this->Admin->ShowPageHeaderStart($title_for_layout, 'cus-help'); ?>
<h3><?php echo __('What does this do?'); ?></h3>
<p><?php echo __('The Abandoned Carts module allows you to view the contents of customer\'s carts who did not complete checkout.'); ?></p>
<h3><?php echo __('How do I use this?'); ?></h3>
<p><?php echo __('Simply navigate to Orders -> Abandoned Carts to use this module.'); ?></p>
<?php echo $this->Admin->linkButton(__('Back'), '/modules/admin/', 'cus-arrow-turn-left', array('escape' => false, 'class' => 'btn')); ?>
<?php echo $this->Admin->ShowPageHeaderEnd(); ?>