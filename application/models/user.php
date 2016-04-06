<?php

class User extends CI_Model{

public function add_user($user)
{
	$query = "INSERT INTO users (username, email, password, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())";
	$values = array($user['username'], $user['email'], $user['password']);
	// var_dump($values);
	// die('in add_user');
	return $this->db->query($query, $values);
}

public function getUserByEmail($email)
{
	$query = "SELECT id, username, email, password FROM users WHERE email = ?";
	$values = array($email);
	return $this->db->query($query, $values) -> row_array();
}

public function getAllUsers()
{
	$query = "SELECT * FROM users";
	return $this->db->query($query) -> result_array();
}

public function updatePassword($password, $id)
{
	$query = "UPDATE users SET password = ?, updated_at = NOW() WHERE id = ?";
	$values = array($password, $id);
	// var_dump($values);
	// die('in updatePassword');
	return $this->db->query($query, $values);
}

}
?>