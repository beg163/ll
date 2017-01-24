<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
	protected $table='admin_permissions';
    //

	public function roles()
    {
        return $this->belongsToMany(Role::class,'admin_role_permission','permission_id','role_id');
    }
}
