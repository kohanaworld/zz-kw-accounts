<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_Auth extends Controller_Template {

	/**
	 * @var Auth
	 */
	protected $_auth;
	/**
	 * @var Model_Auth_Data
	 */
	protected $_user;

	protected function _create_user($user)
	{
		$new_user = Jelly::factory('user')->set('username', $user->service_id);
		$new_user->save();
		$user->user = $new_user;
		$user->save();
		$new_user->auth_data = $user;
		$new_user->save();
		// refresh user
		$this->_auth->get_user(TRUE);
	}

	public $template = 'auth/layout';

	public function before()
	{
		parent::before();
		$this->_auth = Auth::instance();
		$this->_user = $this->_auth->get_user();
	}

	public function action_login()
	{
		$this->template->title = 'Select your provider';
		$this->template->content = View::factory('auth/login');
	}

	public function action_logout()
	{
		$this->_auth->logout();
		$this->request->redirect('/auth/login');
	}

	public function action_profile()
	{
		if ( ! $this->_user)
		{
			$this->request->redirect('/auth/login');
		}
		$this->template->title = 'User profile';
		$this->template->content = View::factory('auth/profile')->set('user', $this->_user);
	}

	public function action_account()
	{
		if ( $this->request->is_initial() )
		{
			throw new Kohana_Exception('This action can be accessed via HMVC call only!');
		}

		$this->auto_render = FALSE;
		if ($this->_user)
		{
			echo View::factory('auth/loggedin')->set('user', $this->_user)->set('provider', str_replace('.', ' ', $this->_user->service_name));
			//echo 'hello, '.$this->_user->username.'! ';
			//echo html::anchor('/auth/logout', 'logout');
		}
		else
		{
			echo View::factory('auth/guest');
			//echo 'hello, stranger! ';
			//echo html::anchor('/auth/login', 'login');
		}
	}

}