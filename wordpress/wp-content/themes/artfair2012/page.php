<?php get_header(); ?>



<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>


<div class="page_grid_container">


	<div class="page_grid_header">
		<?php the_title(); ?>
	</div>
	<div class="page_grid_body">
		<!-- content -->
		<?php the_content(''); ?>
		<!-- content end -->
	</div>



</div>







<?php endwhile; else: ?>
	<p>Lost? Go back to the <a href="<?php echo get_option('home'); ?>/">home page</a>.</p>
<?php endif; ?>


<?php include('footer.php'); ?>