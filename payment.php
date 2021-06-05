<?php include 'inc/header.php'; ?>
<?php 
	$custLogin = Session::get('custLogin');
	if ($custLogin == false) {
		header("Location:login.php");
	}
 ?>
 <style>
    .payment{width: 500px;min-height: 250px;text-align: center;border: 1px solid #ddd;margin: 0 auto;box-shadow: 0 0 5px #f9f9f9;border-radius: 5px;display: flex;align-items: center;flex-direction: column;justify-content: center;}
 </style>
 <div class="main">
    <div class="content">
  		<div class="section group">
      <div class="payment">
         <h2>Choose Payment Option</h2>
         <div class="payment-option">
            <a href="payoffline.php">Offline Payment</a>
            <a href="payonline.php">Online Payment</a>
         </div>
      </div>
      <div class="back">
         <a href="cart">Back Previous</a>
      </div>
  		</div>
    </div>
 </div>
</div>
 <?php include 'inc/footer.php'; ?>