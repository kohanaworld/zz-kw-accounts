<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_Openid extends Controller_Account {

	/**
	 * @var OpenID
	 */
	protected $_openid;

	protected $_provider;
	protected $_id_required = TRUE;
	protected $_id_key = 'openid_identity';

	public function before()
	{
		parent::before();
		$this->_openid = OpenID::factory($this->_provider);
	}

	public function action_login()
	{
		if ($this->_openid->mode())
		{
			return $this->action_complete();
		}

		$in_process = $this->_id_required ? ! empty($_POST) : TRUE;

		if ($in_process)
		{
			$id = $this->_id_required ? arr::get($_POST, 'openid_identifier') : NULL;
			Cookie::set($this->_id_key, $id);
			$this->_openid->returnUrl($this->request->url(array('action' => 'complete'), 'http'))->login($id);
		}
		else
		{
			$this->template->title = 'Log in with '.($this->_provider ? $this->_provider : 'your').' OpenID provider';
			$this->template->content = View::factory('accounts/openid/'.($this->_provider ? strtolower($this->_provider) : 'openid' ));
		}

	}

	public function action_complete()
	{
		if ($this->_openid->complete_login())
		{
			$provider = 'openid' . ($this->_provider ? '.'.strtolower($this->_provider) : '');
			if ($this->_auth->login($provider, $this->_openid->identity(), Cookie::get($this->_id_key)))
			{
				$user = $this->_auth->get_user();
				if ( ! $user->loaded() )
				{
					// register user
					$this->_create_user($user);
				}
				$this->request->redirect(Route::get('accounts')->uri(array('action' => 'profile')));
			}
			else
			{
				var_dump($this->_openid->identity(), $this->_openid->attributes());
				die('error!!');
			}
		}
	}

}