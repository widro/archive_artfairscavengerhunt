<?php
/*
Template Name: Upload
*/




if($_POST['submitbtn']){
	print_r($_FILES);
	echo $_FILES['uploadedpic']['type'];

	$path = "/nfs/c03/h03/mnt/54729/domains/artfairscavengerhunt.com/html/wordpress/wp-content/uploads/2012/02/";
	$uploadedpic = $_POST['uploadedpic'];


	$the_file = $_FILES['uploadedpic']['tmp_name'];
	$thefile_name = $_FILES['uploadedpic']['name'];
	$thefile_type = $_FILES['uploadedpic']['type'];



    $aErrors = "";
    if ( !empty( $thefile_name ) ) // no file selected
    {
        if ( ( $thefile_type == "image/gif" ) ||
             ( $thefile_type == "image/pjpeg" ) ||
             ( $thefile_type == "image/jpeg" ) ){
            if ( $thefile_size < ( 1024 * 100 ) ){
                $aCurBasePath = dirname( $path );
                $aNewName = $path . $thefile_name;
                copy( $the_file, $aNewName );
            } else {
                $aErrors .= "The file was too big";
            }
        } else {
            $aErrors .= "The file was neither a gif nor a jpeg";
        }
    } else{
        $aErrors .= "No file was selected";
    }







	$submitgamearray = array();
	$submitgamearray['post_status'] = "publish";
	$submitgamearray['post_type'] = 'post';


	$submitgamearray['post_content'] = "http://artfairscavengerhunt.com/wordpress/wp-content/uploads/2012/02/" . $thefile_name;
	$submitgamearray['post_title'] = "Picture Uploaded #" . rand(1111,9999);
	$submitgamearray['post_category'] = array("ANAL");
	//$submitgamearray['tags_input'] = $topicname;
	// wp post insert
	$newgameid = wp_insert_post($submitgamearray);

	$post_categories = $_POST['piccategory'];
	$addcats = wp_set_object_terms($newgameid, $post_categories, 'category');
	//$addmeta3 = add_post_meta($newgameid, $key3, $value3, $unique = false);

	if (is_user_logged_in()){
		echo $newgameid . "  Welcome, registered user!";
	}
	else{
		echo "Not Registered!";

	?>
	<form method="post" enctype="multipart/form-data">
	<h3>Register!</h3>

	<input type="hidden" id="postidchange" name="postidchange" value="<?php echo $newgameid; ?>">
	<?php include('registerform.php'); ?>
	</form>

	<?php
	}



}


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


<form enctype="multipart/form-data" method="post">
<h3>Upload a pic!</h3>

<input type="file" id="uploadedpic" name="uploadedpic">


<select id="piccategory" name="piccategory">
<?php echo $catdd ?>
</select>

<input type="submit" name="submitbtn" id="submitbtn" value="Upload">

</form>



