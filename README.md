Bit.ly url shorten class
===========================

### Basic use of class

```php
<?php

error_reporting(E_ALL);

require_once 'Bitly_Api.php';

$url = 'http://example.com';

$short_url = Bitly::init()->bitly_shorten(urldecode($url));

if (isset($short_url['url']))
	echo $short_url['url'];

exit;

?> 
```
