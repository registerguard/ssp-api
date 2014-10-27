<?php
	
	header('content-type: application/javascript; charset=utf-8');
	
	# Include DirectorAPI class file
	# and create a new instance of the class
	# Be sure to have entered your API key and path in the DirectorPHP.php file.
	include('classes/DirectorPHP.php');
	$director = new Director('asdfasdfasdfasdfasdfasdfasdfasdfasdfasd', 'asdf.slideshowpro.com');
	
	# When your application is live, it is a good idea to enable caching.
	# You need to provide a string specific to this page and a time limit 
	# for the cache. Note that in most cases, Director will be able to ping
	# back to clear the cache for you after a change is made, so don't be 
	# afraid to set the time limit to a high number.
	# 
	// $director->cache->set('unique_cache_name', '+30 minutes');

	# What sizes do we want?
	
	$director->format->add(array('name' => 'large', 'width' => '980', 'height' => '980', 'crop' => 0, 'quality' => 100, 'sharpening' => 0));

	# Make API call using get_album method. Replace '1' with the numerical ID for your album
	$album = $director->album->get(ALBUM_ID, array('images_only' => true));

	# Set images variable for easy access
	$contents = $album->contents;
	
	$ssp_url = '';
	$ssp_caption = '';
	$ssp_title = '';
	$data = array();
	$new;
	foreach ($contents as $image): 
		$ssp_url = $image->large->url;
		$ssp_caption = $image->caption;
		$ssp_title = $image->title;
		$data[] = array(
			'url' => $ssp_url,
			array(
				'caption' => $ssp_caption,
				'title' => $ssp_title
			),
		);
	endforeach;

	$json = json_encode($data);

	echo $json;
	
?>