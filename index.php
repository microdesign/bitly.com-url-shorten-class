<?php
/**
 * Test of bit.ly class
 * .
 * @author: Martin Tonev
 * @link themes.microdesign.com
 */

error_reporting(E_ALL);

require_once 'Bitly_Api.php';

$url = 'http://example.com';

$short_url = Bitly::init()->bitly_shorten(urldecode($url));

if (isset($short_url['url']))
	echo $short_url['url'];

exit;

?> 
