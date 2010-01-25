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

class CountriesController extends AppController {
	var $name = 'Countries';
	var $components = array('RequestHandler');
	var $paginate = array();
	
	function admin_edit ($country_id = null)
	{
		$this->set('current_crumb', __('Country Details', true));
		$this->pageTitle = __('Edit', true);
		// If they pressed cancel
		if(isset($this->params['form']['cancel']))
		{
			$this->redirect('/countries/admin/');
			die();
		}
		
		if(empty($this->data))
		{
			$this->Country->id = $country_id;
			$this->set('data', $this->Country->read());
		}
		else
		{
			$this->Country->save($this->data);	
			if($country_id == null)	
				$this->Session->setFlash(__('Record created.', true));
			else
				$this->Session->setFlash(__('Record saved.', true));			
			$this->redirect('/countries/admin/');
			die();
		}		
	}
	
	function admin_modify_selected() 	
	{
		$build_flash = "";
		foreach($this->params['data']['Country']['modify'] AS $value)
		{
			// Make sure the id is valid
			if($value > 0)
			{
				$this->Country->id = $value;
				$country = $this->Country->read();
		
				switch ($this->params['form']['multiaction']) 
				{
					case "delete":
						$this->Country->del($value);
						$build_flash .= __('Record deleted.', true) . ' ' . $country['Country']['name'] . '<br />';									
					break;								
				}
			}
		}
		$this->Session->setFlash($build_flash);
		$this->redirect('/countries/admin/');
	}	
	
	function admin_delete ($country_id)
	{
		$this->Country->del($country_id);
		$this->Session->setFlash( __('Record deleted.', true));
		$this->redirect('/countries/admin');
	}
	
	function admin_new ()
	{
		$this->redirect('/countries/admin_edit/');
	}
	function admin($ajax_request = false)
	{
		$this->set('current_crumb', __('Countries Listing', true));
		$this->pageTitle = __('Countries Listing', true);
		$this->paginate['Model'] = array('limit' => 25, 'order' => 'Country.name ASC'); 
		$data = $this->paginate('Country');
		$this->set(compact('data'));
		
	}
}
?>