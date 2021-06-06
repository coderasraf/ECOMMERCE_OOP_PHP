
<?php 

	class Cart{

		private $db;
		private $fm;

		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}

		// Get all customer ordr form database
		public function getAllOrder(){
			$query = "SELECT o.*, c.address  
					FROM tbl_order as o, tbl_customer as c 
					WHERE o.cmrId = c.id";
			$result = $this->db->select($query);
			if ($result) {
				return $result;
			}else{
				return false;
			}
		}


}
