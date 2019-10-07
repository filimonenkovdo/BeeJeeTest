<?php
include 'model/Task.php';

$username = '';
$email = '';
$text = '';
$massage = array();
if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	if (!username) {
		$message[] = 'The username is obligatory field';
	}
	if (!preg_match("#^[a-zA-Z0-9]+$#",$username)) {
		$message[] = 'The username contains invalid characters';
	}
	$email = $_POST['email'];
	if (!email) {
		$message[] = 'The email is obligatory field';
	} else {
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$message[] = 'The email address is invalid';
		}
	}
	$text = $_POST['task'];
	if (!$text) {
		$message[] = 'The task is empty';
	}
	if (!$message) {
		$task = new Task();
		$task->setUsername($username);
		$task->setEmail($email);
		$task->setText($text);
		$task->setModified(false);
		$task->setSolved(false);
		
		$answer = $task->insert();
		
		if ($answer) {
			header('Location: /index.php');
		} else {
			$message[] = 'Insert was unsuccess';
		}
	}
}

include 'view/add.phtml';