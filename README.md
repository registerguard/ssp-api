#ssp api

## ./secrets/config.php example

```php

<?php
	
	function getSecret(){
		
		$secret = array(
			'key' => 'local-asdfasdfasdfasdfasdfasdfasdfasdf',
			'url' => 'wherever.your/local/setup/is/hosted'
		);
		
		return $secret;
		
	}
	
?>

```

## Overview

What you're using this for is to take SSP photos and throw them out in JSON format for Galleria to grab on to.

Given that SlideShow Pro is no more, I've included all of the Directory code in this repo.

For RG credentials see: http://slideshow.registerguard.com/slideshowpro/index.php?/accounts/info

See example.json for example of SSP > Galleria. For more on that process see: [RG wiki](https://github.com/registerguard/rg/wiki/Galleria-integration) (private)

## ~~Basic~~ Old instructions:

1. Go to [slideshowpro.net](http://slideshowpro.net)
2. Click on Account Center
3. Log in
4. Click Accessories
5. Download the PHP API kit 1.5 beta
6. Clone this repo
7. Replace the ssp `index.php` with the one from this repo, also add the `page.html` to the folder
8. Replace the dummy credentials in `index.php` with your own
  * There should be three places
9. Put the PHP file up on a server
10. Put that URL into the `page.html` folder

That should be it. Put the images into a slider or whatever of your choice.
