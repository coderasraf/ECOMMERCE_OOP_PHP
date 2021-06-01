<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Category.php';?>


<?php 

    $db = new Database();
    
    $cat = new Category();
    if (!isset($_GET['catId']) || $_GET['catId'] == NULL || $_GET['catId'] == '') {
        echo "<script>window.location = 'catlist.php'</script>";
    }else{
        $catId = mysqli_real_escape_string($db->link,$_GET['catId']);
          if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $catName = $_POST['catName'];
            $catUpdate  = $cat->catUpdate($catName, $catId);
        }
    }

 ?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Edit Category</h2>
               <div class="block copyblock"> 
                <?php 
                    if (isset($catUpdate)) {?>
                            <?php echo $catUpdate; ?>
                    <?php } ?>
                 <form method="POST" action="">
                    <table class="form">					
                        <tr>
                            <td>
                                <?php 
                                    $select = $cat->getCatById($catId);
                                    if ($select) {
                                       $result = $select->fetch_assoc();
                                    }
                                 ?>
                                <input value="<?= $result['catName'];   ?>" name="catName" type="text" placeholder="Enter Category Name..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    <a href="catlist.php">Back Category List</a>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>