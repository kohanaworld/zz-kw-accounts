<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_OAuth_VKontakte extends Controller_OAuth2 {
	/**
	 * @var  OAuth2_Provider_VKontakte
	 */
	protected $_provider;

	public $name = 'vkontakte';
}
