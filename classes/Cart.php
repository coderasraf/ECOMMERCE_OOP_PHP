<?php 
	class Cart{

		private $db;
		private $fm;

		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}

		// Add to cart product
		public function addToCart($productId, $quantity){
			$quantity = $this->fm->validation($quantity);
			$productId = mysqli_real_escape_string($this->db->link, $productId);
			$quantity  = mysqli_real_escape_string($this->db->link, $quantity);
			$sId       = session_id();
			$sQuery    = "SELECT * FROM tbl_shop WHERE productId='$productId'";
			$result    = $this->db->select($sQuery)->fetch_assoc();
			$productName = $result['productName'];
			$productPrice= $result['price'];
			$productImg  = $result['image'];

			$checkQuery    = "SELECT * FROM tbl_cart WHERE productId='$productId' AND sId='$sId'";
			$chk = $this->db->select($checkQuery);
			
			if ($chk != true) {
				$query ="INSERT INTO tbl_cart (sId,productId,productName,price,quantity,image)
				VALUES ('$sId','$productId','$productName','$productPrice','$quantity','$productImg')";
				$addedToCart = $this->db->insert($query);
				if ($addedToCart) {
					echo "<script>window.location = 'cart.php'</script>";
				}else{
					echo "<script>window.location = 'index.php'</script>";
				}
			}else{
				echo "<script>alert('Product Alreay Exist!')</script>";
			}
			
		}

		// getting cart product
		public function getCartProducts($sId){
			$query = "SELECT * FROM tbl_cart WHERE sId='$sId' ORDER BY cartId DESC";
			$result = $this->db->select($query);
			return $result;
		}

		// Updating product quantity
		public function cartUpdate($quantity,$cartId){
			$query ="UPDATE tbl_cart SET quantity = '$quantity' WHERE cartId = '$cartId'";
			$update = $this->db->update($query);
			if ($update) {
                  header("Location:cart.php");
			}else{
				$msg = "<div class='alert alert-warning'>Cart not Updated Successuflly!</div>";
                  return $msg;
			}
		}

		// removing cart item form cart
		public function removeCart($removeId){
			$query = "DELETE FROM tbl_cart WHERE cartId='$removeId'";
			$delete = $this->db->delete($query);
			if ($delete) {
				$msg = "<div class='alert alert-success'>Item Deleted Successuflly!</div>";
                 return $msg;
                 header("Location:cart.php");
			}
		}

		// Check cart item
		public function checkCart(){
			$sId       = session_id();
			$sQuery    = "SELECT * FROM tbl_cart WHERE sId='$sId'";
			$result    = $this->db->select($sQuery);
			return $result;
		}

		// Delete cart item when customer logout
		public function deleteCustomerCart(){
			$sessionId = session_id();
			$query = "DELETE FROM tbl_cart WHERE sId='$sessionId'";
			$result = $this->db->delete($query);
			return $result;
		}

		// Inserting customer order to the database
		public function insertCustomerOrder($id,$cmrId){
			// Retrive data from data base to insert order table
			$select ="SELECT * FROM tbl_cart WHERE sId='$id'";
			$result = $this->db->select($select);
			if ($result) {
					$row = $result->fetch_assoc();
					$productId = $row['productId'];
					$sId = $row['sId'];
					$productName = $row['productName'];
					$price  = $row['price'];
					$image = $row['image'];
					$quantity = $row['quantity'];
			}
			// Insert this customer data to the database
			$query ="INSERT INTO tbl_order
					(cmrId,productId,productName,quantity,price,image) 
					values
					('$cmrId','$productId','$productName','$quantity','$price','$image')";
			$insertOrder = $this->db->insert($query);
			if ($insertOrder) {
				// after completing order it will be automatically delete all cart item
				$deleteQuery = "DELETE FROM tbl_cart WHERE sId='$id'";
				$delete = $this->db->delete($deleteQuery);
				if ($delete) {
	                 header("Location:success.php");
				}
			}
		}

		// Getting customer all order
		public function getOrderProducts($cmrId){
			$query = "SELECT * FROM tbl_order WHERE cmrId='$cmrId' ORDER BY id DESC";
			$result = $this->db->select($query);
			if ($result) {
				return $result;
			}else{
				return false;
			}
		}

		// Check order data have or not
		public function checkOrder($cmrId){
			$select ="SELECT * FROM tbl_order WHERE cmrId='$cmrId'";
			$result = $this->db->select($select);
			if ($result) {
				return $result;
			}else{
				return false;
			}
		}

		// fetching order details from order table for showing customer
		public function paybaleAmount($cmrId){
			$query ="SELECT * FROM tbl_order WHERE cmrId='$cmrId' AND date = now()";
			$select = $this->db->select($query);
			if ($select) {
				return $select;
			}else{
				return false;
			}
		}

	}
