<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_OpenID_Wordpress extends Controller_OpenID {

	protected $_provider = 'Wordpress';

	public $login_template = 'auth/openid/wordpress';

}