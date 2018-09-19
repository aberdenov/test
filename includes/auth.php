<?php
	define('SESSION_ID', 'SID');
	
	session_name(SESSION_ID);
	session_start('SID');
	
	function checkAuth() {
		if (!isset($_SESSION['login']) || !isset($_SESSION['password'])) return false;
		
		$result = db_query("SELECT * FROM users WHERE login = '".$_SESSION['login']."' AND password = MD5('".$_SESSION['password']."') LIMIT 1");
		if (db_num_rows($result) > 0) return true;
		
		return false;
	}
	
	if (!checkAuth()) {
		header("location: index.php?auth=1");
        exit;
	}
?>