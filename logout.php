<?php 
	require 'config/config.php';
	require 'config/db.php';


	if(isset($_POST['logout'])){
			session_start();
			session_unset();
			$_SESSION = array();
			if (ini_get("session.use_cookies")) {
			    $params = session_get_cookie_params();
			    setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
			}
			session_destroy();
			header('Location: ' .ROOT_URL);
	}
?>