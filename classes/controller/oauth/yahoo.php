<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_OAuth_Yahoo extends Controller/*_OAuth*/ {

	/**
	 * @var OAuth_v1_Provider_Twitter
	 */
	protected $_provider = 'yahoo';
	/**
	 * @var OAuth_Consumer
	 */
	protected $_consumer;
	/**
	 * @var OAuth_Token
	 */
	protected $_token;
	/**
	 * @var OAuth_v1
	 */
	protected $_oauth;
	protected $_cookie = 'cookie_oauth_yahoo';

	public function action_login()
	{
		$this->_oauth = OAuth::v1();
		$this->_consumer = $this->_oauth->consumer(Kohana::config('oauth.'.$this->_provider));
		$this->_provider = $this->_oauth->provider($this->_provider);
		$this->_consumer->callback($this->request->url(array('action' => 'complete'), 'http'));
		var_dump($this->_provider->request_token($this->_consumer, array(
			CURLOPT_PROXY => '10.162.2.198:8080',
			CURLOPT_SSL_VERIFYPEER => FALSE,
		)));
	}

	public function action_complete()
	{
		echo 'complete';
	}


}