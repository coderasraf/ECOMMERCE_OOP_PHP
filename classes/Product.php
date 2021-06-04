<?php 
	class Product {
		
		private $db;
		private $fm;

		function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}


		// Getting featured product
		public function getFproduct(){
			$query = "SELECT * FROM tbl_shop WHERE type='0'  ORDER BY productId DESC LIMIT 4";
			$select = $this->db->select($query);
			if ($select) {
				return $select;
			}else{
				return false;
			}
		}

		// Getting New product
		public function getNproduct(){
			$query = "SELECT * FROM tbl_shop ORDER BY productId DESC LIMIT 4";
			$select = $this->db->select($query);
			if ($select) {
				return $select;
			}else{
				return false;
			}
		}

		// Getting single product details
		public function getSingleProduct($productId){
			$query = "SELECT p.*, c.catName, b.brandName 
					FROM tbl_shop as p, tbl_category as c, tbl_brand as b 
					WHERE p.catId = c.catId AND p.brandId = b.brandId AND p.productId='$productId'";

			$getP = $this->db->select($query);
			if ($getP) {
				return $getP;
			}else{
				return false;
			}
		}

		// Latest from Iphone brand
		public function latestFromIphone(){
			$query = "SELECT p.*, b.brandName 
					FROM tbl_shop as p, tbl_brand as b 
					WHERE p.brandId = b.brandId AND b.brandName='iPhone'";
			$result = $this->db->select($query);
			if ($result) {
				return $result;
			}else{
				return false;
			}
		}

	}

	

 ?>