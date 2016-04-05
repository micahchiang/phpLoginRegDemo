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

	public function register()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('confirmPassword', 'Password Confirmation', 'required');

		if($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('errors', validation_errors());
			redirect('/'); //if form doesn't pass validation, prevent login, show errors on page.
		}
		else
		{
			$user = $this->input->post();
			// var_dump($user);
			// die('in register method');
			$this->User->add_user($user);
		}
	}
}

?>
