<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * @property Auth $_auth
 * @property Model_User $_user
 */
class Controller_Account extends Controller_Template {

	/**
	 * @param  Model_Auth_Data $user
	 * @return void
	 */
	protected function _create_user($user)
	{
		$new_user = Jelly::factory('user')
			->set('username', $user->service_name)
			->set('auth_data', $user);
		$new_user->save();
		$user->user = $new_user;
		$user->save();
		// refresh user
		$this->_auth->get_user(TRUE);
	}

	/**
	 * Shows login page
	 *
	 * @return void
	 */
	public function action_login()
	{
		$this->template->title = __('Select your provider');
		$this->template->content = View::factory('accounts/login');
		StaticCss::instance()->addCssStatic('css/accounts/login.css');
		StaticJs::instance()->addJsStatic('js/accounts/login.js');
	}

	/**
	 * Log out and redirect back
	 *
	 * @return void
	 */
	public function action_logout()
	{
		$this->_auth->logout();
		$this->request->redirect();
	}

	public function action_profile()
	{
		$this->template->content = View::factory('accounts/profile')
			->set('user', $this->_auth->get_user())
			->set('auth_data', $this->_auth->get_authdata());
		//var_dump($this->_user);
		//echo (($user = $this->_auth->get_user()) ? $user->user->username : 'guest');
	}

	public function action_loginboard()
	{
		if ( ! $this->_ajax)
		{
			throw new HTTP_Exception_404();
		}

		if ($this->_user)
		{
			$provider = explode('.', $this->_auth->get_authdata()->service_name);
			$this->template->content = View::factory('accounts/user')
				->set('user', $this->_user)
				->set('provider', end($provider));
		}
		else
		{
			$this->template->content = View::factory('accounts/guest');
		}
	}
}