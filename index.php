<?php
	
	header('content-type: application/json');
	
	include('classes/DirectorPHP.php');
	
	$director = new Director('hosted-XXXXXXXXXXXXXXXXX', 'XXXXXXXXXXXXXXXXX.slideshowpro.com');
	
	$data = array();
	$meta = array();
	$index = 0;
	
	# When your application is live, it is a good idea to enable caching.
	# You need to provide a string specific to this page and a time limit 
	# for the cache. Note that in most cases, Director will be able to ping
	# back to clear the cache for you after a change is made, so don't be 
	# afraid to set the time limit to a high number.
	
	//$director->cache->set('election-2014-general', '+30 minutes');
	
	# What sizes do we want?
	$director->format->add(array('name' => 'large', 'width' => '1960', 'height' => '1960', 'crop' => 0, 'quality' => 100, 'sharpening' => 0));
	
	# Make API call using get_album method. Replace '1' with the numerical ID for your album:
	$album = $director->album->get(456240, array('images_only' => true));

	# Set images variable for easy access:
	$contents = $album->contents;
	//print_r($contents);
	
	foreach ($contents as $image) {
		
		$meta[0] = explode(' (', $image->caption);
		$meta[1] = explode('/', $meta[0][1]);
		
		$data[] = array(
			'url' => $image->large->url,
			'caption' => nl2br(trim($meta[0][0])),
			'credit' => trim($meta[1][0]),
			'org' => trim(substr($meta[1][1], 0, -1)),
			'title' => $image->title,
			'link' => $image->link
		);
		
		$index++;
		
	}
	
	echo ((isset($_GET['callback'])) ? $_GET['callback'] . '(' : '');
	echo json_encode($data);
	echo ((isset($_GET['callback'])) ? ')' : '');
