<?php
/**
 * login controller
 * Redirect to main page
 */
header('Location: /index.php');
	setcookie('PHPSESSID', '');
	setcookie('cv', '', time()-1);
	session_destroy();
