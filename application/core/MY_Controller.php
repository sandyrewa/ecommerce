<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
################################################################
### file location - application/core/MY_Controller.php	########
### Developed by  - Sandeep singh	  					########
###													 	########
### Developer 	  - Sandeep Singh(sandy)           		########
################################################################
*/

class MY_Controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	/*
	* clean astring and remove all special characters
	*/
	function _clean_string($string) {
	   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
	   $string = strtolower($string);	// Make lower all characters
	   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	}
	public function adminInnerView($viewName,$viewData = false)
	{
		$headerData = false;		
		if(isset($viewData['headerData']))
		{			
			$headerData = $viewData['headerData'];
		}		
		$this->load->view('adminHeader',$headerData);
		$this->load->view('adminSideMenu');
		$this->load->view($viewName,$viewData);
		$this->load->view('adminFooter');
	}
	
	public function randno($tot='')
	{
		if($tot=='')
		{
			$tot=6;	
		}
		return $randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $tot);	
	}
	/************* get client ip address ***************/
	function get_client_ip() {
	    $ipaddress = '';
	  	if (getenv('HTTP_CLIENT_IP'))
	        $ipaddress = getenv('HTTP_CLIENT_IP');
	    else if(getenv('HTTP_X_FORWARDED_FOR'))
	        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	    else if(getenv('HTTP_X_FORWARDED'))
	        $ipaddress = getenv('HTTP_X_FORWARDED');
	    else if(getenv('HTTP_FORWARDED_FOR'))
	        $ipaddress = getenv('HTTP_FORWARDED_FOR');
	    else if(getenv('HTTP_FORWARDED'))
	       $ipaddress = getenv('HTTP_FORWARDED');
	    else if(getenv('REMOTE_ADDR'))
	        $ipaddress = getenv('REMOTE_ADDR');
	    else
	        $ipaddress = 'UNKNOWN';
	    return $ipaddress;
	}
}

/* End of file admin.php */