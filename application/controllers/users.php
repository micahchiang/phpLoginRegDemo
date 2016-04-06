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
		if ($this->input->cookie('testname', TRUE)){ 
			// var_dump($this->input->cookie('testname', TRUE));
			// die('in index()');
			$email = $this->input->cookie('testname');
			$userData = $this->User->getUserByEmail($email);
			if ($userData){
				$user = array(
					'id' => $userData['id'],
					'username' => $userData['username'],
					'email' => $userData['email'],
					);
				}
			$this->session->set_userdata('userInformation', $user);
			redirect('/users/welcome');
		}
		// else {
			$this->load->view('login');
		// }
	}

	public function register()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
		$this->form_validation->set_rules('confirmPassword', 'Password Confirmation', 'required|matches[password]');

		$password = $this->input->post('password');

		// var_dump($password);
		// die('in register');
		if($this->password_check($password) == FALSE){
			$this->session->set_flashdata('stronger', 'password needs at least one number and one capital letter');
			redirect('/');
		}

		if($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('errors', validation_errors());
			redirect('/'); //if form doesn't pass validation, prevent login, show errors on page.
		}
		else
		{
			$user = $this->input->post();
			$this->User->add_user($user);

			if($this->input->post('rememberMe'))
			{
				$cookie = array(
						'name' => 'testname',
						'value' => $user['email'],
						'expire' => '86400'
					);
				$this->input->set_cookie($cookie);	
			}

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
				$cookie = array(
						'name' => 'testname',
						'value' => $user['email'],
						'expire' => '86400'
					);
				$this->input->set_cookie($cookie);	
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
		delete_cookie('testname');
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
//validation
	public function password_check($str)
	{
		$test = strtolower($str);
		if (!is_numeric($str) && $test == $str){
			return FALSE;
		}
		return TRUE;
	}

}

?>
