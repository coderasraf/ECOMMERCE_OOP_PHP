<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Classes.php';?>


<?php 

    $db = new Database();
    
    $product = new Product();
    if (!isset($_GET['productID']) || $_GET['productID'] == NULL || $_GET['productID'] == '') {
        echo "<script>window.location = 'productlist.php'</script>";
    }else{
        $productID = mysqli_real_escape_string($db->link,$_GET['productID']);
          if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $productUpdate  = $product->productUpdate($_POST, $productID, $_FILES);
        }
    }

 ?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Edit Product</h2>
                 <?php 
					if (isset($productUpdate)) {?>
				        <?php echo $productUpdate; ?>
				<?php } ?>
               <div class="block">               
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
                <?php 
				    $select = $product->getProductByID($productID);
				    if ($select) {
				       $result = $select->fetch_assoc();
				    }
				 ?>	
                <tr>
                    <td>
                        <label>Update Name</label>
                    </td>
                    <td>
                        <input value="<?= $result['productName']; ?>" name="productName" type="text" placeholder="Enter Product Name..." class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Update Category</label>
                    </td>
                    <td>
                        <select id="select" name="catId">
                            <option>Select Category</option>
                            <?php 

                                $category = new Category();
                                $getCat = $category->getAllCat();
                                if ($getCat) {
                                  while ($row = $getCat->fetch_assoc()) {?>
                                    <option
                                    <?php 
                                    	if ($row['catId'] == $result['catId']) {
                                    		echo "selected";
                                    	}
                                     ?>
                                     value="<?= $row['catId']; ?>"><?= $row['catName']; ?></option>
                                <?php }} ?>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Update Brand</label>
                    </td>
                    <td>
                        <select id="select" name="brandId">
                            <option>Select Brand</option>
                           <?php 

                                $brand = new Brand();
                                $getBrand = $brand->getAllBrand();
                                if ($getBrand) {
                                  while ($row = $getBrand->fetch_assoc()) {?>
                                    <option 
                                    <?php if ($row['brandId'] == $result['brandId']) {
                                    	echo "selected";
                                    } ?>
                                    value="<?= $row['brandId']; ?>"><?= $row['brandName']; ?></option>
                                <?php }} ?>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Update Image</label>
                    </td>
                    <td>
                        <input name="image" type="file" />
                        <img width="80px" height="80px;" style="object-fit: contain;" src="<?= $result['image']; ?>">
                    </td>
                </tr>
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea name="body" class="tinymce">
                        	<?= $result['body']; ?>
                        </textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Update</label>
                    </td>
                    <td>
                        <input value="<?= $result['price'] ?>" name="price" type="text" placeholder="Enter Price..." class="medium" />
                    </td>
                </tr>
            	
				<tr>
                    <td>
                        <label>Update Product type</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option>Select Type</option>
                            
                            <option 
							<?php if ($result['type'] == '0') { echo "selected"; } ?>
                            value="0">Featured</option>
                            <option
                            <?php if ($result['type'] == '1') { echo "selected"; } ?>
                             value="1">Non-Featured</option>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
            </div>
        </div>
        <!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>