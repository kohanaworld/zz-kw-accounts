<?php defined('SYSPATH') OR die('No direct access allowed.');?>
<h2>Enter your MyOpenID username</h2>
<form action='/openid/myopenid/login' method='POST'>
	http://<input type='text' id='openid_identifier' name='openid_identifier' />.myopenid.com
	<input type='submit' value='Sign in' />
</form>