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
			$this->User->add_user($user);

			$userData = $this->User->getUserByEmail($this->input->post('email'));
			if($userData)
			{
				$user = array(
						'id' => $userData['id'],
						'username' => $userData['username'],
						'email' => $userData['email'],
					);
			}
			$this->session->set_userdata('userInformation', $user);
			redirect('/users/welcome');
		}
	}

	public function login()
	{
		$user = $this->input->post();
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$userData = $this->User->getUserByEmail($email);

		if($password == $userData['password'])
		{
			$user = array(
					'id' => $userData['id'],
					'username' => $userData['username'],
					'email' => $userData['email']
				);
		}
		$this->session->set_userdata('userInformation', $user);
		redirect('/users/welcome');
	}

	public function welcome()
	{
		$view_data['user'] = $this->session->userdata('userInformation');
		// var_dump($view_data['user']);
		// die('in welcome');
		$this->load->view('home', $view_data);
	}
}

?>
