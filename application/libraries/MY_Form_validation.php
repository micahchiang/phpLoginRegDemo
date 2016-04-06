<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation 
{


	function __construct($rules=array())
	{
		parent::__construct($rules);
	}

	public function paramCheck($str)
	{
		$this->CI->form_validation->set_message('paramCheck', 'password must contain at least one number and one capital letter');
		if(preg_match('#[0-9]#', $str) && preg_match('#[a-zA-Z]#', $str)){
			return TRUE;
		}
		return FALSE;
	}
}
?>