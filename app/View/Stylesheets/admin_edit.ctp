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
	'focus-first-input.js',
	'codemirror/lib/codemirror.js',
	'codemirror/mode/javascript/javascript.js',
	'codemirror/mode/css/css.js',
	'codemirror/mode/xml/xml.js',
	'codemirror/mode/htmlmixed/htmlmixed.js'
), array('inline' => false));

$this->Html->css(array(
	'ui.tabs',
	'codemirror/codemirror'
), null, array('inline' => false));

	echo $this->Admin->ShowPageHeaderStart($current_crumb, 'stylesheets.png');

	echo $this->Form->create('Stylesheet', array('id' => 'contentform', 'action' => '/stylesheets/admin_edit/'.$data['Stylesheet']['id'], 'url' => '/stylesheets/admin_edit/'.$data['Stylesheet']['id']));

	echo $this->Admin->StartTabs();
			echo '<ul>';
			echo $this->Admin->CreateTab('main',__('Main'), 'main.png');
			echo $this->Admin->CreateTab('options',__('Options'), 'options.png');			
			echo '</ul>';

	echo $this->Admin->StartTabContent('main');
	echo $this->Form->inputs(array(
					'legend' => null,
					'fieldset' => __('Stylesheet Details'),
				   'Stylesheet.id' => array(
				   		'type' => 'hidden',
						'value' => $data['Stylesheet']['id']
	               ),
	               'Stylesheet.name' => array(
   				   		'label' => __('Name'),				   
   						'value' => $data['Stylesheet']['name']
	               ),
				   'Stylesheet.stylesheet' => array(
   				   		'label' => __('Stylesheets'),				   
   						'id' => 'code',
   						'value' => $data['Stylesheet']['stylesheet']
	               )																										
			));
	echo $this->Admin->EndTabContent();

	echo $this->Admin->StartTabContent('options');			
		echo $this->Form->inputs(array(
					'legend' => null,
					'fieldset' => __('Stylesheet Details'),
					'Stylesheet.alias' => array(
			   		'label' => __('Alias'),				   
					'value' => $data['Stylesheet']['alias']
                	),
				   'Stylesheet.active' => array(
				   		'label' => __('Active'),
				   		'type' => 'checkbox',
						'class' => 'checkbox_group',						
   						'checked' => $active_checked
	               )																										
			));
			
	echo $this->Admin->EndTabContent();			

	echo $this->Admin->EndTabs();
			
	echo $this->Admin->formButton(__('Submit'), 'submit.png', array('type' => 'submit', 'name' => 'submitbutton', 'id' => 'submit')) . $this->Admin->formButton(__('Apply'), 'apply.png', array('type' => 'submit', 'name' => 'apply')) . $this->Admin->formButton(__('Cancel'), 'cancel.png', array('type' => 'submit', 'name' => 'cancelbutton'));
	echo '<div class="clear"></div>';
	echo $this->Form->end();

	echo $this->Admin->ShowPageHeaderEnd();

	echo $this->Html->scriptBlock('
var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
  mode: "css",
  lineNumbers: true,
  lineWrapping: true
});
var hlLine = editor.addLineClass(0, "background", "activeline");
editor.on("cursorActivity", function() {
  var cur = editor.getLineHandle(editor.getCursor().line);
  if (cur != hlLine) {
    editor.removeLineClass(hlLine, "background", "activeline");
    hlLine = editor.addLineClass(cur, "background", "activeline");
  }
});
', array('allowCache'=>false,'safe'=>false,'inline'=>true));	
	
?>