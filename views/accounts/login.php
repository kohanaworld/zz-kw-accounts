<?php defined('SYSPATH') OR die('No direct access allowed.');
$route = Route::get('accounts-auth');
$links = array(
	'openid'   => array(
		'openid'      => 'OpenID',
		'wordpress'   => 'Wordpress',
		'yahoo'       => 'Yahoo!',
		'myopenid'    => 'MyOpenID',
		'google'      => 'Google',
		'livejournal' => 'LiveJournal',
	),
	'oauth'    => array(
		'google'      => 'Google',
		'twitter'     => 'Twitter',
		'github'      => 'Github',
		'facebook'    => 'Facebook',
		'linkedin'    => 'LinkedIn',
		'vkontakte'   => 'VKontakte',
		'yandex'      => 'Yandex',
	),
);
?>
<h2><?php echo __("Select provider")?></h2>
	<div id="login-tabs">
		<ul>
			<li><a href="#openid">OpenID</a></li>
			<li><a href="#oauth">OAuth</a></li>
		</ul>
		<div id="openid">
			<?php $params = array('directory' => 'openid'); ?>
			<ul class="login-providers">
				<?php foreach($links['openid'] as $provider => $ptitle) :?>
					<li><?php echo html::anchor($route->uri(array('directory' => 'openid', 'controller' => $provider, 'action' => 'login')), $ptitle, array('class' => 'social-icon '.$provider))?></li>
				<?php endforeach; ?>
			</ul>
		</div>
		<div id="oauth">
			<ul class="login-providers">
				<?php foreach($links['oauth'] as $provider => $ptitle) :?>
					<li><?php echo html::anchor($route->uri(array('directory' => 'oauth', 'controller' => $provider, 'action' => 'login')), $ptitle, array('class' => 'social-icon '.$provider))?></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
