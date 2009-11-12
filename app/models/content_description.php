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

class ContentDescription extends AppModel {

	var $name = 'ContentDescription';
	var $belongsTo = array('Language');
	
	var $validate = array(
	'content_id' => array(
		'rule' => 'notEmpty'
	)
	);
		
}

?>