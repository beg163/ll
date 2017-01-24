<?php

namespace App\Models\Admin;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminUser extends Authenticatable
{
    use Notifiable;
    //
	protected $fillable = [
        'name', 'email', 'password', 'avatar',
    ];

	protected $hidden = [
        'password', 'remember_token',
    ];

	//用户角色
    public function roles()
    {
        return $this->belongsToMany(Role::class,'admin_role_user','user_id','role_id');
    }

	// 判断用户是否具有某权限
    public function hasPermission($permission)
    {
        if (is_string($permission)) {
            $permission = Permission::where('name',$permission)->first();
            if (!$permission) return false;
        }

        return $this->hasRole($permission->roles);
    }

	// 判断用户是否具有某个角色
    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }

        return !!$role->intersect($this->roles)->count();
    }

	public function giveRolesTo(array $rolesId)
	{
		$this->roles()->detach();

        $roles=Role::whereIn('id',$rolesId)->get();
		
		foreach ($roles as $role) {
			$this->roles()->save($role);
		}

		return true;
	}
}
