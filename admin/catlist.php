<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include 'classes/Category.php';?>

<?php 
	
	$category = new Category();

	if (isset($_GET['delcat'])) {
		$delcat = $_GET['delcat'];
		$delete = $category->delete($delcat);
	}

 ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <div class="block"> 
                <?php 
                	if (isset($delete)) {
                		echo $delete;
                	}
                 ?>       
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$getCat = $category->getAllCat(); 
							if ($getCat) {
								$i = 0;
								foreach ($getCat as $value) {
									$i++;?>
								<tr class="odd gradeX">
									<td><?= $i; ?></td>
									<td><?= $value['catName'] ?></td>
									<td><a href="catedit.php?catId=<?= $value['catId']; ?>">Edit</a> || <a onclick="return confirm('Are you sure to delete this category');"href="?delcat=<?= $value['catId']; ?>">Delete</a></td>
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

