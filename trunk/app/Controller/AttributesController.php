<?php

class AttributesController extends AppController 
{
    public $name = 'Attributes';
    public $paginate = null;
//    public $components = array('DebugKit.Toolbar');
    public $helpers = array('Smarty');
    
    public function admin ($id = 0 ,$parent_id = 0)
    {              
        
        $this->loadModel('Content');
	$this->Content->unbindModel(array('hasMany' => array('ContentDescription')));
	$this->Content->bindModel(array('hasOne' => array('ContentDescription' => array(
						'className' => 'ContentDescription',
						'conditions' => 'language_id = ' . $this->Session->read('Customer.language_id')
					))));
        $this->Content->unbindModel(array('hasMany' => array('Attribute')));
	$this->Content->bindModel(array('hasMany' => array('Attribute' => array(
						'className' => 'Attribute'
                                               ,'order' => array('Attribute.order ASC')
					))));
        
        $this->Content->Attribute->setLanguageDescriptor($this->Session->read('Customer.language_id'));
        $this->paginate['Content'] = array('conditions' => array('Content.parent_id' => $id , 'Content.content_type_id IN (1,2)')
                                          ,'limit' => '30'
                                          ,'order' => array('Content.order ASC')
                                           );
        $content_data = $this->paginate('Content');

        $this->set('prev_level',$parent_id);
        $this->set('content_data',$content_data);
        
        $this->set('current_crumb', __('List content', true));
	$this->set('title_for_layout', __('List content', true));
        
    } 
    
    public function admin_editor_attr($action = 'init' ,$type = 'attr' ,$id = 0) 
    {   
        $attribute = array();
        
        switch ($action) 
	{
            case 'init':
                
            break;
            case 'add':
                $attribute['Attribute']['id'] = 0;
                if ($type == 'attr') $attribute['Attribute']['content_id'] = $id;
                else if ($type == 'val') $attribute['Attribute']['content_id'] = 0;
                if ($type == 'attr') $attribute['Attribute']['parent_id'] = 0;
                else if ($type == 'val') $attribute['Attribute']['parent_id'] = $id;
                $attribute['ValAttribute'] = array();
//                $this->Session->write('Attributes.tmp_Attribute',$attribute);
            break;
            case 'edit':
                $this->Attribute->ValAttribute->setLanguageDescriptor($this->Session->read('Customer.language_id'));
                $this->Attribute->id = $id;
                $attribute = $this->Attribute->read();   
                if(!empty($attribute))
                {
                    $tmp = $attribute['AttributeDescription'];
                    $attribute['AttributeDescription'] = null;
                    foreach($tmp AS $id => $value)
                    {
                        $key = $value['language_id'];
                        $attribute['AttributeDescription'][$key] = $value;
                    }
                }
                $id = $attribute['Attribute']['parent_id'];
 //               $this->Session->write('Attributes.tmp_Attribute',$attribute);
            break;
            case 'save':
                if(isset($this->data['cancelbutton']))
                {
                    if ($type == 'attr') $this->redirect('/attributes/admin_viewer_attr/' . $this->data['Attribute']['content_id']);
                    else if ($type == 'val') $this->redirect('/attributes/admin_editor_attr/edit/attr/' . $this->data['Attribute']['parent_id']);
                }
                $attribute = array();
                $attribute['Attribute'] = $this->data['Attribute'];
                foreach($this->data['Attribute']['AttributeDescription'] AS $k => $value)
		{
                    $attribute['AttributeDescription'][$k]['dsc_id'] = $value['dsc_id'];
                    $attribute['AttributeDescription'][$k]['name'] = $value['name'];
                    $attribute['AttributeDescription'][$k]['language_id'] = $k;
                }

                if($attribute['Attribute']['id'] == 0) $this->Attribute->create();
                if($this->Attribute->saveAll($attribute))
                {
                    if ($type == 'attr')//для атрибута создадим значения по умолчанию
                    {
                        $this->constructDefValue($attribute['Attribute']['attribute_template_id'], $attribute['Attribute']['id']);
                    }
                    $this->Session->setFlash('Attribute saved.');
                } else $this->Session->setFlash('Attribute not saved!', 'default', array('class' => 'error-message red'));  

                if ($type == 'attr') $this->redirect('/attributes/admin_viewer_attr/' . $this->data['Attribute']['content_id']);
                else if ($type == 'val') $this->redirect('/attributes/admin_editor_attr/edit/attr/' . $this->data['Attribute']['parent_id']);
            break;
            case 'delete':
                if($this->Attribute->delete($id))
                {
                    $this->Session->setFlash('Attribute deleted.');
                } else $this->Session->setFlash('Failed attribute deleted!', 'default', array('class' => 'error-message red'));
                $this->redirect($this->referer());
            break;
            default:
                die();
            break;
        }
        
        
        $this->loadModel('Language');
        $this->set('languages', $this->Language->find('all', array('conditions' => array('active' => '1'), 'order' => array('Language.id ASC'))));
        $this->loadModel('AttributeTemplate');
        if($type == 'val') 
        {   
            $this->Attribute->id = $id;
            $this->Attribute->recursive = -1;
            $tmpl_id = $this->Attribute->read('attribute_template_id'); 
            $template = $this->AttributeTemplate->find('first',array('conditions' => array('id' => $tmpl_id['Attribute'])));
            $template = unserialize($template['AttributeTemplate']['setting']);
            $template = array_filter($template,function($var){return($var == 1);});
            foreach ($template AS $k => $val) $template[$k] = $k;
            $this->set('template',$template);            
        }
        else $this->set('template', $this->AttributeTemplate->find('list'));
        $this->set('attribute',$attribute);
        $this->set('type',$type);
        $this->set('current_crumb', __('Atribute editor', true));
	$this->set('title_for_layout', __('Atribute editor', true)); 
    }
    
