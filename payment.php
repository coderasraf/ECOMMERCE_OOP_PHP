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
      
  		</div>
    </div>
 </div>
</div>
 <?php include 'inc/footer.php'; ?>