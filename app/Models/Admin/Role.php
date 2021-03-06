<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	protected $table='admin_roles';
    //

	public function users()
    {
        return $this->belongsToMany(AdminUser::class,'admin_role_user','role_id','user_id');
    }

	public function permissions()
    {
        return $this->belongsToMany(Permission::class,'admin_role_permission','role_id','permission_id');
    }

	//给角色添加权限
    public function givePermissionTo($permission)
    {
        return $this->permissions()->save($permission);
    }

	//角色权限整体添加与修改
	public function givePermissionsTo(array $permissionId)
	{
		$this->permissions()->detach();
        $permissions=Permission::whereIn('id',$permissionId)->get();
        foreach ($permissions as $v){
            $this->givePermissionTo($v);
        }
        return true;
	}
}
