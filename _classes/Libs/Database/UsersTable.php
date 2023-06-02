<?php

namespace Libs\Database;

use PDOException;

class UsersTable
{
	private $db;

	public function __construct(MySQL $mysql)
	{
		$this->db = $mysql->connect();
	}

	public function getAll(){
		try{
			$statement=$this->db->query("SELECT users.*,roles.name AS role,roles.value
			FROM users LEFT JOIN roles
			ON users.role_id=roles.id");

			return $statement->fetchAll();

		}catch(PDOException $e){
			echo $e->getMessage();
			exit();
		}
	}
	public function delete($id){
		try{
			$statement=$this->db->prepare("DELETE FROM users WHERE id=:id");
			$statement->execute([':id'=>$id]);

			return $statement->rowCount();
		}catch(PDOException $e){
			echo $e->getMessage();
			exit();
		}
	}

	public function suspended($id)
	{
		try{
			$statement=$this->db->prepare("UPDATE users SET suspended=1 WHERE id=:id");
			$statement->execute([':id'=>$id]);

			return $statement->rowCount();
		}catch(PDOException $e){
			echo $e->getMessage();
			exit();
		}
	}
	public function unsuspended($id)
	{
		try{
			$statement=$this->db->prepare("UPDATE users SET suspended=0 WHERE id=:id");
			$statement->execute([':id'=>$id]);

			return $statement->rowCount();
		}catch(PDOException $e){
			echo $e->getMessage();
			exit();
		}
	}

	public function changeRole($id,$role)
	{
		try{
			$statement=$this->db->prepare("UPDATE users SET role_id=:role WHERE id=:id");
			$statement->execute([':id'=>$id,':role'=>$role]);

			return $statement->rowCount();
		}catch(PDOException $e){
			echo $e->getMessage();
			exit();
		}
	}
	
	
	public function findByEmailAndPassword($email, $password)
	{
		try {

			// $statement = $this->db->prepare("SELECT * FROM users WHERE email=:email AND password=:password");
			// $statement->execute([ 'email' => $email, 'password' => $password ]);

			$statement = $this->db->prepare("SELECT * FROM users WHERE email=:email");
			$statement->execute([ 'email' => $email]);


			$user = $statement->fetch();

			if($user){
				if(password_verify($password,$user->password)){
					return $user;
				}
			}

			return $user ?? false;

		} catch (PDOException $e) {
			echo $e->getMessage();
			exit();
		}
	}

	public function updatePhoto($id, $photo)
	{
		try {

			$statement = $this->db->prepare("UPDATE users SET photo=:photo WHERE id=:id");
			$statement->execute(['photo' => $photo, 'id' => $id]);

			return $statement->rowCount();

		} catch (PDOException $e) {
			echo $e->getMessage();
			exit();
		}
	}

	public function insert($data)
	{
		try {
			$sql = "INSERT INTO users (name, email, phone, address, password, created_at) VALUES (:name, :email, :phone, :address, :password, NOW())";
			$statement = $this->db->prepare($sql);

			$data['password']=password_hash($data['password'],PASSWORD_DEFAULT);

			$statement->execute($data);

			return $this->db->lastInsertId();

		} catch(PDOException $e) {
			echo $e->getMessage();
			exit();
		}
	}
}
