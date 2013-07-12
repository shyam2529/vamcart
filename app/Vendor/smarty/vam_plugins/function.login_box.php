<?php
/* -----------------------------------------------------------------------------------------
   VamCart - http://vamcart.com
   -----------------------------------------------------------------------------------------
   Copyright (c) 2011 VamSoft Ltd.
   License - http://vamcart.com/license.html
   ---------------------------------------------------------------------------------------*/

function default_template_login_box()
{
$template = '
<div class="box">
<h5>&nbsp;{lang}Login{/lang}</h5>
<div class="boxContent">
{if not $is_logged_in }
<form action="{base_path}/site/login?return_url={$return_url}" method="post">
<label>{lang}E-mail{/lang}</label>
<input type="text" name="data[Customer][email]" />
<br />
<label>{lang}Password{/lang}</label>
<input type="password" name="data[Customer][password]" />
<br />
<button class="btn" type="submit" value="{lang}Login{/lang}"><i class="cus-tick"></i> {lang}Login{/lang}</button>
</form>
<br />
  <a href="{base_path}/customer/register.html">{lang}Registration{/lang}</a>
{else}
<ul>
  <li><a href="{base_path}/customer/account.html">{lang}My Account{/lang}</a></li>
</ul>
<form action="{base_path}/site/logout?return_url={$return_url}" method="post">
<button class="btn" type="submit" value="{lang}Logout{/lang}"><i class="cus-tick"></i> {lang}Logout{/lang}</button>
</form>
{/if}
</div>
</div>
';

return $template;
}

function smarty_function_login_box($params, $template)
{
	App::uses('SmartyComponent', 'Controller/Component');
	$Smarty =& new SmartyComponent(new ComponentCollection());

	if (isset($_SESSION['Customer']['customer_id'])) {
		$isLoggedIn = true;
	} else {
		$isLoggedIn = false;
	}

	global $Dispatcher;

	$vars = array(
		'login_form_action' => BASE . '/site/login/',
		'is_logged_in' => $isLoggedIn,
//		'return_url' => base64_encode(urlencode($Dispatcher->here)),
		'return_url' => '',
	);

	$display_template = $Smarty->load_template($params, 'login_box');
	$Smarty->display($display_template, $vars);
}

function smarty_help_function_login_box() {
	?>
	<h3><?php echo __('What does this tag do?') ?></h3>
	<p><?php echo __('Allows the user to login.') ?></p>
	<h3><?php echo __('How do I use it?') ?></h3>
	<p><?php echo __('Just insert the tag into your template like:') ?> <code>{login_box}</code></p>
	<h3><?php echo __('What parameters does it take?') ?></h3>
	<ul>
		<li><em><?php echo __('(template)') ?></em> - <?php echo __('Useful if you want to override the default content listing template. Setting this will utilize the template that matches this alias.') ?></li>
	</ul>
	<?php
}

function smarty_about_function_login_box() {
}
?>