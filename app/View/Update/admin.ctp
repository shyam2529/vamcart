<?php
/* -----------------------------------------------------------------------------------------
   VamCart - http://vamcart.com
   -----------------------------------------------------------------------------------------
   Copyright (c) 2011 VamSoft Ltd.
   License - http://vamcart.com/license.html
   ---------------------------------------------------------------------------------------*/

echo $this->Html->script('jquery/jquery.min', array('inline' => false));

echo $this->Admin->ShowPageHeaderStart($current_crumb, 'cus-arrow-refresh');

echo '<p>'.__('Your VamCart Version:').' <strong>'.$update_data->current_version.'</strong></p>';

if($update_data->current_version < $update_data->latest_version) {
	echo '<p>'.__('Click Update button to start VamCart AutoUpdate.').'</p>';
	echo $this->Admin->linkButton(__('Update'),'/update/admin_update/','cus-tick',array('escape' => false, 'class' => 'btn'));
}

echo $this->Admin->ShowPageHeaderEnd();

?>