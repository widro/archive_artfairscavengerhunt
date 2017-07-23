<?php





function makeexcerpt($content, $excerpt, $type){
	$yo = 1;
	if(!$excerpt){
		$yo = 2;

		$content_exploded = explode("<!--more-->", $content);
		$excerpt = $content_exploded[0];

		if(!$content_exploded[1]){
			$yo = 3;
			$excerpt = substr(strip_tags($content), 0, 250);
		}
	}

	return $excerpt;

}







?>