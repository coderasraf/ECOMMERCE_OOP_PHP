<?php include 'inc/header.php'; ?>
<?php include 'inc/slider.php'; ?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Feature Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
	      <?php 
      		$product  = new Product();
      		$fm = new Format();
      		$getProduct = $product->getFproduct();
      		if ($getProduct) {
      			while ($row  = $getProduct->fetch_assoc()) { ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?productId=<?= $row['productId']; ?>"><img src="admin/<?= $row['image']; ?>" alt="" /></a>
					 <h2><?= $row['productName']; ?></h2>
						<p>
							<?= $fm->textShorten($row['body'], 50); ?>
						</p>
					 <p><span class="price">$<?= $row['price']; ?></span></p>
				     <div class="button"><span><a href="details.php?productId=<?= $row['productId']; ?>" class="details">Details</a></span></div>
				</div>
			<?php } } ?>
			</div>
			<div class="content_bottom">
    		<div class="heading">
    		<h3>New Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
				<?php 
	      		$product  = new Product();
	      		$fm = new Format();
	      		$getProduct = $product->getNproduct();
	      		if ($getProduct) {
	      			while ($row  = $getProduct->fetch_assoc()) { ?>
					<div class="grid_1_of_4 images_1_of_4">
						 <a href="details.php?productId=<?= $row['productId']; ?>"><img src="admin/<?= $row['image']; ?>" alt="" /></a>
						 <h2><?= $row['productName']; ?></h2>
							<p>
								<?= $fm->textShorten($row['body'], 50); ?>
							</p>
						 <p><span class="price">$<?= $row['price']; ?></span></p>
					     <div class="button"><span><a href="details.php?productId=<?= $row['productId']; ?>" class="details">Details</a></span></div>
					</div>
				<?php } } ?>
			</div>
    </div>
 </div>
</div>
 <?php include 'inc/footer.php'; ?>