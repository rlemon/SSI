<?php

class User_Model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function userList()
	{
		$sth = $this->db->prepare('SELECT id, username, role FROM users');
		$sth->execute();
		return $sth->fetchAll();
	}
	
	public function userSingleList($id)
	{
		$sth = $this->db->prepare('SELECT id, username, role FROM users WHERE id = :id');
		$sth->execute(array(':id' => $id));
		return $sth->fetch();
	}
	
	public function create($data)
	{
		$sth = $this->db->prepare('INSERT INTO users 
			(`username`, `password`, `role`) 
			VALUES (:username, :password, :role)
			');
		
		$sth->execute(array(
			':username' => $data['username'],
			':password' => $data['password'],
			':role' => $data['role']
		));
	}
	
	public function editSave($data)
	{
		$sth = $this->db->prepare('UPDATE users
			SET `username` = :username, `password` = :password, `role` = :role
			WHERE id = :id
			');
		
		$sth->execute(array(
			':id' => $data['id'],
			':username' => $data['username'],
			':password' => md5($data['password']),
			':role' => $data['role']
		));
	}
	
	public function delete($id)
	{
		$sth = $this->db->prepare('DELETE FROM users WHERE id = :id');
		$sth->execute(array(
			':id' => $id
		));
	}
}
