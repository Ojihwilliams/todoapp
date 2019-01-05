<?php
	include '../core/init.php';
	$fromUser->logout();
	if ($fromUser->loggedIn() === false) {
	header('Location: '.BASE_URL.'index.php');
}

?>