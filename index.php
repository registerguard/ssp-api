<?php
	
	header('content-type: application/json');
	# This is not good
	#header('Access-Control-Allow-Origin: *');
	
	include('secrets/config.php');
	include('classes/DirectorPHP.php');
	
	$secret = getSecret();
	$director = new Director($secret['key'], $secret['url']);
	
	$data = array();
	$meta = array();
	$index = 0;
	$slideshow = $_GET["id"]; # Get album ID
	$slideshowcache = 'ssp-id-' + $slideshow;
	
	# When your application is live, it is a good idea to enable caching.
	# You need to provide a string specific to this page and a time limit 
	# for the cache. Note that in most cases, Director will be able to ping
	# back to clear the cache for you after a change is made, so don't be 
	# afraid to set the time limit to a high number.
	
	//$director->cache->set('example', '+5 minutes');
	
	# What sizes do we want?
	$director->format->add(array('name' => 'large', 'width' => '1960', 'height' => '1960', 'crop' => 0, 'quality' => 100, 'sharpening' => 0));
	$director->format->add(array('name' => 'small', 'width' => '600', 'height' => '600', 'crop' => 0, 'quality' => 80, 'sharpening' => 0));
	
	# Make API call using get_album method. Replace '1' with the numerical ID for your album:
	$album = $director->album->get($slideshow, array('images_only' => true));

	# Set images variable for easy access:
	$contents = $album->contents;
	#print_r($contents);
	
	foreach ($contents as $image) {
		
		$meta[0] = explode(' (', $image->caption);
		$meta[1] = explode('/', $meta[0][1]);
		
		$data[] = array(
			'large' => $image->large->url,
			'small' => $image->small->url,
			'caption' => nl2br(trim($meta[0][0])),
			'credit' => trim($meta[1][0]),
			'org' => trim(substr($meta[1][1], 0, -1)),
			'title' => $image->title,
			'link' => $image->link
		);
		
		/*
		# Necessary attributes for Galleria
		$data[] = array(
			'id' => $image->id,
			'byline' => trim($meta[1][0]),
			'description' => $image->caption,
			'image' => $image->large->url,
			'preview' => $image->small->url
		);
		*/
		
		# To see all available attributes
		#echo var_dump($image);
		
		$index++;
		
	}
	
	# For possible JSONP callback
	echo ((isset($_GET['callback'])) ? $_GET['callback'] . '(' : '');
	echo json_encode($data);
	echo ((isset($_GET['callback'])) ? ')' : '');
