<?php defined('SYSPATH') OR die('No direct access allowed.');?>
<h2><?php echo $user->username ?></h2>
<ul>
	<img src="<?php echo $user->get_avatar(80) ?>" width='80' />
	<li>email: <?php echo $auth_data->email ?></li>
	<li>provider: <?php echo $auth_data->service_type ?></li>
	<li>user login: <?php echo $auth_data->service_name ?></li>
</ul>
<a href="/logout">Выйти</a>