<?php get_header(); ?>


<?php
		//$the_query = new WP_Query('pagename=about');

		//while ($the_query->have_posts()) : $the_query->the_post();
		//$do_not_duplicate = $post->ID;
?>

<div class="page_grid_container">

	<!--
	<div class="page_grid_header">
		<?php the_title(); ?>
	</div>
	-->
	<div class="page_grid_body">
		<!-- content -->
		<?php //the_content(''); ?>
		<!-- content end -->


		Art fairs can be exciting again! With 40+ items to find you'll be digging through every booth. Start uploading your pics below! <a href="/about">&raquo; more</a>



	</div>



</div>



<?php
//endwhile;
?>






<iframe class="uploadframe" src="http://artfairscavengerhunt.com/upload/"></iframe>




<div class="home_grid_container">
<?php
$categories=get_categories('hide_empty=0');
foreach ($categories as $category) {
	$slug = $category->category_nicename;
	$name = $category->cat_name;
	$count = $category->category_count;
	$description = $category->description;

	echo "
	<div class=\"home_grid\" onclick=\"javascript:window.location='/category/$slug'\">
		<h3>$name</h3>
		$description ($count)
	</div>

	";

}
?>

</div>








<?php include('footer.php'); ?>