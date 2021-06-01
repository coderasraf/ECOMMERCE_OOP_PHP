<?php include '../classes/AdminLogin.php'; ?>
<?php 
	$al = new AdminLogin();

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$adminUser = $_POST['adminUser'];
		$adminPass = $_POST['adminPass'];

		$loginChk = $al->adminLogin($adminUser,$adminPass);
	}
 ?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<form action="" method="post">
			<h1>Admin Login</h1>
			<div class="alert alert-danger" style="margin-top: -10px;margin-bottom: 10px;">
				<span class="error" style="color: red;font-weight: bold;text-align: center;">
					<?php if (isset($loginChk)) {
						echo $loginChk;
					} ?>
				</span>
			</div>
			<div>
				<input  type="text" placeholder="Username" name="adminUser"/>
			</div>
			<div>
				<input type="password" placeholder="Password" name="adminPass"/>
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="#">Training with live project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>