<?php 

	class Customer{
		private $db;
		private $fm;
		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}

		// Inserting user
		public function insertCustomer($data){
			$name 		= $this->fm->validation($data['name']);
			$email 		= $this->fm->validation($data['email']);
			$zip        = $this->fm->validation($data['zip']);
			$city       = $this->fm->validation($data['city']);
			$address    = $this->fm->validation($data['address']);
			$country    = $this->fm->validation($data['country']);
			$phone      = $this->fm->validation($data['phone']);
			$password   = $this->fm->validation($data['password']);
			$name       = mysqli_real_escape_string($this->db->link, $name);
			$email      = mysqli_real_escape_string($this->db->link, $email);
			$city       = mysqli_real_escape_string($this->db->link, $city);
			$address    = mysqli_real_escape_string($this->db->link, $address);
			$country    = mysqli_real_escape_string($this->db->link, $country);
			$phone      = mysqli_real_escape_string($this->db->link, $phone);
			$password   = mysqli_real_escape_string($this->db->link, $password);
			$password   = md5($password);

			// Checking email already exist or not
			$emailChek = "SELECT * FROM tbl_customer WHERE email = '$email' LIMIT 1";
			$chekMail   = $this->db->select($emailChek);

			if ($name == '' || $email == '' || $zip == '' || $city == '' || $address == '' || $country == '' || $phone == '' || $password == '') {
				$msg = "<div class='alert alert-warning'>Fields must not be empty!</div>";
				return $msg;
			}elseif(filter_var($email, FILTER_VALIDATE_EMAIL) == FALSE){
				$msg = "<div class='alert alert-warning'>E-mail is not valid!</div>";
				return $msg;
			}elseif($chekMail != false){
				$msg = "<div class='alert alert-warning'>E-mail is already exist!</div>";
				return $msg;
			}else{
				$query ="INSERT INTO tbl_customer 
						(name,address,city,country,zip,phone,email,pass) VALUES
						('$name','$address','$city','$country','$zip','$phone','$email','$password')";
				$insertCust = $this->db->insert($query);
				if ($insertCust) {
					$msg = "<div class='alert alert-success'>Your account succesfully created!</div>";
					return $msg;
				}else{
					$msg = "<div class='alert alert-warning'>Something went worng!</div>";
					return $msg;
				}
			}

		}
	}
