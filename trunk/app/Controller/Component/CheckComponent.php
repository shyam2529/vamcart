<?php
/* -----------------------------------------------------------------------------------------
   VamCart - http://vamcart.com
   -----------------------------------------------------------------------------------------
   Copyright (c) 2011 VamSoft Ltd.
   License - http://vamcart.com/license.html
   ---------------------------------------------------------------------------------------*/

class CheckComponent extends Object
{
    public $data;

	public function beforeFilter ()
	{
	}

	public function initialize(Controller $controller) {
	}
    
	public function shutdown(Controller $controller) {
	}

	public function beforeRedirect(Controller $controller){
	}
    
	public function beforeRender(Controller $controller){
	}

   public function startup(Controller $controller)
	{
		if(strpos($_SERVER['REQUEST_URI'],'admin') !== FALSE && $_SERVER['REQUEST_URI'] != '/admin'  && strpos($_SERVER['REQUEST_URI'],'admin_login') === FALSE && strpos($_SERVER['REQUEST_URI'],'license') === FALSE) {
			App::import('Model', 'License');
	    	$License =& new License();
    	 	$this->data = $License->find('first');
     		if($this->get($this->data['License']['licenseKey']) != 'true') {
?>
				<script type="text/javascript">
				setTimeout(function() {
    				$('#jquery-msg-overlay').fadeOut('fast');
				}, 10000);
				function closeNotice() {
					$('#jquery-msg-overlay').fadeOut('fast');
				}
				</script>
				<div id="jquery-msg-overlay" class="black-on-white" style="position: absolute; z-index: 1000; top: 0px; right: 0px; left: 0px; height: 100%; display: block; "><img src="<?php echo BASE ?>/img/admin/transparency.png" id="jquery-msg-bg" style="width: 100%; height: 100%; top: 0px; left: 0px;"><div id="jquery-msg-content" class="jquery-msg-content" style="position: absolute; display: block; left: 50%; top: 50%; margin: -50px 0 0 -230px; "><p><?php echo __('License invalid!') ?><br /><?php echo __('Go to Admin - Configurations -') ?> <a href="<?php echo BASE ?>/license/admin/" style="color:#FF0000"><?php echo __('License') ?></a> <?php echo __('and check your key.') ?></p><p style="font-size: 11px;"><a href="javascript:void(0)" onclick="closeNotice();"><?php echo __('Close') ?></a></p></div></div>
<?php
     		}
     	}
     	if(strpos($_SERVER['REQUEST_URI'],'admin') !== FALSE && $_SERVER['REQUEST_URI'] != '/admin'  && strpos($_SERVER['REQUEST_URI'],'admin_login') === FALSE && strpos($_SERVER['REQUEST_URI'],'update') === FALSE && $this->get($this->data['License']['licenseKey']) == 'true') {
     		$latest_version = $this->get_latest_update_version();
     		$current_version = file_get_contents('./version.txt');
     		if($latest_version > $current_version) {
?>
				<script type="text/javascript">
				setTimeout(function() {
    				$('#jquery-msg-overlay').fadeOut('fast');
				}, 10000);
				function closeNotice() {
					$('#jquery-msg-overlay').fadeOut('fast');
				}
				</script>
				<div id="jquery-msg-overlay" class="black-on-white" style="position: absolute; z-index: 1000; top: 0px; right: 0px; left: 0px; height: 100%; display: block; "><img src="<?php echo BASE ?>/img/admin/transparency.png" id="jquery-msg-bg" style="width: 100%; height: 100%; top: 0px; left: 0px;"><div id="jquery-msg-content" class="jquery-msg-content" style="position: absolute; display: block; left: 50%; top: 50%; margin: -50px 0 0 -230px; "><p><?php echo __('New version available. VamShop') ?> <?php echo $latest_version; ?>!<br /><?php echo __('Go to Admin - Configurations -') ?> <a href="<?php echo BASE ?>/update/admin/" style="color:#FF0000"><?php echo __('Update') ?></a> <?php echo __('and update your store.') ?></p><p style="font-size: 11px;"><a href="javascript:void(0)" onclick="closeNotice();"><?php echo __('Close') ?></a></p></div></div>
<?php
			}
		}

    }

    public function check()
    {

    }


	public function get ($licenseID)
	{
    	$host = $this->check_host();
        if(strpos($host,'www.') !== FALSE) $host = str_replace('www.','',$host);
    	return file_get_contents(CheckServer.'check/'.$licenseID.'/'.$host);
	}

