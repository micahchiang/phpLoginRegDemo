<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	
class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->output->enable_profiler(TRUE);
		$this->load->model('User'); //connects to user model to input data into db.
		$this->load->helper('cookie');
	}

	public function index()
	{
		if ($this->session->userdata('userInformation')){
			redirect('/users/welcome');
		}
		else {
			$this->load->view('login');
		}
	}

	public function register()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|callback_paramCheck');
		$this->form_validation->set_rules('confirmPassword', 'Password Confirmation', 'required|matches[password]');

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
		$this->load->library('form_validation');
		$user = $this->input->post();
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$userData = $this->User->getUserByEmail($email);

		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('errors', validation_errors());
			redirect('/'); //if form doesn't pass validation, prevent login, show errors on page.
		}

		if($password == $userData['password'])
		{
			if($this->input->post('rememberMe')){
				$this->session->sess_expriration = 86400;
			}
			$user = array(
					'id' => $userData['id'],
					'username' => $userData['username'],
					'email' => $userData['email']
				);
		$this->session->set_userdata('userInformation', $user);
		redirect('/users/welcome');
		}
		else {
			$this->session->set_flashdata('loginError', 'username or password incorrect');
			redirect('/');
		}

	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('/');
	}
//Update Password
	public function changeUserPassword()
	{
		$this->load->Library('form_validation');
		$this->form_validation->set_rules('newPassword', 'Password', 'required');
		$this->form_validation->set_rules('confirmNewPassword', 'Password Confirmation', 'required');
		$password = $this->input->post('newPassword');
		if($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('errors', validation_errors());
			redirect('/users/welcome');
		}
		if ($password != $this->input->post('confirmNewPassword'))
		{
			$this->session->set_flashdata('alert', 'Passwords need to match');
			redirect('/users/welcome');
		}
		else
		{
			$user = $this->session->userdata('userInformation');
			$id = $user['id'];
			// var_dump($password);
			// die('in updatepassword');
			$this->User->updatePassword($password, $id);
			$this->session->set_flashdata('success', 'password has been updated!');
			redirect('/users/welcome');
		}
	}
//sets data, loads view.
	public function welcome()
	{
		$view_data['user'] = $this->session->userdata('userInformation');
		$members = $this->User->getAllUsers();
		$view_data['members'] = $members;
		// var_dump($members);
		// die('in welcome');
		$this->load->view('home', $view_data);
	}

//functions for partials
	public function updatePassword()
	{
		$this->load->view('/partials/updatePassword');
	}

	public function getMembers()
	{
		$members = $this->User->getAllUsers();
		$view_data['members'] = $members;
		$this->load->view('/partials/allMembers', $view_data);
	}


}

?>
