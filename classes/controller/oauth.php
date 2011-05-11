<?php defined('SYSPATH') OR die('No direct access allowed.');

abstract class Controller_OAuth extends Controller_Account {

	/**
	 * @var OAuth_Token
	 */
	protected $_token;
	/**
	 * @var OAuth_Provider
	 */
	protected $_provider;
	/**
	 * @var OAuth_Consumer
	 */
	protected $_consumer;
	protected $_cookie;

	protected $_config;

	protected $_request_params = array();
	protected $_access_params = array();

	public $name;

	public function before()
	{
		parent::before();
		$this->_oauth = new OAuth;
		$this->_config = Kohana::config('oauth.'.$this->name);
		$this->_consumer =  OAuth_Consumer::factory($this->_config);
		$this->_cookie = 'oauth_cookie_'.$this->name;
		$this->_provider = OAuth_Provider::factory($this->name, $this->_config);
		if ($token = Cookie::get($this->_cookie))
		{
			$this->_token = unserialize($token);
		}
	}

	public function action_index()
	{
		return $this->action_login();
	}

	public function action_login()
	{
		$this->_consumer->callback($this->request->url(array('action' => 'complete'), 'http'));
		$token = $this->_provider->request_token($this->_consumer, $this->_request_params);
		Cookie::set($this->_cookie, serialize($token));
		//$this->request->redirect($this->_provider->authorize_url($token, $this->_consumer));
		$this->request->redirect($this->_provider->authorize_url($token));
	}

	public function action_complete()
	{
		if ($this->_token AND $this->_token->token !== Arr::get($_GET, 'oauth_token'))
		{
			// Delete the token, it is not valid
			Cookie::delete($this->_cookie);

			// Send the user back to the beginning
			$this->request->redirect($this->request->uri(array('action' => 'index')));
		}

		// Get the verifier
		$verifier = Arr::get($_GET, 'oauth_verifier');

		// Store the verifier in the token
		$this->_token->verifier($verifier);
		// Exchange the request token for an access token
		$this->_token = $this->_provider->access_token($this->_consumer, $this->_token, $this->_access_params);
		// Store the access token
		//Cookie::set($this->_cookie, serialize($this->_token));

		if ($this->_auth->login('oauth.'.$this->name, $this->_token, TRUE) === FALSE)
		{
			die('failed!');
		}
		$user = $this->_auth->get_user();
		if ( ! $user->loaded() )
		{
			// register user
			$this->_create_user($user);
		}

		Cookie::delete($this->_cookie);
		//$this->request->redirect($this->request->uri(array('action' => 'info')));
		$this->request->redirect(Route::get('accounts')->uri(array('action' => 'profile')));
	}
}