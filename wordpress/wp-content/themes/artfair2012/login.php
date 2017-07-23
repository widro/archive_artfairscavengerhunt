<?php
/*
Template Name: Login
*/



if($_POST['submitbtn']){

echo "form submitted!<br><br>";


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


username:<br>
<input type="text" name="username" id="username">
<br><br>

password:<br>
<input type="text" name="password" id="password">
<br><br>

<input type="submit" name="submitbtn" id="submitbtn" value="Login">

</form>



