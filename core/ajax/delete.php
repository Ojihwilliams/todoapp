<?php
include '../init.php';
	if(isset($_POST['item_id'])){
		//$user_id = $_SESSION['user_id'];
		 $id = $_POST['item_id'];
		
		//$fromUser->newItem($todo, $postedBy);
		$fromUser->deleteItem($id);
			
	}
?>