<?php get_header(); ?>

<?php
if(get_query_var('author_name')) :
    $curauth = get_user_by('slug', get_query_var('author_name'));
else :
    $curauth = get_userdata(get_query_var('author'));
endif;

$insider_userid = $curauth->ID;
$insider_display_name = $curauth->display_name;
$insider_user_nicename = $curauth->user_nicename;
$insider_user_email = $curauth->user_email;
$insider_description = $curauth->description;
?>


<div class="page_grid_container">
	<div class="page_grid_header">
		<?php echo $insider_display_name ?>'s Scavenger Hunt
	</div>
	<div class="page_grid_body">



<?php
$categories=get_categories('hide_empty=0');
foreach ($categories as $category) {
	$slug = $category->category_nicename;
	$name = $category->cat_name;
	$count = $category->category_count;
	$description = $category->description;

	echo "<li>$name</li>
	";

}
?>




	</div>
</div>




<?php if (have_posts()) : ?>
<?php

	$postarray = array();
while (have_posts()) : the_post();

	$thistitle = $post->post_title;
	$thisexcerpt = makeexcerpt($post->post_content, $post->post_excerpt, "default");

	$thiscontent = $post->post_content;

	$thistitle = str_replace("\"", "", $thistitle);

	$clickthru=get_permalink($thispostid);

	//outputs date in wacky format
	$thisdate = mysql2date('h|m|s|m|d|Y', $post->post_date);

	//explodes date by |
	$thisdatearr = explode("|", $thisdate);

	//converts pipe exploded array into unix ts
	$unixtimestamp =  mktime((int)$thisdatearr[0], (int)$thisdatearr[1], (int)$thisdatearr[2], (int)$thisdatearr[3], (int)$thisdatearr[4], (int)$thisdatearr[5]);

	$postarray[$unixtimestamp]['title'] = $thistitle;
	$postarray[$unixtimestamp]['clickthru'] = $clickthru;
	$postarray[$unixtimestamp]['excerpt'] = $thisexcerpt;
	$postarray[$unixtimestamp]['content'] = $thiscontent;
	$postarray[$unixtimestamp]['post_date'] = $post->post_date;
	$postarray[$unixtimestamp]['topstory500x250'] = $topstory500x250;
	$postarray[$unixtimestamp]['topstory120x120'] = $topstory120x120;
endwhile;
endif; ?>


<?php
foreach($postarray as $key => $outsidepost){
	//echo $key . "<br>";

	//vars
	$thisexcerpt = $outsidepost['excerpt'];
	$thisexcerpt = substr($thisexcerpt, 0, 180);

	$thiscontent = $outsidepost['content'];
	$thiscontent = substr(strip_tags($thiscontent), 0, 300);
	$thistitle = $outsidepost['title'];
	$thistitle = str_replace("\"", "", $thistitle);

	$clickthru = $outsidepost['clickthru'];

	if($currentpost%3==1){
		$authorcellcolor = "";
	}
	elseif($currentpost%3==2){
		$authorcellcolor = "fafafa";
	}
	elseif($currentpost%3==0){
		$authorcellcolor = "eeeeee";
	}

$image = trim(strip_tags($outsidepost['content']));

	$authorlisting .= "
	<div class=\"listing_grid\">
		<a href=\"$clickthru\"><img src=\"$image\" width=150></a>


	</div>
	";


	if($currentpost%2==0){
		$authorlisting_left .= $authorlisting;
	}

	else{
		$authorlisting_right .= $authorlisting;
	}

	$currentpost++;


}

echo $authorlisting;

?>


<?php include('footer.php'); ?>