<?php

return [

    'passport' => [
        'login_endpoint' => env('PASSPORT_LOGIN_ENDPOINT'),
        'client_id' => env('PASSPORT_CLIENT_ID'),
        'client_secret' => env('PASSPORT_CLIENT_SECRET'),
    ],
	
	'facebook' => [
        
		'FACEBOOK_APP_ID' => '',
        'FACEBOOK_APP_SECRET' => '',
        'FACEBOOK_REDIRECT_URI' => '',
        'ENDPOINT_BASE' => 'https://graph.facebook.com/v10.0/',
		'ACCESS_TOKEN'=>'',
		'PAGE_ID'=>'',
		'INSTA_ACCOUNT_ID'=>''
    ]
];