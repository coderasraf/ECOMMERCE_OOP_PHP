<?php include 'lib/Database.php'; ?>
<?php include '../helpers/Format.php'; ?>

<?php 

	class Cart{

		private $db;
		private $fm;

		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}
	}

 ?>