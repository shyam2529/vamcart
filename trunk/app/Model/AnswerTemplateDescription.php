<?php
/* -----------------------------------------------------------------------------------------
   VamCart - http://vamcart.com
   -----------------------------------------------------------------------------------------
   Copyright (c) 2011 VamSoft Ltd.
   License - http://vamcart.com/license.html
   ---------------------------------------------------------------------------------------*/
App::uses('Model', 'AppModel');
class AnswerTemplateDescription extends AppModel {
	public $name = 'AnswerTemplateDescription';
	public $belongsTo = array('AnswerTemplate','Language');
}
?>