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




<?php if (have_posts()) : ?>
<?php

	$postarray = array();
	$yesitems = array();
	$yesitems[] = "dinkers";;
	$noitems = array();
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

	foreach((get_the_category()) as $category) {
		$categoryslug = $category->slug;
		$categoryname = $category->cat_name;
		$yesitems[] = $categoryslug;
	}


	$postarray[$unixtimestamp]['title'] = $thistitle;
	$postarray[$unixtimestamp]['clickthru'] = $clickthru;
	$postarray[$unixtimestamp]['excerpt'] = $thisexcerpt;
	$postarray[$unixtimestamp]['content'] = $thiscontent;
	$postarray[$unixtimestamp]['post_date'] = $post->post_date;
	$postarray[$unixtimestamp]['categoryslug'] = $categoryslug;
	$postarray[$unixtimestamp]['categoryname'] = $categoryname;
endwhile;
endif; ?>


<?php
if(is_array($postarray)){
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


	$image = trim(strip_tags($outsidepost['content']));
	$image_thumb = str_replace(".jpg", "-150x150.jpg", $image);
	$image_thumb_rel = str_replace("http://artfairscavengerhunt.com", "-150x150.jpg", $image);
	$filename = "/nfs/c03/h03/mnt/54729/domains/artfairscavengerhunt.com/html" . $image_thumb_rel;
	if (!file_exists($filename)) {
		$image_thumb = $image;
	}

	$categoryname = $outsidepost['categoryname'];
	$categoryslug = $outsidepost['categoryslug'];

	$authorlisting .= "
	<div class=\"listing_grid\">
		<a href=\"$clickthru\"><img src=\"$image_thumb\" width=150></a>
		<br>$categoryname


	</div>
	";
}
}
?>

<?php
$categories=get_categories('hide_empty=0');
foreach ($categories as $category) {
	if(($category->category_nicename!="uncategorized")&&($category->category_nicename!="people")){
		$slug = $category->category_nicename;
		$name = $category->cat_name;
		$count = $category->category_count;
		$description = $category->description;


		if((!is_null($yesitems))&&(in_array($slug, $yesitems))){
			$checklistgrid .= "<div class=\"checklist_grid yes\">&#10004;$name</div>";
		}
		else{
			$checklistgrid .= "<div class=\"checklist_grid no\">&#10008;$name</div>";
			$noitems[] = $slug;
		}
	}


}
?>


<div class="page_grid_container">
	<div class="page_grid_header">
		<?php echo $insider_display_name ?>'s Scavenger Hunt
	</div>
</div>
<?php echo $checklistgrid; ?>

<div class="page_grid_container">
	<div class="page_grid_header">
		<?php echo $insider_display_name ?>'s Gallery
	</div>
</div>

<?php echo $authorlisting; ?>









<?php include('footer.php'); ?>