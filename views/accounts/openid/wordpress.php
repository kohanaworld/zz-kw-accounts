<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<h2>Enter your Wordpress username</h2>
<form action='/openid/wordpress/login' method='POST'>
	http://<input type='text' id='openid_identifier' name='openid_identifier' />.wordpress.com
	<input type='submit' value='Sign in' />
</form>