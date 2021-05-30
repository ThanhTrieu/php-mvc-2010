<?php

require 'vendor/autoload.php';
require 'app/config/session.php';

if(file_exists('route/web.php')){
	define('ROOT_PATH', 'index.php');

	require 'app/config/app.php';
	require 'app/helper/common.php';
	require 'route/web.php';
	
} else {
	echo 'website dang duoc nang cap, vui long quay lai sau';
}