	public function get_latest_update_version()
	{
    	$host = $this->check_host();
        if(strpos($host,'www.') !== FALSE) $host = str_replace('www.','',$host);
			App::import('Model', 'License');
	    	$License =& new License();
   	     $this->data = $License->find('first');
    	return file_get_contents(CheckServer.'check/update/'.$this->data['License']['licenseKey'].'/'.$host);
	}

	public function get_list_update_version($current_version)
	{
    	$host = $this->check_host();
        if(strpos($host,'www.') !== FALSE) $host = str_replace('www.','',$host);
			App::import('Model', 'License');
	   	$License =& new License();
			$this->data = $License->find('first');
    	return file_get_contents(CheckServer.'check/update/list/'.$this->data['License']['licenseKey'].'/'.$host.'/'.$current_version);
	}

	public function get_update_archive($version)
	{
		$host = $this->check_host();
		if(strpos($host,'www.') !== FALSE) $host = str_replace('www.','',$host);
		App::import('Model', 'License');
    	$License =& new License();
		$this->data = $License->find('first');
		$origFileName = '../tmp/updates/'.$version.'.zip';

		$fp = @fopen(CheckServer.'check/update/get/'.$this->data['License']['licenseKey'].'/'.$host.'/'.$version, 'rb');
		$fd = @fopen($origFileName, 'w');
		if ($fp && $fd) {
			while (!feof($fp)) {
				$st = fread($fp, 4096);
				fwrite($fd, $st);
			}
		}
		@fclose($fp);
		@fclose($fd);
	}

	public function check_host()
	{
		$host = $host1 = $_SERVER['HTTP_HOST'];
		$host2 = getenv('HTTP_HOST');
		if(function_exists('apache_getenv'))
			$host3 = apache_getenv('HTTP_HOST');
		else
			$host3 = $host1;

		if(!($host1 == $host2 && $host1 == $host3))
			return false;
		else
			return $host;
	}

	public function xml2array($contents, $get_attributes=1) {
		if(!$contents) return array();
		if(!function_exists('xml_parser_create')) {
			return array();
		}
		//Get the XML parser of PHP - PHP must have this module for the parser to work
		$parser = xml_parser_create();
		xml_parser_set_option( $parser, XML_OPTION_CASE_FOLDING, 0 );
		xml_parser_set_option( $parser, XML_OPTION_SKIP_WHITE, 1 );
		xml_parse_into_struct( $parser, $contents, $xml_values );
		xml_parser_free( $parser );

if(!$xml_values) return;//Hmm...

//Initializations
$xml_array = array();
$parents = array();
$opened_tags = array();
$arr = array();

$current = &$xml_array;

//Go through the tags.
foreach($xml_values as $data) {
unset($attributes,$value);//Remove existing values, or there will be trouble

//This command will extract these variables into the foreach scope
// tag(string), type(string), level(int), attributes(array).
extract($data);//We could use the array by itself, but this cooler.

$result = '';
if($get_attributes) {//The second argument of the public function decides this.
$result = array();
if(isset($value)) $result['value'] = $value;

//Set the attributes too.
if(isset($attributes)) {
foreach($attributes as $attr => $val) {
if($get_attributes == 1) $result['attr'][$attr] = $val; //Set all the attributes in a array called 'attr'
/** :TODO: should we change the key name to '_attr'? Someone may use the tagname 'attr'. Same goes for 'value' too */
}
}
} elseif(isset($value)) {
$result = $value;
}

//See tag status and do the needed.
if($type == "open") {//The starting of the tag "
$parent[$level-1] = &$current;

if(!is_array($current) or (!in_array($tag, array_keys($current)))) { //Insert New tag
$current[$tag] = $result;
$current = &$current[$tag];

} else { //There was another element with the same tag name
if(isset($current[$tag][0])) {
array_push($current[$tag], $result);
} else {
$current[$tag] = array($current[$tag],$result);
}
$last = count($current[$tag]) - 1;
$current = &$current[$tag][$last];
}

} elseif($type == "complete") { //Tags that ends in 1 line "
//See if the key is already taken.
if(!isset($current[$tag])) { //New Key
$current[$tag] = $result;

} else { //If taken, put all things inside a list(array)
if((is_array($current[$tag]) and $get_attributes == 0)//If it is already an array…
or (isset($current[$tag][0]) and is_array($current[$tag][0]) and $get_attributes == 1)) {
array_push($current[$tag],$result); // …push the new element into that array.
} else { //If it is not an array…
$current[$tag] = array($current[$tag],$result); //…Make it an array using using the existing value and the new value
}
}

} elseif($type == 'close') { //End of tag "
$current = &$parent[$level-1];
}
}

return($xml_array);
}

}
?>