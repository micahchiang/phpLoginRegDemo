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
