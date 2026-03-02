<?php

return [
	'paths' => ['api/*', 'widget'],

	'allowed_methods' => ['GET', 'POST'],

	'allowed_origins' => ['*'],

	'allowed_headers' => ['*'],

	'exposed_headers' => [],

	'max_age' => 0,
	
	'support_credentials' => false
];