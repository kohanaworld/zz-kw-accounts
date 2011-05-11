<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_OpenID_Livejournal extends Controller_OpenID {

	protected $_provider = 'LiveJournal';

	public $login_template = 'auth/openid/livejournal';

}