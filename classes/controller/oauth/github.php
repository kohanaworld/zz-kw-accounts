<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_OAuth_Github extends Controller_OAuth2 {
	/**
	 * @var  OAuth_v2_Provider_Github
	 */
	protected $_provider;

	public $name = 'github';
}