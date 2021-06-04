<?php 
	
	// Getting user compute ip
	function getUserIp(){
			switch (true) {
			case (!empty($_SERVER['HTTP_X_REAL_IP'])) : return($_SERVER['HTTP_X_REAL_IP']);
			break;
			case(!empty($_SERVER['HTTP_CLIENT_IP'])) : return($_SERVER['HTTP_CLIENT_IP']);
			break;
			case(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) : return($_SERVER['HTTP_X_FORWARDED_FOR']);
			break;
			default: return($_SERVER['REMOTE_ADDR']);
			break;
			}
		}

 ?>