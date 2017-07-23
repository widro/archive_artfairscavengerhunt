<html <?php language_attributes();?> xmlns="http://www.w3.org/1999/xhtml"
      xmlns:og="http://ogp.me/ns#"
      xmlns:fb="http://www.facebook.com/2008/fbml">
<head>

<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title>

<?php bloginfo('name'); ?>

<?php
	//if ( !(is_404()) && (is_single()) or (is_page()) or (is_archive()) ) {
	if ( !(is_404()) && (is_single()) or (is_archive()) ) {
	?>
	|
	<?php } ?>

	<?php wp_title(''); ?>
</title>

<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>?<?php echo rand(0,10000000); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>


<?php wp_head(); ?>


<script>

$(document).ready(function() {

	//select all the a tag with name equal to modal
	$('a[name=modal]').click(function(e) {
		//Cancel the link behavior
		e.preventDefault();

		//Get the A tag
		var id = $(this).attr('href');

		//Get the screen height and width
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();

		//Set heigth and width to mask to fill up the whole screen
		$('#mask').css({'width':maskWidth,'height':maskHeight});

		//transition effect
		$('#mask').fadeIn(1000);
		$('#mask').fadeTo("slow",0.8);

		//Get the window height and width
		var winH = $(window).height();
		var winW = $(window).width();

		//Set the popup window to center
		$(id).css('top',  winH/2-$(id).height()/2);
		$(id).css('left', winW/2-$(id).width()/2);

		//transition effect
		$(id).fadeIn(2000);

	});

	//if close button is clicked
	$('.window .close').click(function (e) {
		//Cancel the link behavior
		e.preventDefault();

		$('#mask').hide();
		$('.window').hide();
	});

	//if mask is clicked
	$('#mask').click(function () {
		$(this).hide();
		$('.window').hide();
	});

});

</script>



</head>

<body>


<div class=container_basic>



<div class=title_basic>
	<a href="/"><img src="http://artfairscavengerhunt.com/wordpress/wp-content/uploads/2012/03/afsh-logo-purp1.jpg" align="left" width="100">art fair scavenger hunt</a>
</div>


<div class=nav_links id=nav_links>
	<div style="float:left;">
	</div>
	<div style="float:right;text-align:right;">

<?php
if (is_user_logged_in()){
      global $current_user;
      get_currentuserinfo();

      $userslug = $current_user->user_login;
      echo 'Welcome ' . $current_user->user_login . "<br>";
?>
		<a href="<?php echo wp_logout_url("/"); ?>">logout</a>
		<a href="/hunter/<?php echo $userslug ?>">my hunt</a>

<?php
}
else{
?>
		<a href="#loginform" name="modal">login</a>
		<a href="#registerform" name="modal">register</a>
<?php
}
?>
	</div>


</div>
