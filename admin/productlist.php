<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Classes.php';?>

<?php 

	$product = new Product();
	
	if (isset($_GET['deleteID'])) {
		$deleteId = $_GET['deleteID'];
		$delete = $product->deleteProductByID($deleteId);
		echo "<script>window.location = 'productlist.php'</script>";
	}

 ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <?php 
        	if (isset($delete)) {
        		echo $delete;
        	}
         ?>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>SL</th>
					<th>Product Name</th>
					<th>Description</th>
					<th>Category</th>
					<th>Brand</th>
					<th>Price</th>
					<th>Image</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$product = new Product();
					$fm      = new Format();
					$getProduct = $product->getProduct();
					$i = 0;
					if ($getProduct) {
						while ($row = $getProduct->fetch_assoc()) { $i++;?>
					<tr class="odd gradeX">
						<td><?= $i; ?></td>
						<td><?= $row['productName']; ?></td>
						<td><?= $fm->textShorten($row['body'],30); ?></td>
						<td><?= $row['catName']; ?></td>
						<td><?= $row['brandName']; ?></td>
						<td><?= $row['price']; ?></td>
						<td>
							<img style="object-fit: contain;" width="40px" height="40px" src="<?= $row['image']; ?>">
						</td>
						<td class="center">
							<?php
						 		if ($row['type'] == '0') {
						 		 	echo "Featured";
						 		 }else{
						 		 	echo "Unfeatured";
						 		 } 
						 	?>
						 </td>
						<td><a href="editproduct.php?productID=<?= $row['productId']; ?>">Edit</a> || <a onclick="return confirm('Are you sure to delete!')" href="?deleteID=<?= $row['productId']; ?>">Delete</a></td>
					</tr>
			<?php } } ?>
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
