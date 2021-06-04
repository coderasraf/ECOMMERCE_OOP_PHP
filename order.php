<?php include 'inc/header.php'; ?>
<?php 
	$custLogin = Session::get('custLogin');
	if ($custLogin == false) {
		header("Location:login.php");
	}
 ?>
 <div class="main">
    <div class="content">
  		<h2>Order</h2>
    </div>
 </div>
</div>
 <?php include 'inc/footer.php'; ?>