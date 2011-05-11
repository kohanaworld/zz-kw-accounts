<?php defined('SYSPATH') OR die('No direct access allowed.');?>
<ul class="links" id="profile-user">
	<li>
		<?php echo HTML::anchor(Route::get('accounts')->uri(array('action' => 'login')), 'Войти') ?>
	</li>
</ul>