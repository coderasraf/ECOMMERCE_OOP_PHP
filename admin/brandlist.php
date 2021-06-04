<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include 'classes/Brand.php';?>

<?php 
	
	$brand = new Brand();

	if (isset($_GET['delbrand'])) {
		$delbrand = $_GET['delbrand'];
		$deleteBrand = $brand->deleteBrand($delbrand);

	}

 ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Brand Lists</h2>
                <?php 

                	if (isset($deleteBrand)) {
                		echo $deleteBrand;
                	}

                 ?>
                <div class="block">      
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Brand Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$getBrand = $brand->getAllBrand(); 
							if ($getBrand) {
								$i = 0;
								foreach ($getBrand as $value) {
									$i++;?>
								<tr class="odd gradeX">
									<td><?= $i; ?></td>
									<td><?= $value['brandName'] ?></td>
									<td><a href="brandedit.php?brandId=<?= $value['brandId']; ?>">Edit</a> || <a onclick="return confirm('Are you sure to delete this category');"href="?delbrand=<?= $value['brandId']; ?>">Delete</a></td>
								</tr>
							<?php } }else{ ?>
								<tr>
									<td>Category Not found!</td>
								</tr>
							<?php } ?>
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

