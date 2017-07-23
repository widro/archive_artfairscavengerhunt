<?php
/*
Template Name: Register
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

	if($_POST['email']){
		$formemail = $_POST['email'];
	}
	else{
		$errors .= "no email specified<br>";
	}



	if(!$errors){


		$dinkers = do_action('register_post', $user_login, $formemail, $errors);

		//$user_pass = wp_generate_password();
		$newuserid = wp_create_user( $user_login, $user_pass, $formemail );
		wp_new_user_notification($newuserid, $user_pass);
		$user_ID = $newuserid;

		if($_POST['postidchange']){
			$updateid = $_POST['postidchange'];

			$sql_update = "UPDATE wp_posts SET post_author = '".$user_ID."' WHERE  ID = '". $updateid . "'";

			$result_update = mysql_query($sql_update) or die($sql_update);

		}


		$creds = array();
		$creds['user_login'] = $user_login;
		$creds['user_password'] = $user_pass;
		$creds['remember'] = true;
		$user = wp_signon( $creds, false );


		echo "
		<script>
			parent.window.location='http://artfairscavengerhunt.com/';
		</script>

		";

	}

}



?>

<?php
if($errors){
	echo "<h3 style=\"color:#ff0000\">";
	echo $errors;
	echo "</h3>";
}
?>

<form method="post">
<h3>Register!</h3>


<?php include('registerform.php'); ?>
</form>