<?php include 'lib/Session.php'; ?>
<?php Session::init(); ?>
<?php include 'config/config.php'; ?>
<?php include 'lib/Database.php'; ?>
<?php include 'functions/functions.php'; ?>
<?php include 'helpers/Format.php'; ?>
<?php spl_autoload_register(function($className){include 'classes/'.$className.'.php';});?>

<?php 
	$cat = new Category();
	$cart = new Cart();
	$cmr = new Customer();
	$fm = new Format();
	$pd = new Product();

 ?>




<!DOCTYPE HTML>
<head>
<title>Store Website</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
<script src="js/jquerymain.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="js/nav.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script> 
<script type="text/javascript" src="js/nav-hover.js"></script>
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
<style type="text/css">
	@import url('https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600&display=swap');
	body{
		font-family: 'Open Sans', sans-serif;
	}
</style>
<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
</script>
</head>
<body>
  <div class="wrap">
		<div class="header_top">
			<div class="logo">
				<a href="index"><img src="images/logo.png" alt="" /></a>
			</div>
			  <div class="header_top_right">
			    <div class="search_box">
				    <form>
				    	<input type="text" value="Search for Products" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search for Products';}"><input type="submit" value="SEARCH">
				    </form>
			    </div>
			    <div class="shopping_cart">
					<div class="cart">
						<a href="#" title="View my shopping cart" rel="nofollow">
								<span class="cart_title">Cart</span>
								<span class="no_product">
									<?php 
										$getData = $cart->checkCart();
										if ($getData) {
											echo  "($".Session::get('sum').")"." | Qty: ".Session::get('qty');
										}else{
											echo("(Empty)");
										}
							
									?>
								</span>
							</a>
						</div>
			      </div>

			      <?php 
			      	if (isset($_GET['cid'])) {
			      		$deletCustCart = $cart->deleteCustomerCart();
			      		Session::destroy();
			      	}
			       ?>

		   <div class="login">
		   	<?php 
						$custLogin = Session::get('custLogin');
						if ($custLogin) { ?>
		   			<a href="?cid=<?= Session::get('cmrId'); ?>">Logout</a>
		   		<?php }else{ ?>
		   			<a href="login">Login</a>
		   		<?php } ?>
		   </div>
		 <div class="clear"></div>
	 </div>
	 <div class="clear"></div>
 </div>
<div class="menu">
	<ul id="dc_mega-menu-orange" class="dc_mm-orange">
	  <li><a class="active" href="index">Home</a></li>
	  <li><a href="products">Products</a> </li>
	  <li><a href="topbrands">Top Brands</a></li>
	  <?php 
	  	if ($getData) { ?>
	 	 <li><a href="cart">Cart</a></li>
	 	 <li><a href="payment">Payment</a></li>
	   <?php } ?>
	   <?php 
	   	$cmrId = Session::get('cmrId');
	   	$checkOrder = $cart->checkOrder($cmrId);
	   	if ($checkOrder) {?>
	  	<li><a href="order">Order</a> </li>
	  <?php } ?>
	  	<li><a href="contact">Contact</a> </li>
	  <?php 
	  	if (Session::get('custLogin') == true) { ?>
	  		<li><a href="profile">Profile</a> </li>
		<?php } ?>
	  <div class="clear"></div>
	</ul>
</div>