<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	
class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->output->enable_profiler(TRUE);
		$this->load->model('User'); //connects to user model to input data into db.
	}

	public function index()
	{
		$this->load->view('login');
	}
}

?>
