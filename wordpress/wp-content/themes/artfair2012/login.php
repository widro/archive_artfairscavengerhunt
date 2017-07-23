<?php
/*
Template Name: Login
*/

if($_POST['submitbtn']){

	if($_POST['username']){
		$user_login = $_POST['username'];
	}
	else{
		$errors .= "no username specified<br>";
	}


	if($_POST['password']){
		$user_pass = $_POST['password'];
	}
	else{
		$errors .= "no password specified<br>";
	}

	if(!$errors){
		$creds = array();
		$creds['user_login'] = $user_login;
		$creds['user_password'] = $user_pass;
		$creds['remember'] = true;
		$user = wp_signon( $creds, false );
		if ( is_wp_error($user) ){
		   $errors .= $user->get_error_message();
		   echo $errors;
		}
		else{
			//header( 'Location: http://artfairscavengerhunt.com/' ) ;
			echo "
			<script>
				parent.window.location='http://artfairscavengerhunt.com/';
			</script>

			";
		}
	}

}
?>
<form method="post">
<h3>Login!</h3>

<?php
if($errors){
	echo "<h3 style=\"color:#ff0000\">";
	echo $errors;
	echo "</h3>";
}
?>


username:
<input type="text" name="username" id="username">
<br>

password:
<input type="password" name="password" id="password">
<br>

<input type="submit" name="submitbtn" id="submitbtn" value="Login">

</form>



