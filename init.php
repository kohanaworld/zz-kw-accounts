<?php defined('SYSPATH') OR die('No direct access allowed.');

$route = Route::set('accounts', '<action>', array('action' => '(login|logout|profile)'))
	->defaults(array(
		'controller'   => 'account',
	));

Route::set('accounts-user', 'user/<user>(/<action>)')
	->defaults(array(
		'controller'   => 'account',
		'action'       => 'profile',
	));
Route::set('accounts-auth', '<directory>/<controller>/<action>', array('directory' => '(oauth|openid)', 'action' => '(login|complete)'));