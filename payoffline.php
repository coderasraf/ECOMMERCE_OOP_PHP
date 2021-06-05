<?php include 'inc/header.php'; ?>
<?php 
	$custLogin = Session::get('custLogin');
	if ($custLogin == false) {
		header("Location:login.php");
	}
 ?>

<?php 
   
   if (isset($_GET['orderId']) && $_GET['orderId'] == 'order') {
      $cmrId  = Session::get('cmrId');
      $sId = session_id();
      $insertOrder = $cart->insertCustomerOrder($sId,$cmrId);
   }

 ?>

 <style>
.tblone{width: 100%;margin: 0 auto;border: 2px solid #ddd;}.tblone tr td{text-align: justify;}
</style>
 <div class="main">
    <div class="content">
  		<div class="section group custom-section ">
         <div class="division">
            <?php 
   
                  if (isset($removeCart)) {
                     echo "<div class='none'>".$removeCart."</div>";
                  }
                ?>
                  <table class="tblone">
                     <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                     </tr>

                     <?php
                        $getData = $cart->checkCart();
                        if ($getData) {?>

                     <?php 
                        $sessionId  = session_id();
                        $cart = $cart->getCartProducts($sessionId);
                        if ($cart) {
                           $sum = 0;
                           $qty = 0;
                              while ($row = $cart->fetch_assoc()) {?>
                        <tr>
                           <td><?= $row['productName']; ?></td>
                           <td>Tk. <?= $row['price']; ?></td>
                           <td>
                              <form action="" method="post">
                                 <input type="text" hidden="" name="cartId" value="<?= $row['cartId']; ?>"/>
                                 <input type="number" name="quantity" value="<?= $row['quantity']; ?>"/>
                                
                              </form>
                           </td>
                           <td>$<?php
                                 $total = $row['price'] * $row['quantity'];
                                 echo $total; 
                               ?>   
                           </td>
                        </tr>
                        <?php 
                           $sum = $sum + $total;
                           $qty = $qty + $row['quantity'];
                           Session::set('sum', $sum);
                           Session::set('qty', $qty);
                         ?>
                        <?php } } ?>
                  </table>
                  <table class="newtable" style="float:right;text-align:left;" width="40%">
                     <tr>
                        <th>Sub Total : </th>
                        <td><?php if (isset($sum)) {
                           echo '$'.$sum;
                        }; ?></td>
                     </tr>
                     <tr>
                        <th>VAT : </th>
                        <td>10% <br> ($<?= $vat = $sum * 0.1; ?>)</td>
                     </tr>
                     <tr>
                        <th>Grand Total :</th>
                        <td>
                           <?php
                            if (isset($sum)) {
                              $vat = $sum * 0.1;
                              $subTotal = $sum + $vat;
                              echo '$'.$subTotal; 
                            }
                           ?> 
                        </td>
                     </tr>
                     <tr>
                        <td colspan="2">
                           <div class="order-btn">
                              <a href="?orderId=order" class="btn">Order Now</a>
                           </div>
                        </td>
                     </tr>
                  </table>
               <?php }else{ ?>

                  <div class="alert alert-danger">
                     <h1 style="font-size: 50px;text-align: center;color: red;font-weight: bold;">No products in your cart!</h1>
                  </div>
                  <style type="text/css">
                     .none{
                        display: none;
                     }
                  </style>
               <?php } ?>

         </div>
         <div class="division">
            <?php 
            $id = Session::get('cmrId');
            $getData = $cmr->getCustomerData($id);
            if ($getData) {
               $value = $getData->fetch_assoc();
            }
          ?>
         <table class="tblone table border">
            <tr>

               <td colspan="3"><h2>User Inofrmation</h2></td>
            </tr>
            <tr>
               <td width="20%">Name</td>
               <td width="5%">:</td>
               <td><?= $value['name']; ?></td>
            </tr>
            <tr>
               <td>Phone</td>
               <td>:</td>
               <td><?= $value['phone']; ?></td>
            </tr>
            <tr>
               <td>Email</td>
               <td>:</td>
               <td><?= $value['email']; ?></td>
            </tr>
            <tr>
               <td>Address</td>
               <td>:</td>
               <td><?= $value['address']; ?></td>
            </tr>
            <tr>
               <td>City</td>
               <td>:</td>
               <td><?= $value['city']; ?></td>
            </tr>
            <tr>
               <td>Zipcode</td>
               <td>:</td>
               <td><?= $value['zip']; ?></td>
            </tr>
            <tr>
               <td>Country</td>
               <td>:</td>
               <td><?= $value['country']; ?></td>
            </tr>
            <tr>
               <td></td>
               <td></td>
               <td><a style="background: #000;color: #fff;padding: 8px 20px;border-radius: 5px;display: inline-block;" href="editprofile">Update Details</a></td>
            </tr>
         </table>
         </div>
         
  		</div>
    </div>
 </div>
</div>
 <?php include 'inc/footer.php'; ?>