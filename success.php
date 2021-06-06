<?php include 'inc/header.php'; ?>
<?php 
	$custLogin = Session::get('custLogin');
	if ($custLogin == false) {
		header("Location:login.php");
	}
 ?>
 <style>
    .order-success-area {
    width: 50%;
    margin: 0 auto;
    min-height: 250px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    box-shadow: 0 0 5px #ddd;
    padding: 0 30px;
    margin-bottom: 30px;
    margin-top: 30px;
    border-radius: 5px;
}

.order-success-area h2 {
    font-size: 30px !important;
    margin-bottom: 20px !important;
    text-align: center;
    border-bottom: 2px solid;
    padding-bottom: 10px;
}

.order-success-area p {
    color: #888;
    font-size: 18px;
    line-height: 1.5;
    text-align: center;
}

.order-success-area a {
    background: linear-gradient(to bottom, #08a8f1 55%,#007ab3 100%) !important;
    padding: 2px 10px;
    border-radius: 5px;
    color: #fff;
    display: block;
    margin-top: 13px;
}
 </style>
 <div class="main">
    <div class="content">
      <?php 
         $cmrId = Session::get('cmrId');
         $amount = $cart->paybaleAmount($cmrId);
         if ($amount) {
            $sum = 0;
            while ($result = $amount->fetch_assoc()) {
              $price = $result['price'];
              $sum = $sum + $price;
            }
              $vat = $sum * 0.1;
              $total = $sum + $vat;
         ?>
  		<div class="section group">
       <div class="order-success-area">
          <h2 class="alert alert-success">Your order is completed!</h2>
          <p>Your total payble amount (Including VAT):
          <strong style="color:#000;">
            $<?php 
                  echo $total;
            ?>
           </strong> 
          </p>
          <P>Thanks for your purchase. We are recieved your order successfully!. We will contact you within 2/3 days where your product will be arrive with the phone call... <a href="order.php">Check all orders </a></P>
       </div>  
      </div>
      <script type="text/javascript">
         setTimeout(function(){
            window.location = 'order.php';
         }, 3000)
      </script>
   <?php } ?>
    </div>
 </div>
</div>
 <?php include 'inc/footer.php'; ?>