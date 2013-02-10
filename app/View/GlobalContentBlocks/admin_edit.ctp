<?php
/* -----------------------------------------------------------------------------------------
   VamCart - http://vamcart.com
   -----------------------------------------------------------------------------------------
   Copyright (c) 2011 VamSoft Ltd.
   License - http://vamcart.com/license.html
   ---------------------------------------------------------------------------------------*/

$this->Html->script(array(
	'modified.js',
	'jquery/plugins/jquery-ui-min.js',
	'tabs.js',
	'focus-first-input.js'
), array('inline' => false));

	echo $this->Html->css('ui.tabs', null, array('inline' => false));

	echo $this->Admin->ShowPageHeaderStart($current_crumb, 'edit.png');

	$id = $this->data['GlobalContentBlock']['id'];
	echo $this->Form->create('GlobalContentBlock', array('id' => 'contentform', 'action' => '/global_content_blocks/admin_edit/'.$id, 'url' => '/global_content_blocks/admin_edit/'.$id));
	
	echo $this->Admin->StartTabs();
			echo '<ul>';
			echo $this->Admin->CreateTab('main',__('Main'), 'main.png');
			echo $this->Admin->CreateTab('options',__('Options'), 'options.png');			
			echo '</ul>';
	
	echo $this->Admin->StartTabContent('main');
		echo $this->Form->inputs(array(
					'legend' => null,
					'fieldset' => __('Global Content Block Details'),
				   'GlobalContentBlock.id' => array(
				   		'type' => 'hidden'
	               ),
	               'GlobalContentBlock.name' => array(
   				   		'label' => __('Name')
	               ),
				   'GlobalContentBlock.content' => array(
   				   		'label' => __('Contents')
	               )																										
			));
	echo $this->Admin->EndTabContent();

	echo $this->Admin->StartTabContent('options');
		echo $this->Form->inputs(array(
					'legend' => null,
					'fieldset' => __('Global Content Block Details'),
	                'GlobalContentBlock.alias' => array(
   				   		'label' => __('Alias')
	                ),
				    'GlobalContentBlock.active' => array(
						'type' => 'checkbox',
   				   		'label' => __('Active'),
						'value' => '1',
						'class' => 'checkbox_group'
	                )																										
			));
	echo $this->Admin->EndTabContent();
	
	echo $this->Admin->EndTabs();
	
	echo $this->Admin->formButton(__('Submit'), 'submit.png', array('type' => 'submit', 'name' => 'submit')) . $this->Admin->formButton(__('Apply'), 'apply.png', array('type' => 'submit', 'name' => 'apply')) . $this->Admin->formButton(__('Cancel'), 'cancel.png', array('type' => 'submit', 'name' => 'cancelbutton'));
	echo '<div class="clear"></div>';
	echo $this->Form->end();
	echo $this->Admin->ShowPageHeaderEnd(); 
?>