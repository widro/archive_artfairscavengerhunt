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

</head>

<body>


<div class=container_basic>



<div class=title_basic>
	<a href="/">art fair scavenger hunt</a>
</div>


<div class=nav_links id=nav_links>
	<div style="float:left;">
	</div>
	<div style="float:right;">
		<a href="#" onclick="javascript:alert('login here, will show if not logged in');">login</a>
		<a href="#" onclick="javascript:alert('register here, will show if not logged in');">register</a>
		<a href="#" onclick="javascript:alert('logout here, will show if logged in');">logout</a>
		<a href="/author/admin">my hunt</a>
	</div>


</div>
