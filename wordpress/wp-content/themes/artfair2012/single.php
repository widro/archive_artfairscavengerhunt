<?php get_header(); ?>



<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

<?php
$thispostid = $post->ID;
$clickthru=get_permalink($thispostid);
	$image = trim(strip_tags($post->post_content));
	$image_thumb = str_replace(".jpg", "-150x150.jpg", $image);
	$image_thumb_rel = str_replace("http://artfairscavengerhunt.com", "-150x150.jpg", $image);
	$filename = "/nfs/c03/h03/mnt/54729/domains/artfairscavengerhunt.com/html" . $image_thumb_rel;
	if (!file_exists($filename)) {
		$image_thumb = $image;
	}
foreach((get_the_category()) as $category) {
	$categoryslug = $category->slug;
	$categoryname = $category->cat_name;
}

?>
<div class="page_grid_container">


	<div class="page_grid_header">
		<?php the_title(); ?>
	</div>
	<div class="page_grid_body">
		<img src="<?php echo $image ?>" width=800>
	</div>



</div>







<?php endwhile; else: ?>
	<p>Lost? Go back to the <a href="<?php echo get_option('home'); ?>/">home page</a>.</p>
<?php endif; ?>


<?php include('footer.php'); ?>