<?php
header('Content-Type: text/html; charset=utf-8'); 
/* -----------------------------------------------------------------------------------------
   VamCart - http://vamcart.com
   -----------------------------------------------------------------------------------------
   Copyright (c) 2011 VamSoft Ltd.
   License - http://vamcart.com/license.html
   ---------------------------------------------------------------------------------------*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php echo $html->charset(); ?>
<title><?php echo $title_for_layout; ?></title>
<?php echo $html->css('admin', null, array('inline' => false)); ?>
<?php echo $html->script(array('jquery/jquery.min.js'), array('inline' => false)); ?>
<?php echo $asset->scripts_for_layout(); ?>
</head>

<body>
<!-- Container -->
<div id="container">

<!-- Header -->
<div id="header">
<div class="header-left">
<?php echo $html->link($html->image('admin/logo.png', array('alt' => __('VamCart',true))), '/admin/admin_top/', array('escape'=>false));?>
</div>
<div class="header-right">
<?php 
echo $form->create('Search', array('action' => '/search/admin_global_search/', 'url' => '/search/admin_global_search/'));
echo $form->input('Search.term',array('label' => __('Search',true),'value' => __('Global Record Search',true),"onblur" => "if(this.value=='') this.value=this.defaultValue;","onfocus" => "if(this.value==this.defaultValue) this.value='';"));
echo $form->submit( __('Submit', true));
echo $form->end();
?>
<?php echo $admin->getHelpPage(); ?>
</div>
<div class="clear"></div>
</div>
<!-- /Header -->

<div id="menu">
<?php echo $admin->DrawMenu($navigation); ?>
</div>
 
<!-- Navigation -->
<div id="navigation">
<?php
if(isset($current_crumb)) { 
?>
<div class="breadCrumbs">
<?php
echo $admin->GenerateBreadcrumbs($navigation, $current_crumb);
?>
</div>
<?php
} 
?>
</div>
<!-- /Navigation -->

<!-- Content -->
<div id="wrapper">
<div id="content">

<?php if($session->check('Message.flash')) echo $session->flash(); ?>

<?php echo $content_for_layout; ?>

</div>
</div>
<!-- /Content -->

<!-- Left column -->
<div id="left">
</div>
<!-- /Left column -->

<!-- Right column -->
<div id="right">
</div>
<!-- /Right column -->

<!-- Footer -->
<div id="footer">
<p>
<a href="http://vamcart.com/"><?php __('PHP Shopping Cart') ?></a> <a href="http://vamcart.com/"><?php __('VamCart') ?></a>
</p>
</div>
<!-- /Footer -->

</div>
<!-- /Container -->

</body>
</html>