    public function admin_viewer_attr($content_id = 0) 
    {        
        $this->loadModel('Content');
        $this->Content->recursive = 2;
        $this->Content->unbindAll();
	$this->Content->bindModel(array('hasOne' => array('ContentDescription' => array(
						'className' => 'ContentDescription'
                                                ,'conditions' => 'language_id = ' . $this->Session->read('Customer.language_id')
					))));
	$this->Content->bindModel(array('hasMany' => array('Attribute' => array(
						'className' => 'Attribute'
                                               ,'order' => array('Attribute.order ASC')
					))));
        $this->Content->Attribute->setLanguageDescriptor($this->Session->read('Customer.language_id'));
        $content_data = $this->Content->find('first',array('conditions' => array('Content.id' => $content_id)));
        $this->set('content_data',$content_data);
        $this->set('current_crumb', __('List atributes', true));
	$this->set('title_for_layout', __('List atributes', true)); 
    }
    
    public function change_field_status($field = 'is_active' ,$id) 
    {
        $current_model = $this->modelClass;

	$this->$current_model->id = $id;
	$record = $this->$current_model->read();
	if($record[$current_model][$field] == 0)
	{
            $record[$current_model][$field] = 1;
	}
	else
	{
            $record[$current_model][$field] = 0;		
	}
	$this->$current_model->save($record);
        $this->redirect($this->referer());
    }
    
