<?php

class Database{
	private $connection;
	function __construct()
	{
		$this->connect_db();
	}
 
	public function connect_db(){
		$this->connection = mysqli_connect('localhost','root','','users_auth');
	
		if(mysqli_connect_error()){
			die("<hr> <br>Database Connection Failed<br>" . mysqli_connect_error() ."<br>". mysqli_connect_errno());
		}
	}
 
	public function createSignup($fname, $email, $password){
	   //insert login credentials in db.
	   	$hash = password_hash($password, PASSWORD_DEFAULT);
		$sql = "INSERT INTO signup (fname, email, password)
		VALUES ('$fname', '$email', '$hash')";
		$res = mysqli_query($this->connection, $sql);
		if($res){
	 		return true; 
		}else{
			die("err".mysqli_error($this->connection));
			return false;
		}
	}

	public function emailValidation($email){
		//check whethere email already exists or not.
		$exist_email = "SELECT * FROM signup WHERE email = '$email'";
		$result = mysqli_query($this->connection, $exist_email);
		return $result;
	}


	public function createLogin($fname){
		$sql = "SELECT * FROM signup WHERE fname = '$fname'";
		$res = mysqli_query($this->connection, $sql);
		return $res;
	}
	
	public function userProfile($profile_picture){
		$sql = "INSERT INTO signup (profile_picture)
		VALUES ('$profile_picture')";
		$res = mysqli_query($this->connection, $sql);
		return $res;
	}

	//update profile
	public function updateProfile($fname, $email, $id){
		$sql = "UPDATE signup SET fname='$fname', email='$email' WHERE id=$id";
		$res = mysqli_query($this->connection, $sql);
		if($res){
			return true;
		}else{
			return false;
		}
	}

	public function read($id=null){
		$sql = "SELECT * FROM signup";
		if($id){ $sql .= " WHERE id=$id";}
 		$res = mysqli_query($this->connection, $sql);
 		return $res;
	}


	public function sanitize($var){
		$return = mysqli_real_escape_string($this->connection, $var);
		return $return;
	}
}
 
	$database = new Database();
?>