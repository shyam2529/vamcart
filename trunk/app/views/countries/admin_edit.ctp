<?php
/* -----------------------------------------------------------------------------------------
   VaM Cart
   http://vamcart.com
   http://vamcart.ru
   Copyright 2009-2010 VaM Cart
   -----------------------------------------------------------------------------------------
   Portions Copyright:
   Copyright 2007 by Kevin Grandon (kevingrandon@hotmail.com)
   -----------------------------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------------------------*/

	$javascript->link(array(
		'modified.js',
		'jquery/jquery.min.js',
		'jquery/plugins/ui.core.js',
		'jquery/plugins/ui.tabs.js',
		'tabs.js',
		'focus-first-input.js'
	), false);

	echo $html->css('jquery/plugins/ui.tabs','','', false);

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

	echo $form->submit( __('Submit', true), array('name' => 'submit')) . $form->submit( __('Cancel', true), array('name' => 'cancel'));
	echo '<div class="clear"></div>';
	echo $form->end();
	echo $admin->ShowPageHeaderEnd(); 
?>