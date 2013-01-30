<?php
/* -----------------------------------------------------------------------------------------
   VamCart - http://vamcart.com
   -----------------------------------------------------------------------------------------
   Copyright (c) 2011 VamSoft Ltd.
   License - http://vamcart.com/license.html
   ---------------------------------------------------------------------------------------*/

$html->script(array(
	'modified.js',
	'jquery/plugins/jquery-ui-min.js',
	'tabs.js',
	'focus-first-input.js'
), array('inline' => false));

	echo $html->css('ui.tabs', null, array('inline' => false));

	echo $admin->ShowPageHeaderStart($current_crumb, 'edit.png');

	echo $form->create('Country', array('id' => 'contentform', 'action' => '/countries/admin_edit/' . $data['Country']['id'], 'url' => '/countries/admin_edit/' . $data['Country']['id']));
	
	echo $admin->StartTabs();
			echo '<ul>';
			echo $admin->CreateTab('main',__('Main',true), 'main.png');
			echo $admin->CreateTab('options',__('Options',true), 'options.png');			
			echo '</ul>';
	
	echo $admin->StartTabContent('main');
		echo $form->inputs(array(
					'legend' => null,
					'fieldset' => __('Country Details', true),
				   'Country.id' => array(
				   		'type' => 'hidden',
						'value' => $data['Country']['id']
	               ),
	               'Country.name' => array(
				   		'label' => __('Name', true),
   						'value' => $data['Country']['name']
	               ),
	               'Country.iso_code_2' => array(
				   		'label' => __('ISO Code 2', true),
   						'value' => $data['Country']['name']
	               ),
	               'Country.iso_code_3' => array(
				   		'label' => __('ISO Code 3', true),
   						'value' => $data['Country']['iso_code_3']
	               ),
                       'Country.eu' => array(
				   		'label' => __('EU Country', true),
   						'value' => $data['Country']['eu']
	               ),
                       'Country.private' => array(
				   		'label' => __('Private person VAT', true),
   						'value' => $data['Country']['privat']
	               ),
                       'Country.firm' => array(
				   		'label' => __('Firm VAT', true),
   						'value' => $data['Country']['pravna']
	               )
			));
		echo $admin->EndTabContent();

		echo $admin->StartTabContent('options');
						echo $form->inputs(array(
					'legend' => null,
					'fieldset' => __('Country Details', true),
	               'Country.address_format' => array(
				   		'type' => 'textarea',
				   		'label' => __('Address Format', true),
   						'value' => $data['Country']['address_format']
	               )		
				  ));	
		echo $admin->EndTabContent();

	echo $admin->EndTabs();

	echo $admin->formButton(__('Submit', true), 'submit.png', array('type' => 'submit', 'name' => 'submit')) . $admin->formButton(__('Cancel', true), 'cancel.png', array('type' => 'submit', 'name' => 'cancelbutton'));
	echo '<div class="clear"></div>';
	echo $form->end();
	echo $admin->ShowPageHeaderEnd(); 
?>