<?php
/* -----------------------------------------------------------------------------------------
   VamCart - http://vamcart.com
   -----------------------------------------------------------------------------------------
   Copyright (c) 2011 VamSoft Ltd.
   License - http://vamcart.com/license.html
   ---------------------------------------------------------------------------------------*/

	echo $html->script('modified', array('inline' => false));
	
	echo $admin->ShowPageHeaderStart($current_crumb, 'attach_templates.png');
        
 __('Stylesheet');  echo ': ' . $html->link($stylesheet['Stylesheet']['name'],'/stylesheets/admin_edit/' . $stylesheet['Stylesheet']['id']); ?>

<table class="contentTable">

<?php
//pr($stylesheet['Template']);die();
$attached_template = $stylesheet['Template'];

echo $html->tableHeaders(array( __('Current Template Associations', true), __('Action', true)));

foreach ($attached_template AS $template)
{

	echo $admin->TableCells(
		  array(
			$html->link($template['name'],'/templates/admin_edit/' . $template['id']),
			array($admin->ActionButton('delete','/stylesheets/admin_delete_template_association/' . $template['id'] . '/' . $stylesheet['Stylesheet']['id'],__('Delete', true)), array('align'=>'center'))
		   ));
}
?>
</table>

<?php
if(!empty( $available_templates))
{
	echo '<div class="attach_select">';
	echo $form->create('Stylesheet.Template', array('action' => '/stylesheets/admin_attach_templates/'.$stylesheet['Stylesheet']['id'], 'url' => '/stylesheets/admin_attach_templates/'.$stylesheet['Stylesheet']['id']));
	echo $form->select('Template.Template', $available_templates);
	echo $admin->formButton(__('Attach Template', true), 'template_add.png', array('type' => 'submit', 'name' => 'attach_template'));	
	echo '<div class="clear"></div>';
	echo $form->end();
	echo '</div>';
}
?>
<?php echo $admin->ShowPageHeaderEnd(); ?>