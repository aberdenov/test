<?php
	define("IN_SYSTEM", 1);
	$ip = 0;

	require_once("./includes/common.php");
	require_once("./includes/db_init.php");

	# POST ####################################################################################

	if (isset($_POST['password'])) {
		$usrname = substr($_POST['login'], 0, 15);
		$usrpass = substr($_POST['password'], 0, 30);
		
		if (preg_match("/[^(\w)|(\x7F-\xFF)|(\s)]/", $usrname)) $usrname = "";
		if (preg_match("/[^(\w)|(\x7F-\xFF)|(\s)]/", $usrpass)) $usrpass = "";
		
		$result = db_query("SELECT * FROM users WHERE login = '".$usrname."' AND password = MD5('".$usrpass."') LIMIT 1");
		if (db_num_rows($result)) {
			$row = db_fetch_object($result);
			
			if ($row->active == 1) {
				$ip = get_ip();
				
				if ($ip == long2ip($row->ip) || empty($row->ip)) {
					session_name('SID');
					session_start();
				
					$_SESSION['login'] = $usrname;
					$_SESSION['password'] = $usrpass;
					$_SESSION['user_ID'] = $row->id;
										
					// Сохраняем логин и пароль в куках, удаляем если не отметили "запомнить"
					if (isset($_POST['chk_save'])) {
						$cookie_value = $usrname."|".$usrpass."|".$_SERVER['HTTP_HOST'];
						$cookie_value = crypt_string($cookie_value);
						setcookie("sd_auth", $cookie_value, time()+60*60*24*30, "", $_SERVER['HTTP_HOST']);
					} else {
						if (isset($_COOKIE['sd_auth'])) {
							$cookie_value = "";
							setcookie("sd_auth", $cookie_value, 0, "", $_SERVER['HTTP_HOST']);
						}
					}				
					
					header("Location: main.php");
					exit();
				}
			} else {
				header("location: index.php?result=2");
				exit();
			}
		} else {
			header("location: index.php?result=1");
			exit();
		}
	}

	# MAIN #######################################################################################

	require_once (FASTTEMPLATES_PATH."template.php");

	$tpl = new FastTemplate(TEMPLATES_PATH);
	
	$tpl->define(array(
			"page" => "page.tpl",
			"form" => "login_form.tpl"
		));

	// Берем логин и пароль из кук
	$usr_login = '';
	$usr_passw = '';
	$save      = '';
	
	if (isset($_COOKIE['sd_auth'])) {
		$str = crypt_string($_COOKIE['sd_auth'], false);
		
		$login_info = explode("|", $str);
		if (is_array($login_info)) {
			$host = $login_info[2];
			if ($host == $_SERVER['HTTP_HOST']) {
				$usr_login = $login_info[0];
				$usr_passw = $login_info[1];
				$save = 'checked';
			}
		}
	}
	
	$msg = '';
	
	if (isset($_GET['auth']) == 1) {
		$msg .= '<div id="warning"><b>Истекло время ожидания. Авторизируйтесь снова.</b></div>';
	}

	if (isset($_GET['result'])) {
		switch ($_GET['result']) {
			case 1: $msg = '<div id="warning"><b>Неверное сочетание логина и пароля</b></div>'; break;
			case 2: $msg = '<div id="warning"><b>Учетная запись пользователя блокирована.</b></div>'; break;
			default: $msg = '';
		}
	} 
	
	$tpl->assign(array(
			"USR_LOGIN" => $usr_login,
			"USR_PASSW" => $usr_passw,
			"SAVE"      => $save,
			"MSG"		=> $msg
		));
	
	$tpl->parse("PAGE_CONTENT", "form");
	
	$tpl->parse("FINAL", "page");
	$tpl->FastPrint();
?>
