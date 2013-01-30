<?php
/**
* This is a component to send email from CakePHP using PHPMailer
* @link http://bakery.cakephp.org/articles/view/94
* @see http://bakery.cakephp.org/articles/view/94
*/

class EmailComponent extends Object
{     
    /**
     * PHPMailer object.
     * 
     * @access private
     * @var object
     */
     var $m;    
    
    /**
     * Creates the PHPMailer object and sets default values.
     * Must be called before working with the component!
     *
     * @access public
     * @return void
     */
    function init()
    {
        // Include the class file and create PHPMailer instance
        App::import('Vendor', 'PHPMailer', array('file' => 'phpmailer'.DS.'class.phpmailer.php'));
        $this->m = new PHPMailer;
        
        // Set default PHPMailer variables (see PHPMailer API for more info)
		
		$this->IsMail();
		
		$this->CharSet = 'utf-8';
		// set more PHPMailer vars, for smtp etc.
//		$this->IsSMTP();
//		$this->SMTPKeepAlive = true; // set mailer to use SMTP
     }

    function __set($name, $value)
    {
        $this->m->{$name} = $value;
    }
    
    function __get($name)
    {
        if (isset($this->m->{$name})) {
            return $this->m->{$name};
        }
    }
             
    function __call($method, $args)
    {
        if (method_exists($this->m, $method)) {
            return call_user_func_array(array($this->m, $method), $args);
        }
    }
}
?>