<?php include 'inc/header.php'; ?>
<?php 
	$custLogin = Session::get('custLogin');
	if ($custLogin == false) {
		header("Location:login.php");
	}
 ?>
 <style>.tblone{width: 550px;margin: 0 auto;border: 2px solid #ddd;}.tblone tr td{text-align: justify;}</style>
 <div class="main">
    <div class="content">
  		<div class="section group">
         <?php 
            $id = Session::get('cmrId');
            $getData = $cmr->getCustomerData($id);
            if ($getData) {
               $value = $getData->fetch_assoc();
            }
          ?>
  			<table class="tblone table border">
            <tr>

               <td colspan="3"><h2>User Profile Inofrmation</h2></td>
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
               <td><a style="background: #000;color: #fff;padding: 8px 20px;border-radius: 5px;display: inline-block;" href="editprofile">Edit profile</a></td>
            </tr>
  			</table>
  		</div>
    </div>
 </div>
</div>
 <?php include 'inc/footer.php'; ?>