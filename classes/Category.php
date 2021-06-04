<?php 

class Category{
	private $db;
	private $fm;

	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}

	// Getting all categories
	public function getCategory(){
		$query ="SELECT * FROM tbl_category";
		$select = $this->db->select($query);
		if($select){
			return $select;
		}else{
			return false;
		}
	}

	// get category by id

	public function getCategoryByID($id){
		$query = "SELECT * FROM tbl_category WHERE catId='$id'";
		$result = $this->db->select($query);
		if ($result) {
			return $result;
		}else{
			return false;
		}
	}

	public function getProductByCat($id){
		$query = "SELECT * FROM tbl_shop WHERE catId='$id'";
		$result = $this->db->select($query);
		if ($result) {
			return $result;
		}else{
			return false;
		}
	}


}