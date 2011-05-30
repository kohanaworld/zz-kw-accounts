<?php defined('SYSPATH') OR die('No direct access allowed.');?>
<h2><?php echo $user->username ?></h2>
<ul>
	<li>email: <?php echo $auth_data->email ?></li>
	<li>provider: <?php echo $auth_data->service_name ?></li>
	<li>user login: <?php echo $auth_data->service_id ?></li>
</ul>