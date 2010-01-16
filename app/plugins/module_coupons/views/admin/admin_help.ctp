<?php
/* -----------------------------------------------------------------------------------------
   VaM Cart
   http://vamcart.com
   http://vamcart.ru
   Copyright 2010 VaM Cart
   -----------------------------------------------------------------------------------------
   Portions Copyright:
   Copyright 2007 by Kevin Grandon (kevingrandon@hotmail.com)
   -----------------------------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------------------------*/

?>
<h3><?php echo __('What does this do?'); ?></h3>
<p><?php echo __('The coupons module allows you to create promotional discounts and coupons for your customers to use.'); ?></p>
<h3><?php echo __('How do I use this?'); ?></h3>
<p><?php echo __('Once installed there will be a new menu item under Content called Coupons. Here you can create coupons for your customers to use. They will be presented with a box during checkout to enter any promotional coupons they have.'); ?></p>
<h3><?php echo __('To use during checkout:'); ?></h3>
<p>{module alias='coupons' action='checkout_box'}</p>