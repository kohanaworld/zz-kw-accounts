<?php defined('SYSPATH') OR die('No direct access allowed.');

abstract class Controller_OAuth2 extends Controller_Account {
	/**
	 * @var OAuth2
	 */
	protected $_oauth;
		/**
	 * @var OAuth_Token
	 */
	protected $_token;
	/**
	 * @var OAuth2_Provider
	 */
	protected $_provider;
	/**
	 * @var OAuth_Consumer
	 */
	protected $_consumer;
	protected $_cookie;

	public $name;

	public function before()
	{
		parent::before();
		$this->_oauth = new OAuth2;
		$this->_consumer = OAuth2_Client::factory(Kohana::config('oauth.'.$this->name));
		$this->_cookie = 'oauth_cookie_'.$this->name;
		$this->_provider = $this->_oauth->provider($this->name);
		if ($token = Cookie::get($this->_cookie))
		{
			$this->_token = unserialize($token);
		}
	}

	public function action_login()
	{
		$callback = $this->request->url(array('action' => 'complete'), Request::initial()->protocol());

		$this->_consumer->callback($callback);

		//$this->_provider->request_token($this->_consumer);
		$this->request->redirect($this->_provider->authorize_url($this->_consumer));
	}

	public function action_complete()
	{
		$code = $this->request->query('code');
		if ( ! $code)
		{
			return;
		}
		$this->_token = $this->_provider->access_token($this->_consumer, $code);
		//Cookie::set($this->_cookie, serialize($this->_token));
		if ( FALSE == $this->_auth->login('oauth2.'.$this->name, $this->_token, TRUE))
		{
			die(var_dump(Auth::instance()->get_user()));
		}
		$user = $this->_auth->get_user();
		if ( ! $user->loaded() )
		{
			// register user
			$this->_create_user($this->_auth->get_authdata());
		}
		Cookie::delete($this->_cookie);
		//$this->request->redirect($this->request->uri(array('action' => 'info')));
		$this->request->redirect(Route::get('accounts')->uri(array('action' => 'profile')));
	}

}