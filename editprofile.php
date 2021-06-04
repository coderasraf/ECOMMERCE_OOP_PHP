<?php include 'inc/header.php'; ?>
<?php 
	$custLogin = Session::get('custLogin');
	if ($custLogin == false) {
		header("Location:login.php");
	}
 ?>

 <style>.tblone{width: 550px;margin: 0 auto;padding-right: 10px;}.tblone tr td{text-align: justify;}
table.tblone.table.border input {
    width: 350px;
    border: 1px solid #ddd;
    padding: 8px 10px !important;
}
</style>
 <div class="main">
    <div class="content">
  		<div class="section group">
         <?php 
            $id = Session::get('cmrId');
            $getData = $cmr->getCustomerData($id);
            if ($getData) {
               $value = $getData->fetch_assoc();
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 							$data = $_POST;
 							$updateInfo = $cmr->updateUserInfo($data, $id);
 						}
          ?>
          <form action="" method="POST">
  			<table class="tblone table border">
  				
            <tr>
               <td colspan="3"><h2>Update Profile <br> <?php 
  					if (isset($updateInfo)) {
  						echo $updateInfo;
  					}
  				 ?></h2></td>
            </tr>
  				<tr>
  					<td width="20%">Name</td>
  					<td><input width="100%" style="padding: 5px;" type="text" value="<?= $value['name']; ?>" name="name"></td>
  				</tr>
  				<tr>
  					<td>Phone</td>
  					<td><input width="100%" style="padding: 5px;" type="text" value="<?= $value['phone']; ?>" name="phone"></td>
  				</tr>
  				<tr>
  					<td>Email</td>
  					<td><input width="100%" style="padding: 5px;" type="text" value="<?= $value['email']; ?>" name="email"></td>
  				</tr>
  				<tr>
  					<td>Address</td>
  					<td><input width="100%" style="padding: 5px;" type="text" value="<?= $value['address']; ?>" name="address"></td>
  				</tr>
  				<tr>
  					<td>City</td>
  					<td><input width="100%" style="padding: 5px;" type="text" value="<?= $value['city']; ?>" name="city"></td>
  				</tr>
  				<tr>
  					<td>Zipcode</td>
  					<td><input width="100%" style="padding: 5px;" type="text" value="<?= $value['zip']; ?>" name="zip"></td>
  				</tr>
  				<tr>
  					<td>Country</td>
  					<td><input width="100%" style="padding: 5px;" type="text" value="<?= $value['country']; ?>" name="country"></td>
  				</tr>
            <tr>
               <td></td>
               <td><button type="submit" name="update" style="background: #000;color: #fff;padding: 8px 20px;border-radius: 5px;border: none;display: inline-block;" href="editprofile">Update Profile</button></td>
            </tr>
  			</table>
  			</form>
  		</div>
    </div>
 </div>
</div>
 <?php include 'inc/footer.php'; ?>