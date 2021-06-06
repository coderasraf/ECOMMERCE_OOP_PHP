<?php include 'inc/header.php'; ?>
<?php 
	// Removing cart item from cart
	if (isset($_GET['removeCart'])) {
		$removeId = $_GET['removeCart'];
		$removeCart = $cart->removeCart($removeId);
	}
	
	// Updating cart quantity
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$quantity = $_POST['quantity'];
		$cartId   = $_POST['cartId'];
		$updateCart = $cart->cartUpdate($quantity,$cartId);
	}

	// refresh page

	if (!isset($_GET['id'])) {
		echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";
	}
 ?>
 <style>
	.alert.cart-alert.alert-danger {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    min-height: 200px;
}
</style>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2 class="none">Your Cart</h2>
			    	<?php 
	
			    		if (isset($removeCart)) {
							echo "<div class='none'>".$removeCart."</div>";
						}
			    	 ?>
						<table class="tblone">
							<tr>
								<th width="20%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="25%">Quantity</th>
								<th width="20%">Total Price</th>
								<th width="10%">Action</th>
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
									<td><img src="admin/<?= $row['image']; ?>" alt=""/></td>
									<td>Tk. <?= $row['price']; ?></td>
									<td>
										<form action="" method="post">
											<input type="text" hidden="" name="cartId" value="<?= $row['cartId']; ?>"/>
											<input type="number" name="quantity" value="<?= $row['quantity']; ?>"/>
											<input type="submit" name="submit" value="Update"/>
										</form>
									</td>
									<td>$<?php
											$total = $row['price'] * $row['quantity'];
											echo $total; 
										 ?>	
									</td>
									<td><a href="?removeCart=<?=$row['cartId']; ?>">❌</a></td>
								</tr>
								<?php 
									$sum = $sum + $total;
									$qty = $qty + $row['quantity'];
									Session::set('sum', $sum);
									Session::set('qty', $qty);
								 ?>
								<?php } } ?>
						</table>
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td><?php if (isset($sum)) {
									echo '$'.$sum;
								}; ?></td>
							</tr>
							<tr>
								<th>VAT : </th>
								<td>10% </td>
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
					   </table>
					<?php }else{ ?>

						<div class="alert cart-alert alert-danger">
							<h1 style="font-size: 50px;text-align: center;color: red;font-weight: bold;">No products in your cart!</h1>
							<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						</div>
						<style type="text/css">
							.none{
								display: none;
							}
						</style>
					<?php } ?>
					</div>
					<div class="shopping">
						<div class="shopleft none">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright none">
							<a href="payment"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>

  <?php include 'inc/footer.php'; ?>