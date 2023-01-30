<?php

spl_autoload_register(function($className) {
	$file = __DIR__ . '\\..\\app\\' . $className . '.php';
	$file = str_replace('\\', DIRECTORY_SEPARATOR, $file);
	if (file_exists($file)) {
		require_once $file;
	}
});


use Hotel\User;

$user = new User();

// Check if there is a token in the request
if (isset($_COOKIE['user_token'])) {
	$userToken = $_COOKIE['user_token'];
	if ($userToken){
		//Verify user
		if($user->verifyToken($userToken)) {
			// Set user in memory
			$userInfo = $user->getTokenPayload($userToken);
			User::setCurrentUserId($userInfo['user_id']);
			//var_dump(User::getCurrentUserId());
			//print_r($userInfo);
			//die;
		}
	}
}

