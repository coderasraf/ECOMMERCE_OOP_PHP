<?php include 'inc/header.php'; ?>
<?php 
	if (!isset($_GET['productId']) || $_GET['productId'] == NULL || $_GET['productId'] == '') {
		echo "<script>window.location = 'index.php'</script>";
	}else{
		$productId = $_GET['productId'];
	}


	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$quantity = $_POST['quantity'];
		$addCart = $cart->addToCart($productId,$quantity);
	}


 ?>

 <div class="main">
    <div class="content">
    	<div class="section group">
    		<?php 

    			$getPd  = new Product();
    			$fm = new Format();
    			$getSingleProduct = $getPd->getSingleProduct($productId);
    			if ($getSingleProduct) {
    				$row = $getSingleProduct->fetch_assoc();
    			}

    		 ?>
				<div class="cont-desc span_1_of_2">				
					<div class="grid images_3_of_2">
						<img src="admin/<?= $row['image']; ?>" alt="" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?= $row['productName']; ?></h2>
					<div>
						<?= $fm->textShorten($row['body'],200); ?>	
						<a href="#more">See More</a>
					</div>			
					<div class="price">
						<p>Price: <span>$<?= $row['price']; ?></span></p>
						<p>Category: <span><?= $row['catName']; ?></span></p>
						<p>Brand:<span><?= $row['brandName']; ?></span></p>
					</div>
				<div class="add-cart">
					<form action="" method="POST">
						<input name="quantity" type="number" class="buyfield" name="" value="1"/>
						<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
					</form>				
				</div>
			</div>
			<div class="product-desc" id="more">
			<h2>Product Details</h2>
			<?= $row['body']; ?>
	    </div>
				
	</div>
				<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>
					<ul>
						<?php 

							$cat = $cat->getCategory();
							if ($cat) {
								while ($row = $cat->fetch_assoc()) {?>
				      		<li><a href="productbycat.php?catId=<?= $row['catId']; ?>"><?= $row['catName']; ?></a></li>
							<?php } } ?>
    				</ul>
    	
 				</div>
 		</div>
 	</div>
	</div>
  <?php include 'inc/footer.php'; ?>