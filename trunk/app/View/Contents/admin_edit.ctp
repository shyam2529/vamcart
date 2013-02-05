<?php
/* -----------------------------------------------------------------------------------------
   VamCart - http://vamcart.com
   -----------------------------------------------------------------------------------------
   Copyright (c) 2011 VamSoft Ltd.
   License - http://vamcart.com/license.html
   ---------------------------------------------------------------------------------------*/
?>
<?php

$this->Html->script(array(
	'modified.js',
	'jquery/plugins/jquery-ui-min.js',
	'tabs.js',
	'swfupload/swfupload.js',
	'swfupload/swfupload.queue.js',
	'swfupload/fileprogress.js',
	'swfupload/handlers.js',
	'focus-first-input.js'
), array('inline' => false));
	
	echo $this->Html->css('ui.tabs', null, array('inline' => false));
	echo $this->TinyMce->init();
?>
<?php echo $this->Html->scriptBlock('
	$(document).ready(function(){

		$("select#ContentContentTypeId").change(function () {
			$("div#content_type_fields").load("'. BASE . '/contents/admin_edit_type/"+$("select#ContentContentTypeId").val());
		})

	});
', array('allowCache'=>false,'safe'=>false,'inline'=>false)); ?>
<?php
echo $this->Admin->ShowPageHeaderStart($current_crumb, 'edit.png');
?>
<?php
	
	// Set default div styling for template_requured container divs
	if(($data['ContentType']['template_type_id'] > 0)||(empty($data)))
		$tpl_req_style = "block";
	else
		$tpl_req_style = "none";

	echo $this->Form->create('Content', array('id' => 'contentform', 'name' => 'contentform','enctype' => 'multipart/form-data', 'action' => '/contents/admin_edit/'.$data['Content']['id'], 'url' => '/contents/admin_edit/'.$data['Content']['id']));
	
	echo $this->Admin->StartTabs();
			echo '<ul>';
			echo $this->Admin->CreateTab('main',__('Main'), 'main.png');
			echo $this->Admin->CreateTab('view_images',__('View Images'), 'images.png');	
			echo $this->Admin->CreateTab('upload_images',__('Upload Images'), 'image_add.png');			
			echo $this->Admin->CreateTab('options',__('Options'), 'options.png');			
			echo '</ul>';
	
	echo $this->Admin->StartTabContent('main');
		echo $this->Form->inputs(array(
				'fieldset' => false,
				'legend' => false,
				'Content.id' => array(
					'type' => 'hidden',
					'value' => $data['Content']['id']
	               ),
				'Content.parent_id' => array(
					'type' => 'hidden',
					'value' => $parent_id
	               ),
				'Content.order' => array(
					'type' => 'hidden',
					'value' => $data['Content']['order']
	               )
				   ));
			
   		echo $this->Form->inputs(array(
						'legend' => false,
   					'Content.content_type_id' => array(
						'type' => 'select',
				   	'label' => __('Content Type'),
						'options' => $content_types,
						'selected' => (!isset($data['Content']['content_type_id'])? 2 : $data['Content']['content_type_id'])
	               )));

		echo '<div id="content_type_fields">';
			echo $this->requestAction( '/contents/admin_edit_type/' . (!isset($data['Content']['content_type_id'])? 2 : $data['Content']['content_type_id']) . '/' . $data['Content']['id'], array('return'));
		echo '</div>';
	
	echo '<div class="template_required" id="template_required_template_picker" style="display:' . $tpl_req_style . ';">';
	
		echo $this->Form->inputs(array(
					'legend' => false,
					'Content.template_id' => array(
						'type' => 'select',
						'label' => __('Template'),
						'options' => $templates,
						'selected' => $data['Content']['template_id']
					)
		));
	echo '</div>';	


	echo $this->Admin->StartTabs('sub-tabs');
			echo '<ul>';
	foreach($languages AS $language)
	{
			echo $this->Admin->CreateTab('language_'.$language['Language']['id'],$language['Language']['name'],$language['Language']['iso_code_2'].'.png');
	}
			echo '</ul>';
	
	// Loop through the languages and display a name and descrition for each
	foreach($languages AS $language)
	{
		$language_key = $language['Language']['id'];

	echo $this->Admin->StartTabContent('language_'.$language_key);
			
		echo $this->Form->inputs(array(
						'legend' => false,
						'ContentDescription]['.$language['Language']['id'].'][name.' . $language['Language']['id'] => array(
				   	'label' => $this->Admin->ShowFlag($language['Language']) . '&nbsp;' . __('Title'),
						'value' => $data['ContentDescription'][$language_key]['name']
	            	  )));																								
	
		echo '<div id="template_required_' . $language['Language']['id'] . '" class="template_required" style="display:' . $tpl_req_style . ';">';
			echo $this->Form->inputs(array(
						'legend' => false,
						'ContentDescription]['.$language['Language']['id'].'][description.' . $language['Language']['id'] => array(
				   	'label' => $this->Admin->ShowFlag($language['Language']) . '&nbsp;' . __('Description'),
						'type' => 'textarea',
						'class' => 'pagesmalltextarea',
						'id' => 'content_description_'.$language['Language']['id'],						
						'value' => $data['ContentDescription'][$language_key]['description']
	            	  )));
		echo '</div>';						  
		
		echo $this->TinyMce->toggleEditor('content_description_'.$language['Language']['id']);						  
		
		echo $this->Form->inputs(array(
						'legend' => false,
						'ContentDescription]['.$language['Language']['id'].'][meta_title.' . $language['Language']['id'] => array(
				   	'label' => $this->Admin->ShowFlag($language['Language']) . '&nbsp;' . __('Meta Title'),
						'value' => $data['ContentDescription'][$language_key]['meta_title']
	            	  )));																								

		echo $this->Form->inputs(array(
						'legend' => false,
						'ContentDescription]['.$language['Language']['id'].'][meta_description.' . $language['Language']['id'] => array(
				   	'label' => $this->Admin->ShowFlag($language['Language']) . '&nbsp;' . __('Meta Description'),
						'value' => $data['ContentDescription'][$language_key]['meta_description']
	            	  )));																								

		echo $this->Form->inputs(array(
						'legend' => false,
						'ContentDescription]['.$language['Language']['id'].'][meta_keywords.' . $language['Language']['id'] => array(
				   	'label' => $this->Admin->ShowFlag($language['Language']) . '&nbsp;' . __('Meta Keywords'),
						'value' => $data['ContentDescription'][$language_key]['meta_keywords']
	            	  )));																								

	echo $this->Admin->EndTabContent();
	}
		
	echo $this->Admin->EndTabs();
		
	echo $this->Admin->EndTabContent();

	echo $this->Admin->StartTabContent('view_images');
		echo '<div id="content_images_holder">';		
		echo $this->requestAction('/images/admin_view_content_images/' . (!isset($data['Content']['id'])? 0 : $data['Content']['id']), array('return'));	
		echo '</div>';
		
	echo $this->Admin->EndTabContent();


	echo $this->Admin->StartTabContent('upload_images');
	
		echo '<p>' . __('Press \'Upload Images\' and choose images from your computer to upload. Select as many files as you would like. Images will upload right after you select them.') . '</p>';
		echo '<div class="help tip"><p>' . __('TIP: Hold the \'control\' button to select more than one image.') . '</p></div>';		
		?>
<?php echo $this->Html->scriptBlock('
		var swfu;

		window.onload = function() {
			var settings = {
				flash_url : "' . BASE . '/js/swfupload/swfupload.swf",
				flash9_url : "' . BASE . '/js/swfupload/swfupload_fp9.swf",
				upload_url: "' . BASE . '/contents/upload_images/' . $content_id . '",
				post_params: {"PHPSESSID" : "' . session_id() . '"},
				file_size_limit : "10 MB",
				file_types : "*.jpg;*.jpeg;*.gif;*.png",
				file_types_description : "All Files",
				file_upload_limit : 100,
				file_queue_limit : 0,
				custom_settings : {
					progressTarget : "fsUploadProgress",
					cancelButtonId : "btnCancel"
				},
				debug: false,

				// Button settings

				button_image_url : "' . BASE . '/img/admin/swfupload/browse.png",
				button_width: "180",
				button_height: "22",
				button_placeholder_id: "spanButtonPlaceHolder",
				button_text: \'<span class="browsebtn">' . __('Browse Images') . '</span>\',
				button_text_style: ".browsebtn { font-size: 12pt; font-family: Trebuchet MS, Lucida Grande, Verdana, Arial, Sans-Serif; line-height: 1; }",
				button_text_left_padding: 22,
				button_text_top_padding: 0,

				button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
				button_cursor: SWFUpload.CURSOR.HAND,
				
				// The event handler functions are defined in handlers.js
				swfupload_preload_handler : preLoad,
				swfupload_load_failed_handler : loadFailed,
				file_queued_handler : fileQueued,
				file_queue_error_handler : fileQueueError,
				file_dialog_complete_handler : fileDialogComplete,
				upload_start_handler : uploadStart,
				upload_progress_handler : uploadProgress,
				upload_error_handler : uploadError,
				upload_success_handler : uploadSuccess,
				upload_complete_handler : uploadComplete,
				queue_complete_handler : queueComplete	// Queue plugin event
			};

			swfu = new SWFUpload(settings);
	     };
', array('allowCache'=>false,'safe'=>false,'inline'=>false)); ?>
		

			<div id="fsUploadProgress"></div>
			<div class="clear"></div>
			<div>
				<span id="spanButtonPlaceHolder"></span>
			</div>
			<div id="btnCancel">
				<input id="btnCancel" type="button" value="<?php echo __('Cancel All Uploads'); ?>" onclick="swfu.cancelQueue();" disabled="disabled" />
			</div>
			<div id="divStatus"><?php echo __('Files Uploaded:'); ?> 0</div>

		<?php
		
	echo $this->Admin->EndTabContent();

	echo $this->Admin->StartTabContent('options');
			echo $this->Form->inputs(array(
					'legend' => false,
					'fieldset' => __('Content Details'),
                'Content.alias' => array(
			   		'label' => __('Alias'),				   
					'value' => $data['Content']['alias']
                ),
				'Content.head_data' => array(
					'label' => __('Head Data'),
					'type' => 'textarea',
					'class' => 'notinymce',
					'value' => $data['Content']['head_data']
	             ),				
			    'Content.active' => array(
					'type' => 'checkbox',
			   		'label' => __('Active'),
					'value' => '1',
					'class' => 'checkbox_group',
					'checked' => $active_checked
                ),
			    'Content.show_in_menu' => array(
					'type' => 'checkbox',
			   		'label' => __('Show in menu'),
					'value' => '1',
					'class' => 'checkbox_group',
					'checked' => $menu_checked
                )
		));
	echo $this->Admin->EndTabContent();

	echo $this->Admin->EndTabs();

	echo $this->Admin->formButton(__('Submit'), 'submit.png', array('type' => 'submit', 'name' => 'submitbutton', 'id' => 'submitbutton')) . $this->Admin->formButton(__('Apply'), 'apply.png', array('type' => 'submit', 'name' => 'applybutton')) . $this->Admin->formButton(__('Cancel'), 'cancel.png', array('type' => 'submit', 'name' => 'cancelbutton'));
	echo '<div class="clear"></div>';
	echo $this->Form->end();
	echo $this->Admin->ShowPageHeaderEnd(); 
?>