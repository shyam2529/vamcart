<?php
/* -----------------------------------------------------------------------------------------
   VamCart - http://vamcart.com
   -----------------------------------------------------------------------------------------
   Copyright (c) 2011 VamSoft Ltd.
   License - http://vamcart.com/license.html
   ---------------------------------------------------------------------------------------*/
?>
<?php
echo $admin->ShowPageHeaderStart($current_crumb, 'install.png');
?>
<p><?php __('Welcome to the VamCart installation.') ?></p>
<p><?php __('Installing version:') ?> <?php echo $version; ?></p>

<?php

$html->script(array(
	'modified.js',
	'focus-first-input.js'
), array('inline' => false));

echo $this->requestAction(array('controller' => 'install', 'action' => 'check_permissions'), array('return'));

?>
<br />
<?php
echo $form->create('Install', array('id' => 'contentform', 'action' => '/install/create/', 'url' => '/install/create/'));
echo $form->input('db_host', array('label' => __('Host',true), 'value' => $values['Install']['db_host']));
echo $form->input('db_name', array('label' => __('Database Name',true), 'value' => $values['Install']['db_name']));
echo $form->input('db_username', array('label' => __('Database Username',true), 'value' => $values['Install']['db_username']));
echo $form->input('db_password', array('label' => __('Database Password',true), 'value' => $values['Install']['db_password']));

echo '<br />';		
		
echo $admin->formButtonCatalog(__('Submit', true), 'apply.png', array('type' => 'submit', 'name' => 'submit'));


echo '<div class="clear"></div>';
echo $form->end();

echo $admin->ShowPageHeaderEnd();

?>