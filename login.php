<?php include 'inc/header.php'; ?>

<?php 
	$custLogin = Session::get('custLogin');
	if ($custLogin) {
		header("Location:order.php");
	}
 ?>

<?php 
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signup'])) {
			$insertUser = $cmr->insertCustomer($_POST);
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
			$login = $cmr->customerLogin($_POST);
	}
 ?>

 <div class="main">
    <div class="content">
    	 <div class="login_panel">
        	<h3>Existing Customers</h3>
        	<?php 
        		if (isset($login)) {
        			echo $login;
        		}
        	 ?>

        	<form action="" method="POST" id="member">
                	 <input value="<?php if(isset($_POST['email'])){ echo $_POST['email']; } ?>" name="email" type="email" placeholder="Enter your email">
                   <input type="password" name="password" placeholder="Enter your passoword">
                    <div class="buttons">
                    	<div>
                    		<button name="login" type="submit" class="grey">Sign In</button>
                    	</div>
                    </div>
                    </form>
                    </div>
    	<div class="register_account">
    		<h3>Register New Account</h3>
    		<?php 
    			if (isset($insertUser)) {
    				echo $insertUser;
    			}
    		 ?>
    		<form method="POST" action="">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input value="<?php if(isset($_POST['name'])){ echo $_POST['name']; } ?>" type="text" name="name" placeholder="Enter your name">
							</div>
							
							<div>
							   <input value="<?php if(isset($_POST['city'])){ echo $_POST['city']; } ?>" type="text" name="city" placeholder="Your city">
							</div>
							
							<div>
								<input value="<?php if(isset($_POST['zip'])){ echo $_POST['zip']; } ?>" type="text" name="zip" placeholder="Enter your zipcode">
							</div>
							<div>
								<input value="<?php if(isset($_POST['email'])){ echo $_POST['email']; } ?>" type="email" name="email" placeholder="Your email">
							</div> 
		    			 </td>
		    			<td>
						<div>
							<input value="<?php if(isset($_POST['address'])){ echo $_POST['address']; } ?>" type="text" name="address" placeholder="Enter your address">
						</div>
		    			<div>
							<input value="<?php if(isset($_POST['country'])){ echo $_POST['country']; } ?>" type="text" name="country" placeholder="Enter your Country">
						</div>		        
	
		           <div>
							<input value="<?php if(isset($_POST['phone'])){ echo $_POST['phone']; } ?>"  type="text" name="phone" placeholder="Phone">
						</div>
				  
				  		<div>
							<input value="<?php if(isset($_POST['password'])){ echo $_POST['password']; } ?>" type="password" name="password" placeholder="Enter your passoword">
						</div>
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search"><div><button name="signup" type="submit" class="grey">Create Account</button></div></div>
		    <p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>
  <?php include 'inc/footer.php'; ?>