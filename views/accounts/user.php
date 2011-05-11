<?php defined('SYSPATH') OR die('No direct access allowed.');?>
<ul class="links" id="profile-user">
	<li>
		<?php echo HTML::anchor(Route::get('accounts-user')->uri(array('user' => $user->username)), '<span class="social-icon '.$provider.'">'.$user->username.'</span>') ?>
	</li>
	<ul class="links hidden" id="profile-popup">
		<li>
			<?php echo HTML::anchor(Route::get('accounts')->uri(array('action' => 'logout')), 'Выйти') ?>
		</li>
	</ul>
</ul>
