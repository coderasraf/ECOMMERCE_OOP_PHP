<?php include 'inc/header.php'; ?>
<?php 

	if (isset($_GET['catId'])) {
			$id = $_GET['catId'];
			$catTitle = $cat->getCategoryByID($id);
			if ($catTitle) {
				$title = $catTitle->fetch_assoc();
			}
	}

 ?>
 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Latest from <?= $title['catName']; ?></h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">

	      	<?php 

	      		$getProductByCat = $cat->getProductByCat($id);
	      		if ($getProductByCat) {
	      			while ($row = $getProductByCat->fetch_assoc()) { ?>
						<div class="grid_1_of_4 images_1_of_4">
							 <a href="details.php"><img src="admin/<?= $row['image']; ?>" alt="" /></a>
							 <h2><?= $row['productName']; ?> </h2>
							 <p><?= $fm->textShorten($row['body'], 80); ?></p>
							 <p><span class="price">$<?= $row['price']; ?></span></p>
						     <div class="button"><span><a href="details.php?productId=<?= $row['productId']; ?>" class="details">Details</a></span></div>
						</div>
					<?php }}else{ ?>
						<div class="alert">
							<h1 style="font-size:40px;text-align: center;padding: 20px;">Product Not available in <span style="color:red"><?php echo $title['catName']; ?></span></h1>
						</div>
					<?php } ?>
			</div>
    </div>
 </div>
</div>
  <?php include 'inc/footer.php'; ?>