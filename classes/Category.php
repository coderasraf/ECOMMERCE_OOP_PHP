<?php 
	include '../lib/Database.php';
	include '../helpers/Format.php';
 ?>

<?php

	class Category{

		private $db;
		private $fm;

		function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}

		// Insert category Item into Database
		public function catInsert($catName){
			$catName = $this->fm->validation($catName);
			$catName = mysqli_real_escape_string($this->db->link, $catName);

			if (empty($catName)) {
				$msg = "<div class='alert alert-warning'>Category field must not be empty!</div>";
				return $msg;
			}else{

				$selectExist = "SELECT * FROM tbl_category WHERE catName='$catName'";
				$result      = $this->db->select($selectExist);
				if ($result != false) {
					$msg = "<div class='alert alert-warning'>Your category already exist</div>";
					return $msg;
				}else{
					$query  = "INSERT INTO tbl_category(catName) VALUES('$catName')";
					$insert = $this->db->insert($query);
					if ($insert) {
						$msg = "<div class='alert alert-success'>Category inserted Successfully!</div>";
						return $msg;
					}else{
						$msg = "Category Not inserted Successfully";
						return $msg;
					}
				}
			}
		}


		// Select all categories
		public function getAllCat(){
			$query  = "SELECT * FROM tbl_category ORDER BY catId DESC";
			$select = $this->db->select($query);
			return $select;
		}

		// Update Category
		public function catUpdate($catName, $catId){
			$select = "SELECT * FROM tbl_category WHERE catName='$catName'";
			$result = $this->db->select($select);
			$catName = $this->fm->validation($catName);
			$catName = mysqli_real_escape_string($this->db->link, $catName);

			if ($result != false) {
				$msg = "<div class='alert alert-warning'>This category name already exist</div>";
					return $msg;
			}else{
				if ($catName == '') {
					$msg = "<div class='alert alert-warning'>Category field must not be empty!</div>";
					return $msg;
				}else{
					$query = "UPDATE tbl_category SET catName = '$catName' WHERE catId = '$catId'";
					$update = $this->db->update($query);
					if ($update) {
						$msg = "<div class='alert alert-success'>Category Updated Successfully!</div>";
						return $msg;
					}
				}
			}
		}

		// Get category by ID
		public function getCatById($catId){
			$query = "SELECT * FROM tbl_category WHERE catId='$catId'";
			$result = $this->db->select($query);
				return $result;
		}

		// Delete category by ID
		public function delete($delcat){
			$query = "DELETE FROM tbl_category WHERE catId='$delcat'";
			$delete = $this->db->delete($query);
			if ($delete) {
				$msg = "<div class='alert alert-success'>Category Deleted Successfully!</div>";
				return $msg;
			}
		}



	}// End main class
