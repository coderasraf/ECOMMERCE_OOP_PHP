<?php 
	include '../lib/Database.php';
	include '../lib/Session.php';
	Session::checkLogin();
	include '../helpers/Format.php';
 ?>

<?php 
class AdminLogin {
	
	private $db;
	private $fm;

	public function __construct()
	{
		$this->db  = new Database();
		$this->fm   = new Format();
	}

	public function adminLogin($adminUser,$adminPass){
		$adminUser = $this->fm->validation($adminUser);
		$adminPass = $this->fm->validation($adminPass);

		$adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
		$adminPass = mysqli_real_escape_string($this->db->link, $adminPass);

		if (empty($adminUser) || empty($adminPass)) {
			$msg = "Username & Password must not be empty!";
			return $msg;
		}else{
			$query = "SELECT * FROM tbl_admin WHERE adminUser='$adminUser' AND adminPass='$adminPass'";
			$result = $this->db->select($query);
			if ($result != false) {
				$value = $result->fetch_assoc();
				Session::set('adminLogin', true);
				Session::set('adminId', $value['id']);
				Session::set('adminUser', $value['adminUser']);
				Session::set('adminEmail', $value['adminEmail']);
				Session::set('adminName', $value['adminName']);
				header("Location:dashboard.php");
			}else{
				$msg = "Username or password not match!";
			return $msg;
			}
		}
	}
}