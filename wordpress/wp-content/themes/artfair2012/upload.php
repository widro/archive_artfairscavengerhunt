<?php
/*
Template Name: Upload
*/
?>

<?php
$categories=get_categories('hide_empty=0');
foreach ($categories as $category) {
	$slug = $category->category_nicename;
	$name = $category->cat_name;
	$count = $category->category_count;
	$description = $category->description;

	$catdd .= "
	<option value=\"$slug\">$name</option>

	";

}
?>


<form>
<h3>Upload a pic!</h3>

<input type="file">
<select>
<?php echo $catdd ?>
</select>

<input type="submit" value="Upload">

</form>



