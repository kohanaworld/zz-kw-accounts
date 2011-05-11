<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_OpenID_MyOpenID extends Controller_OpenID {

	protected $_provider = 'MyOpenID';

	public $login_template = 'auth/openid/myopenid';

}