<?php
$this->Html->script(array(
	'modified.js',
	'focus-first-input.js',
	'codemirror/lib/codemirror.js',
	'codemirror/mode/javascript/javascript.js',
	'codemirror/mode/css/css.js',
	'codemirror/mode/xml/xml.js',
	'codemirror/mode/htmlmixed/htmlmixed.js'
), array('inline' => false));

$this->Html->css(array(
	'codemirror/codemirror',
), null, array('inline' => false));

	echo $this->Admin->ShowPageHeaderStart($current_crumb, 'cus-application-edit');

	echo $this->Form->create('AttributeTemplate', array('id' => 'contentform', 'action' => '/admin_edit/save/'));		
	echo $this->Form->input('AttributeTemplate.id',array('type' => 'hidden'));  
	echo $this->Form->input('AttributeTemplate.name',array('label' => __('Name')));

        /*echo '<ul id="myTabLang" class="nav nav-tabs">';
        echo $this->Admin->CreateTab('template_filter',__('Template to filter'),'cus-application-edit');
        echo $this->Admin->CreateTab('template_editor',__('Template to editor'),'cus-application-edit');
        echo $this->Admin->CreateTab('template_catalog',__('Template to catalog'),'cus-application-edit');
        echo $this->Admin->CreateTab('template_cart',__('Template to cart'),'cus-application-edit');
        echo '</ul>';*/
               
        //echo $this->Admin->StartTabs('sub-tabs');
        
        //echo $this->Admin->StartTabContent('template_filter');
        echo $this->Form->input('AttributeTemplate.template_filter', 
					array('type' => 'textarea',
   				   		'id' => 'code_template_filter',
                                             'label' => __('Template to filter')
                                ));
        //echo $this->Admin->EndTabContent();
        
        //echo $this->Admin->StartTabContent('template_editor');
        echo $this->Form->input('AttributeTemplate.template_editor', 
					array('type' => 'textarea',
   				   		'id' => 'code_template_editor',
                                             'label' => __('Template to editor')
                                ));
        //echo $this->Admin->EndTabContent();
        
        //echo $this->Admin->StartTabContent('template_catalog');
        echo $this->Form->input('AttributeTemplate.template_catalog', 
					array('type' => 'textarea',
   				   		'id' => 'code_template_catalog',
                                             'label' => __('Template to catalog')
                                ));
        //echo $this->Admin->EndTabContent();
        
        //echo $this->Admin->StartTabContent('template_cart');
        echo $this->Form->input('AttributeTemplate.template_product', 
					array('type' => 'textarea',
   				   		'id' => 'code_template_product',
                                             'label' => __('Template to cart')
                                ));
        //echo $this->Admin->EndTabContent();
        
        //echo $this->Admin->EndTabs();
                
	echo $this->Admin->formButton(__('Submit'), 'cus-tick', array('class' => 'btn', 'type' => 'submit', 'name' => 'submit')) . $this->Admin->formButton(__('Apply'), 'cus-disk', array('class' => 'btn', 'type' => 'submit', 'name' => 'apply')) . $this->Admin->formButton(__('Cancel'), 'cus-cancel', array('class' => 'btn', 'type' => 'submit', 'name' => 'cancelbutton'));
	echo '<div class="clear"></div>';
	echo $this->Form->end();
	echo $this->Admin->ShowPageHeaderEnd(); 
	
	echo $this->Html->scriptBlock('
        var editor_1 = CodeMirror.fromTextArea(document.getElementById("code_template_filter"), {
          mode: "text/html",
          lineNumbers: true,
          lineWrapping: true
        });
        var editor_2 = CodeMirror.fromTextArea(document.getElementById("code_template_editor"), {
          mode: "text/html",
          lineNumbers: true,
          lineWrapping: true
        });
        var editor_3 = CodeMirror.fromTextArea(document.getElementById("code_template_catalog"), {
          mode: "text/html",
          lineNumbers: true,
          lineWrapping: true
        });
        var editor_4 = CodeMirror.fromTextArea(document.getElementById("code_template_product"), {
          mode: "text/html",
          lineNumbers: true,
          lineWrapping: true
        });
        ', array('allowCache'=>false,'safe'=>false,'inline'=>true));	
	
?>