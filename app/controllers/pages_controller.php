<?php
/* -----------------------------------------------------------------------------------------
   VaM Cart
   http://vamcart.com
   http://vamcart.ru
   Copyright 2009 VaM Cart
   -----------------------------------------------------------------------------------------
   Portions Copyright:
   Copyright 2007 by Kevin Grandon (kevingrandon@hotmail.com)
   -----------------------------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------------------------*/

class PagesController extends AppController {
	var $components = array('ConfigurationBase','ContentBase','Smarty');
	var $uses = null;
	var $autoLayout = false;
	var $helpers = null;
	var $layout = null;
	
	function beforeFilter()
	{	
		// This redirects the user to the install script if the config.php filesize is empty.
		if($this->action == 'index')
		{
			$configfilesize = filesize(ROOT . DS . '/config.php');
			if(empty($configfilesize))
			{
				$this->redirect('/install/');
				die();
			}
		}

		// Call the beforeFilter in the app_controller
		parent::beforeFilter();
		
	}
	
	function getAliasFromParams ($params)
	{
		global $config;
		
		if(!isset($params['content_alias']))
			$content_alias = "";
		else 
			$content_alias = substr($params['content_alias'],0,(strlen($params['content_alias']) - strlen($config['URL_EXTENSION'])));
		
			
		return $content_alias;
	}
	
	
	function index() 
	{	
		global $content;
		global $config;
		
		App::import('Model', 'Content');
		$this->Content =& new Content();
		
		$alias = $this->getAliasFromParams($this->params);
		
		// Pull the content out of cache or generate it if it doesn't exist
		// Cache is based on language_id and alias of the page.
		$cache_name = 'vam_content_' . $this->Session->read('Customer.language_id') . '_' . $alias;
		$content = Cache::read($cache_name);
		if($content === false)
		{					
			$content = $this->ContentBase->get_content_information($alias);
			$content_description = $this->ContentBase->get_content_description($content['Content']['id']);
		
			$content['ContentDescription'] = $content_description['ContentDescription'];

			$specific_model = $content['ContentType']['type'];
			$specific_content = $this->Content->$specific_model->find(array('content_id' => $content['Content']['id']));
		
			$content[$specific_model] = $specific_content[$specific_model];

			Cache::write($cache_name, $content);
		}
		
		// Get the template information.  
		//Layout template cache is generated by the content_id appended to vam_layout_template_.
		$cache_name = 'vam_layout_template_' . $content['Content']['id'];
		$template = Cache::read($cache_name);
		if($template === false)
		{		
			$template = $this->Content->Template->find(array('template_type_id' => '1', 'parent_id' => $content['Template']['id']));
			Cache::write($cache_name, $template);
		}

		// Save cache based on content_id for template_vars.
		$cache_name = 'vam_template_vars_' . $content['Content']['id'];
		$template_vars = Cache::read($cache_name);
		if($template_vars === false)
		{
			$template_vars = array('content_id' => $content['Content']['id'], 
							   'content_alias' => $content['Content']['alias'],
							   'parent_id' => $content['Content']['parent_id'],
							   'sub_count' => array(
							   						'all_content' => $this->Content->findCount(array('Content.parent_id' => $content['Content']['id'])),							   
							   						'categories' => $this->Content->findCount(array('Content.parent_id' => $content['Content']['id'],'ContentType.name' => 'category')),
							   						'products' => $this->Content->findCount(array('Content.parent_id' => $content['Content']['id'],'ContentType.name' => 'product')),
							   						'pages' => $this->Content->findCount(array('Content.parent_id' => $content['Content']['id'],'ContentType.name' => 'page')),													
							   						'news' => $this->Content->findCount(array('Content.parent_id' => $content['Content']['id'],'ContentType.name' => 'news')),													
							   						'article' => $this->Content->findCount(array('Content.parent_id' => $content['Content']['id'],'ContentType.name' => 'article')),													
							   						'pages' => $this->Content->findCount(array('Content.parent_id' => $content['Content']['id'],'OR' => array('ContentType.name' => 'link')))
							   					   ),
							   'show_in_menu' => $content['Content']['show_in_menu'],
							   'created' => $content['Content']['created'],
							   'modified' => $content['Content']['modified']);

			Cache::write($cache_name, $template_vars);
		}
		
		echo '<!-- Powered by: VaM Cart (http://vamcart.com) -->' . "\n";
		$this->Smarty->display($template['Template']['template'],$template_vars);
		die();
	}
}
?>