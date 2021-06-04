<?php include 'inc/header.php'; ?>

<?php 
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signup'])) {
				
				$insertUser = $cmr->insertCustomer($_POST);
		}
 ?>

 <div class="main">
    <div class="content">
    	 <div class="login_panel">
        	<h3>Existing Customers</h3>
        	<p>Sign in with the form below.</p>
        	<form action="hello" method="get" id="member">
                	<input name="Domain" type="text" value="Username" class="field" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Username';}">
                    <input name="Domain" type="password" value="Password" class="field" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}">
                 </form>
                 <p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p>
                    <div class="buttons"><div><button class="grey">Sign In</button></div></div>
                    </div>
    	<div class="register_account">
    		<h3>Register New Account</h3>
    		<form method="POST" action="">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" name="name" placeholder="Enter your name">
							</div>
							
							<div>
							   <input type="text" name="city" placeholder="Your city">
							</div>
							
							<div>
								<input type="text" name="zip" placeholder="Enter your zipcode">
							</div>
							<div>
								<input type="email" name="email" placeholder="Your email">
							</div>
		    			 </td>
		    			<td>
						<div>
							<input type="text" name="address" placeholder="Enter your address">
						</div>
		    			<div>
							<input type="text" name="country" placeholder="Enter your Country">
						</div>		        
	
		           <div>
							<input type="text" name="phone" placeholder="Phone">
						</div>
				  
				  		<div>
							<input type="text" name="passoword" placeholder="Enter your passoword">
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