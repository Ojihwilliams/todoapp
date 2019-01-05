<?php

	include 'database/connection.php';
	include 'classes/user.php';

	global $pdo;

	session_start();

	$fromUser = new User($pdo);


	define("BASE_URL", "http://localhost/todolist/")
?>