<?php include 'inc/header.php'; ?>
<?php 
	$custLogin = Session::get('custLogin');
	if ($custLogin == false) {
		header("Location:login.php");
	}
 ?>
 <div class="main">
    <div class="content">
  		<h2 style="margin-bottom: 10px;border-bottom: 1px solid #ddd;padding-bottom: 5px;">Your Order Details</h2>
      <div class="order-table">
         <table class="tblone">
            <tr>
               <th>No</th>
               <th>Product Name</th>
               <th>Image</th>
               <th>Quantity</th>
               <th>Price</th>
               <th>Date</th>
               <th>Status</th>
               <th>Action</th>
            </tr>

            <?php 
               $cmrId  = Session::get('cmrId'); 
               $cart = $cart->getOrderProducts($cmrId);
               if ($cart) {
                  $sum = 0;
                  $qty = 0;
                  $i = 0;
                     while ($row = $cart->fetch_assoc()) { $i++; ?>
               <tr>
                  <td><?= $i; ?></td>
                  <td><?= $row['productName']; ?></td>
                  <td><img src="admin/<?= $row['image']; ?>" alt=""/></td>
                  <td>
                     <form action="" method="post">
                        <input type="text" hidden="" name="cartId" value="<?= $row['cartId']; ?>"/>
                        <input readonly="" type="number" name="quantity" value="<?= $row['quantity']; ?>"/>
                        
                     </form>
                  </td>
                  <td>$<?php
                        $total = $row['price'] * $row['quantity'];
                        echo $total; 
                      ?>   
                  </td>
                  <td><?= $fm->formatDate($row['date']); ?></td>
                  <td>
                     <?php 
                        if ($row['status'] == '0') {
                           echo "<span style='color:#fff;background:tomato;padding:5px 8px;border-radius:5px;'>Pending..</span>";
                        }else{
                            echo "<span style='color:#fff;background:green;padding:5px 8px;border-radius:5px;'>Completed</span>";
                        }
                      ?>
                  </td>
                  <td>
                     <?php 
                        if ($row['status'] == '1') {?>
                        <a href="?removeCart=<?=$row['cartId']; ?>">❌</a>
                     <?php }else{ ?>
                        <?php echo 'N/A'; ?>
                     <?php } ?>
                  </td>
               </tr>
               <?php } } ?>
         </table>
      </div>
    </div>
 </div>
</div>
 <?php include 'inc/footer.php'; ?>