<?php
/* -----------------------------------------------------------------------------------------
   VamShop - http://vamshop.com
   -----------------------------------------------------------------------------------------
   Copyright (c) 2014 VamSoft Ltd.
   License - http://vamshop.com/license.html
   ---------------------------------------------------------------------------------------*/
   
App::uses('Model', 'AppModel');
class ContentDownloadable extends AppModel {
	public $name = 'ContentDownloadable';
	public $belongsTo = array('Tax');
	public $hasMany = array('ContentProductPrice' => array('dependent' => true,'foreignKey' => 'content_product_id'));

	public $validate = array(
		'price' => array(
			'rule' => 'notEmpty'
		)
	);
}
