<?php 
include 'core/init.php'; 
if (isset($_POST['register'])) {
	$reg_username 			= $_POST['reg_username'];
	$reg_password 			= $_POST['reg_password'];
	$reg_email 				= $_POST['reg_email'];
	$reg_fullname 			= $_POST['reg_fullname'];
	if (isset($_POST['sex'])) {

		$sex 					= $_POST['sex'];
	}

	$reg_password_confirm 	= $_POST['reg_password_confirm'];

		$user 	= $fromUser->checkInput($reg_username);
	 	$pass 	= $fromUser->checkInput($reg_password);
	 	$email 	= $fromUser->checkInput($reg_email);
	 	$name 	= $fromUser->checkInput($reg_fullname);
	 	$sex 	= $fromUser->checkInput($sex);
	 	$pass_con 	= $fromUser->checkInput($reg_password_confirm);
	
		if (!empty($reg_username) or !empty($reg_password) or !empty($reg_email) or !empty($reg_fullname)) {
	 		if (strlen($user) < 5) {
					$error['user1'] = "Username must be between 5 and 20";
				}
				else if($fromUser->checkUsername($user) === true){
					$error['user2'] = "Username is already taken!";
				}
				else if (strlen($pass) < 5) {
					$error['pass1'] = "Password is to short";
				}
				else if ($pass != $pass_con) {
					$error['pass2'] = "The two passwords do not match";
			 	}
			  	else if (!filter_var($email)) {
		 			$error['email1'] = "Invalid email format"; 
				}
				else if ($fromUser->checkEmail($email) === true) {
					$error['email2'] = "Email is already taken!";
	 			}
	 			 if (isset($_FILES['image'])){
	 				if (!empty($_FILES['image']['name'][0])) {
	 				$fromUser->newUser($user, $pass, $email, $name, $sex);
	 				$id = $fromUser->userID($user);
	 				
	 				$user_id = $id->user_id;
	 				
	 			 	$fileRoot = $fromUser->uploadImage($_FILES['image']);

       				$fromUser->update('users', $user_id, array('image' => $fileRoot));

					 $create = 'New User Created';
	 				
	 			
	 		}

			}
		}
		
		else {
				$error['fields'] = "All fields must be filled";

				
	}
}



if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$fromUser->login($username,$password);
}

include 'includes/header.php';
?>

<section  id="intro" class="intro">
	<div class="intro-body">
		<div class="text-center" style="padding:50px 0">

	
	<!-- Main Form -->
	<div class="login-form-1">
		<form id="login-form" method="post" class="text-left">
			<div class="login-form-main-message"></div>
			<div class="main-login-form">
				<div class="login-group">
					<div class="logo">login</div>
					<div class="form-group">
						<label for="lg_username" class="sr-only">Username</label>
						<input type="text" class="form-control input-lg" id="lg_username" name="username" placeholder="username">

					</div>
					<div class="form-group">
						<label for="lg_password" class="sr-only">Password</label>
						<input type="password" class="form-control input-lg" id="lg_password" name="password" placeholder="password">
					</div>
					
				</div>
				<button type="submit" name="submit" class="login-button"><i class="fa fa-chevron-right"></i></button>
			</div>
			<div class="etc-login-form">
				<p>new user? <a href="#register">create new account</a></p>
			</div>
		</form>
	</div>
	<!-- end:Main Form -->
</div>

</div>
			
</section>
 <section id="register">
	<div class="text-center" style="padding:50px 0">
	<div class="logo">Register</div>
	<?php if (isset($error['fields'])) {
		echo"<p class='text-warning'>".$error['fields']."</p>";
} ?>
<?php if (isset($create)) {
		echo"<p class='text-success'>".$create."</p>";
} ?> 

	<!-- Main Form -->
<div class="intro-body1">
	<div class="login-form-1">
		<form id="register-form" method="post" class="text-left" enctype="multipart/form-data">
			<div class="login-form-main-message"></div>
			<div class="main-login-form">
				<div class="login-group">
					<div class="form-group">
						<label for="reg_username" class="sr-only">Username</label>
						<input type="text" class="form-control input-lg" id="reg_username" name="reg_username" placeholder="username">
						<?php if (isset($error['user1'])) {
							echo"<p class='warning'>".$error['user1']."</p>";
						} 
						if (isset($error['user2'])) {
							echo"<p class='warning'>".$error['user2']."</p>";
						} ?>
					</div>
					<div class="form-group">
						<label for="reg_password" class="sr-only">Password</label>
						<input type="password" class="form-control input-lg" id="reg_password" name="reg_password" placeholder="password">
						<?php if (isset($error['pass1'])) {
							echo"<p class='warning'>".$error['pass1']."</p>";
						} ?>
					</div>
					<div class="form-group">
						<label for="reg_password_confirm" class="sr-only">Password Confirm</label>
						<input type="password" class="form-control input-lg" id="reg_password_confirm" name="reg_password_confirm" placeholder="confirm password">
						<?php if (isset($error['pass2'])) {
							echo"<p class='warning'>".$error['pass2']."</p>";
						} ?>
					</div>
					
					<div class="form-group">
						<label for="reg_email" class="sr-only">Email</label>
						<input type="text" class="form-control input-lg" id="reg_email" name="reg_email" placeholder="email">
						<?php if (isset($error['email1'])) {
							echo"<p class='warning'>".$error['email1']."</p>";
						} 
						if (isset($error['email2'])) {
							echo"<p class='warning'>".$error['email2']."</p>";
						} ?>
					</div>
					<div class="form-group">
						<label for="reg_fullname" class="sr-only">Full Name</label>
						<input type="text" class="form-control input-lg" id="reg_fullname" name="reg_fullname" placeholder="full name">
					</div>
					
					<div class="form-group login-group-checkbox">
						<input type="radio" name="sex" id="male" value="male">
						<label for="male">male</label>
						
						<input type="radio"  name="sex" id="female" value="female">
						<label for="female">female</label>
					</div>
					<div class="form-group">
						<label for="reg_image" class="sr-only">Profile Image</label>
						<input type="file" class="form-control input-lg" id="reg_image" name="image" placeholder="profile image">
					</div>
					
					<div class="form-group login-group-checkbox">
						<input type="checkbox" class="" id="reg_agree" name="reg_agree">
						<label for="reg_agree">i agree with <a href="#">terms</a></label>
					</div>
				</div>
				<button type="submit" name="register" class="login-button"><i class="fa fa-chevron-right"></i></button>
			</div>
			<div class="etc-login-form">
				<p>already have an account? <a href="#intro">login here</a></p>
			</div>
		</form>
	</div>
	<!-- end:Main Form -->
</div>
</div>


</section> -->
<?php   
include 'includes/footer.php';
?>