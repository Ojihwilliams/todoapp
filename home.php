<?php
include 'core/init.php';

$user_id = $_SESSION['user_id'];
$user = $fromUser->userData($user_id);

$item = $fromUser->displayItem($user_id);



if ($fromUser->loggedIn() === false) {
	header('Location: index.php');
}

include 'includes/header.php';
echo "<body id='list-page'>";
include 'includes/navigation.php';

?>
<div id="container">
	
		<h1 class="header">To-do List <i class="fa fa-plus pull-right"></i></h1>
		<input class="list-input" data-user="<?= $user_id;?>" type="text" placeholder="Add New Todo">
		<ul class="list">
		<?php foreach ($item as $value) { ?>
			 
			<li class="text-uppercase" style="color: #000;"><span id="delete" data-item="<?=$value->item_id;?>"><i class="fa fa-trash"></i></span> <?=$value->item;?></li>
	<?php	} ?>
		</ul>
</div>



<?php
include 'includes/footer.php';
echo '</body>';
?> 