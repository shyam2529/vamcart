<?php
/* -----------------------------------------------------------------------------------------
   VaM Cart
   http://vamcart.com
   http://vamcart.ru
   Copyright 2010 VaM Cart
   -----------------------------------------------------------------------------------------
   Portions Copyright:
   Copyright 2007 by Kevin Grandon (kevingrandon@hotmail.com)
   -----------------------------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------------------------*/

echo '<table class="contentTable">';

echo $html->tableHeaders(array(	 __('Title', true), __('Template', true), __('Action', true)));
//pr($content_data);
foreach ($content_data AS $content)
{

	$name_link = $html->link($content['ContentDescription']['name'], '/contents/admin_core_pages_edit/' . $content['Content']['id']);
	
	echo $admin->TableCells(
		  array(
				$name_link,
				__($content['Template']['name'], true),
				array($admin->ActionButton('edit','/contents/admin_core_pages_edit/' . $content['Content']['id'],__('Edit', true)), array('align'=>'center'))
		   ));
		   	
}

echo '</table>';

?>