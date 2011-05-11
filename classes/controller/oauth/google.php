<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_OAuth_Google extends Controller_OAuth {

	protected $_request_params = array(
		'scope'   => 'http://www-opensocial.googleusercontent.com/api/people/',
	);

	public $name = 'google';

}