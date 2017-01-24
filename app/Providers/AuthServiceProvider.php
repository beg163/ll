<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
	/**
	 * The policy mappings for the application.
	 *
	 * @var array
	 */
	protected $policies = [
		'App\Model' => 'App\Policies\ModelPolicy',
		];

	/**
	 * Register any authentication / authorization services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->registerPolicies();

		if(!empty($_SERVER['SCRIPT_NAME']) && strtolower($_SERVER['SCRIPT_NAME']) ==='artisan' ){
            return false;
        }

		//判断超级用户
		Gate::before(function ($user, $ability) {
			if ($user->super === 1) {
				return true;
			}
		});

		$permissions = \App\Models\Admin\Permission::with('roles')->get();

		foreach ($permissions as $permission) {
			Gate::define($permission->name, function ($user) use ($permission) {
				return $user->hasPermission($permission);
			});
		}
	}
}
