<?php

$login = '';
$msg = '';
if (isset($_POST['login']))  {
	if (($_POST['login'] == 'administrator') && isset($_POST['pwd']) && ($_POST['pwd'] == '123')) {
		session_start();
		setcookie('cv', md5('AdministrAtor'));
		header('Location: /index.php');
	} else {
		$login = $_POST['login'];
		$msg = 'User name or password incorrect';
	}
}

include 'view/login.phtml';