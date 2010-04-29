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

$html->script(array(
	'modified.js',
	'jquery/jquery.min.js',
	'jquery/plugins/ui.core.js',
	'jquery/plugins/ui.tabs.js',
	'tabs.js',
	'focus-first-input.js',
	'codemirror/codemirror.js'
), array('inline' => false));

	echo $html->css('ui.tabs', null, array('inline' => false));

	echo $admin->ShowPageHeaderStart($current_crumb, 'stylesheets.png');

	echo $form->create('Stylesheet', array('id' => 'contentform', 'action' => '/stylesheets/admin_edit/'.$data['Stylesheet']['id'], 'url' => '/stylesheets/admin_edit/'.$data['Stylesheet']['id']));

	echo $admin->StartTabs();
			echo '<ul>';
			echo $admin->CreateTab('main',__('Main',true), 'main.png');
			echo $admin->CreateTab('options',__('Options',true), 'options.png');			
			echo '</ul>';
	
	echo $admin->StartTabContent('main');
	echo $form->inputs(array(
					'legend' => null,
					'fieldset' => __('Stylesheet Details', true),
				   'Stylesheet.id' => array(
				   		'type' => 'hidden',
						'value' => $data['Stylesheet']['id']
	               ),
	               'Stylesheet.name' => array(
   				   		'label' => __('Name', true),				   
   						'value' => $data['Stylesheet']['name']
	               ),
				   'Stylesheet.stylesheet' => array(
   				   		'label' => __('Stylesheets', true),				   
   						'id' => 'code',
   						'value' => $data['Stylesheet']['stylesheet']
	               )																										
			));
	echo $admin->EndTabContent();

	echo $admin->StartTabContent('options');			
		echo $form->inputs(array(
					'legend' => null,
					'fieldset' => __('Stylesheet Details', true),
					'Stylesheet.alias' => array(
			   		'label' => __('Alias', true),				   
					'value' => $data['Stylesheet']['alias']
                	),
				   'Stylesheet.active' => array(
				   		'label' => __('Active', true),
				   		'type' => 'checkbox',
						'class' => 'checkbox_group',						
   						'checked' => $active_checked
	               )																										
			));
			
	echo $admin->EndTabContent();			

	echo $admin->EndTabs();
			
	echo $form->submit(__('Submit', true), array('name' => 'submit')) . $form->submit(__('Apply', true), array('name' => 'apply')) . $form->submit(__('Cancel', true), array('name' => 'cancel'));
	echo '<div class="clear"></div>';
	echo $form->end();

	echo $admin->ShowPageHeaderEnd();

	echo $html->scriptBlock('
      var editor = CodeMirror.fromTextArea("code", {
        height: "350px",
        parserfile: ["parsecss.js"],
        stylesheet: ["'. BASE . '/js/codemirror/css/csscolors.css"],
        path: "'. BASE . '/js/codemirror/",
        continuousScanning: 500
      });
', array('allowCache'=>false,'safe'=>false,'inline'=>true));	
	
?>