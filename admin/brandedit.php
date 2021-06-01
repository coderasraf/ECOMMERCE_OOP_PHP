<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Brand.php';?>


<?php 

    $db = new Database();
    
    $brand = new Brand();
    if (!isset($_GET['brandId']) || $_GET['brandId'] == NULL || $_GET['brandId'] == '') {
        echo "<script>window.location = 'brandlist.php'</script>";
    }else{
        $brandId = mysqli_real_escape_string($db->link,$_GET['brandId']);
          if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $brandName = $_POST['brandName'];
            $brandUpdate  = $brand->brandUpdate($brandName, $brandId);
        }
    }

 ?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Edit Brand</h2>
               <div class="block copyblock"> 
                <?php 
                    if (isset($brandUpdate)) {?>
                            <?php echo $brandUpdate; ?>
                    <?php } ?>
                 <form method="POST" action="">
                    <table class="form">					
                        <tr>
                            <td>
                                <?php 
                                    $select = $brand->getBrandById($brandId);
                                    if ($select) {
                                       $result = $select->fetch_assoc();
                                    }
                                 ?>
                                <input value="<?= $result['brandName'];   ?>" name="brandName" type="text" placeholder="Enter Category Name..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    <a href="brandlist.php">Back Brand List</a>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>