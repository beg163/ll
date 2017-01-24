<?php
//定义各种菜单
return [
	'admin' => [

		'admin/adminuser' => [
			'name'	=> '后台用户管理',
			'children' => [
				'用户管理' => 'admin/adminuser/user',
				'权限管理' => 'admin/adminuser/permission',
				'角色管理' => 'admin/adminuser/role',
			],
			'icon'	=> 'fa fa-user'
		],

		'admin/user' => [
			'name'	=> '前台用户管理',
			'url'	=> 'admin/user/user',
			'icon'	=> 'fa fa-user',
		],

	],
];
?>