    public function admin_editor_value($action = 'init' ,$content_id = 0) 
    {   
        $this->loadModel('Content');
        $this->Content->Attribute->setLanguageDescriptor($this->Session->read('Customer.language_id'));
        $content_data = $this->Content->find('first',array('conditions' => array('Content.id' => $content_id)));
        
        switch ($action) 
	{
            case 'init':
                
            break;
            case 'edit':
                $this->Attribute->setLanguageDescriptor($this->Session->read('Customer.language_id'));
                $this->Attribute->ValAttribute->setLanguageDescriptor($this->Session->read('Customer.language_id'));
                $attr_data = $this->Attribute->find('all',array('conditions' => array('Attribute.content_id' => $content_data['Content']['parent_id'])
                                                               ,'order' => array('Attribute.order ASC')));
                $this->Attribute->recursive = -1;
                
                $element_list = array();
                foreach($attr_data AS $k => $attr)
                {
                    $element_list[$k]['id_attribute'] = $attr['Attribute']['id'];
                    $element_list[$k]['name_attribute'] = $attr['Attribute']['name'];
                    $element_list[$k]['template_attribute'] = $attr['AttributeTemplate']['template_editor'];
                    $element_list[$k]['values_attribute'] = array();   
                    foreach($attr['ValAttribute'] AS $k_v => $def_val)
                    {   
                        $val = $this->Attribute->find('first',array('conditions' => array('Attribute.content_id' => $content_id
                                                                              ,'Attribute.parent_id' => $def_val['id']
                                                                               )));
                        if(isset($def_val['type_attr'])&&$def_val['type_attr']!=''
				&&$def_val['type_attr']!='list_value'&&$def_val['type_attr']!='checked_list')$k_v = $def_val['type_attr'];//Если задан тип то передаем его качестве ключа
                        $element_list[$k]['values_attribute'][$k_v]['name'] = $def_val['name']; //наследуем от родителя
                        $element_list[$k]['values_attribute'][$k_v]['type_attr'] = $def_val['type_attr']; //наследуем от родителя
                        if(empty($val))
                        {
                            $def_val['parent_id'] = $def_val['id']; //свой id ,так как родитель
                            $element_list[$k]['values_attribute'][$k_v]['id'] = '0';
                            $element_list[$k]['values_attribute'][$k_v]['parent_id'] = $def_val['id'];
                            $element_list[$k]['values_attribute'][$k_v]['val'] = $def_val['val']; //данные родителя
                        }
                        else 
                        {
                            $element_list[$k]['values_attribute'][$k_v]['id'] = $val['Attribute']['id'];//id берем свой для сохранения
                            $element_list[$k]['values_attribute'][$k_v]['parent_id'] = $val['Attribute']['parent_id'];
                            $element_list[$k]['values_attribute'][$k_v]['val'] = $val['Attribute']['val'];
                        }
                    }                                    
                }
                
            break;
            case 'save':
                if(isset($this->data['cancelbutton']))
                {
                    $this->redirect('/attributes/admin/' . $this->data['Attribute']['parent_id']);
                }
//var_dump($this->data['values_s']);
                $save_data = array();
                foreach ($this->data['values_s'] as $def_value) 
                {
                    if(isset($def_value['set'])) $def_value['data'][$def_value['set']]['value'] = '1'; 
                    foreach ($def_value['data'] as $value) 
                    {
                        if(!isset($value['value'])) $value['value'] = '0'; 
                        array_push($save_data, array('id' => $value['id']
                                                    ,'parent_id' => $value['parent_id']
                                                    ,'content_id' => $this->data['Attribute']['content_id']
                                                    ,'val' => $value['value']
                                                    ));
                    }
                }
                
                if($this->Attribute->saveAll($save_data))
                {
                    $this->Session->setFlash('Value attributes saved.');
                } else $this->Session->setFlash('Value attributes not saved!', 'default', array('class' => 'error-message red'));  

                $this->redirect('/attributes/admin/' . $this->data['Attribute']['parent_id']);
            break;
            default:
                die();
            break;
        }
        
        $this->loadModel('Language');
        $this->set('languages', $this->Language->find('all', array('conditions' => array('active' => '1'), 'order' => array('Language.id ASC'))));
        $this->set('element_list',$element_list);
        $this->set('content_id', $content_id);
        $this->set('parent_id', $content_data['Content']['parent_id']); 
        $this->set('current_crumb', __('Value editor', true));
	$this->set('title_for_layout', __('Value editor', true)); 

    }    
    
    public function constructDefValue($type_attr, $id_attr) 
    { 
        
    }
    
         
}

?>