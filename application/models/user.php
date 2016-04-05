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

}
?>