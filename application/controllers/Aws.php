<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Aws extends CI_Controller {
	


	public function index()
	{							
			
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
		

		require 'vendor/autoload.php';
		require 'application/aws/aws-autoloader.php';

		$this->load->view('aws_test');	
	}

}
