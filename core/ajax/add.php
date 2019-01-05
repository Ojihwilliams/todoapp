<?php
include '../init.php';
	if(isset($_POST['item']) && !empty($_POST['item'])){
		$user_id = $_SESSION['user_id'];
		$todo = $_POST['item'];
		$postedBy = $_POST['user_id'];
		$fromUser->newItem($todo, $postedBy);
		$item = $fromUser->displayItem($todo,$postedBy);
		foreach ($item as $value) { ?>
			 
			<li><span id="delete"><i class="fa fa-trash"></i></span> <?=$value->item;?></li>
	<?php	}
	}
?>