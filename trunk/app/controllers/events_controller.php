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

class EventsController extends AppController {
	var $name = 'Events';
   
   
   	function admin_view($id)
	{
		$this->set('current_crumb', __('Event Details', true));
		$this->set('title_for_layout', __('Event Details', true));
		$event = $this->Event->read(null,$id);
		$this->set('current_crumb_info',$event['Event']['alias']);		
			
		$this->set('event',$event);
		$this->set('event_handlers',$this->Event->EventHandler->find('all', array('conditions' => array('EventHandler.event_id' => $id))));
		
	}
   
	function admin()
	{
		$this->set('current_crumb', __('Events Listing', true));
		$this->set('title_for_layout', __('Events Listing', true));
		$this->set('event_data',$this->Event->find('all', array('order' => array('Event.alias ASC'))));
	}
}
?>