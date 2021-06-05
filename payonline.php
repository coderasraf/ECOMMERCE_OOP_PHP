<?php include 'inc/header.php'; ?>
<?php 
	$custLogin = Session::get('custLogin');
	if ($custLogin == false) {
		header("Location:login.php");
	}
 ?>
 <style>
    
 </style>
 <div class="main">
    <div class="content">
  		<div class="section group">
      
  		</div>
    </div>
 </div>
</div>
 <?php include 'inc/footer.php'; ?>