<?php
/* -----------------------------------------------------------------------------------------
   VamShop - http://vamshop.com
   -----------------------------------------------------------------------------------------
   Copyright (c) 2014 VamSoft Ltd.
   License - http://vamshop.com/license.html
   ---------------------------------------------------------------------------------------*/

function default_template_account_edit()
{
$template = '
<script type="text/javascript" src="{base_path}/js/modified.js"></script>
<script type="text/javascript" src="{base_path}/js/focus-first-input.js"></script>
<script type="text/javascript" src="{base_path}/js/jquery/plugins/validate/jquery.validate.pack.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  // validate form
  $("#contentform").validate({
    rules: {
      "customer[name]": {
        required: true,
        minlength: 2      
     },
      "customer[email]": {
        required: true,
        minlength: 6,
        email: true      
     },
		"customer[password]": {
			required: true,
			minlength: 5,
		},
		"customer[retype]": {
			required: true,
			minlength: 5,
			equalTo: "#password"
		}
    },
    messages: {
      "customer[name]": {
        required: "{lang}Required field{/lang}",
        minlength: "{lang}Required field{/lang}. {lang}Min length{/lang}: 2"
      },
      "customer[email]": {
        required: "{lang}Required field{/lang}",
        minlength: "{lang}Required field{/lang}. {lang}Min length{/lang}: 6"
      },
      "customer[password]": {
        required: "{lang}Required field{/lang}",
        minlength: "{lang}Required field{/lang}. {lang}Min length{/lang}: 5"
      },
      "customer[retype]": {
        required: "{lang}Required field{/lang}",
        minlength: "{lang}Required field{/lang}. {lang}Min length{/lang}: 5"
      }
    }
  });
});
</script>
{foreach from=$errors item=error}
{if $error}
<div class="alert alert-danger"><i class="cus-error"></i> {$error}</div>
{/if}
{/foreach}
<form id="contentform" class="form-horizontal" name="account-edit" action="{base_path}/site/account_edit" method="post">
	<div class="form-group">
		<label class="control-label" for="name">{lang}Name{/lang}:</label>
		<div class="controls">
			<input id="name" name="customer[name]" type="text" value="{$form_data.Customer.name}" />
		</div>
	</div>
	<div class="form-group">
		<label class="control-label" for="email">{lang}E-mail{/lang}:</label>
		<div class="controls">
			<input id="email" name="customer[email]" type="text" value="{$form_data.Customer.email}" />
		</div>
	</div>
	<div class="form-group">
		<label class="control-label" for="password">{lang}New Password{/lang}:</label>
		<div class="controls">
			<input id="password" name="customer[password]" type="password" autocomplete="off" />
		</div>
	</div>
	<div class="form-group">
		<label class="control-label" for="retype">{lang}Retype Password{/lang}:</label>
		<div class="controls">
			<input id="retype" name="customer[retype]" type="password" autocomplete="off" />
		</div>
	</div>    
	<button class="btn btn-default" type="submit" value="{lang}Save{/lang}"><i class="fa fa-check"></i> {lang}Save{/lang}</button>
</form>
';

return $template;
}


function smarty_function_account_edit($params, $template)
{
	App::uses('SmartyComponent', 'Controller/Component');
	$Smarty = new SmartyComponent(new ComponentCollection());

	App::import('Model', 'Customer');
	$Customer = new Customer();

	$customer_data = $Customer->find('first', array('conditions' => array('Customer.id' => $_SESSION['Customer']['customer_id'])));

	$errors = array();

	if (isset($_SESSION['FormErrors'])) {
		foreach ($_SESSION['FormErrors'] as $key => $value) {
			$errors[] = $value[0];
		}
		unset($_SESSION['FormErrors']);
	}

	$display_template = $Smarty->load_template($params, 'account_edit');
	$assignments = array(
		'errors' => $errors,
		'form_data' => $customer_data,
	);

	$Smarty->display($display_template, $assignments);

}

function smarty_help_function_account_edit() {
	?>
	<h3><?php echo __('What does this tag do?') ?></h3>
	<p><?php echo __('Displays account edit page.') ?></p>
	<h3><?php echo __('How do I use it?') ?></h3>
	<p><?php echo __('Just insert the tag into your template like:') ?> <code>{account_edit}</code></p>
	<h3><?php echo __('What parameters does it take?') ?></h3>
	<ul>
		<li><em>(<?php echo __('None') ?>)</em></li>
	</ul>
	<?php
}

function smarty_about_function_account_edit() {
}
