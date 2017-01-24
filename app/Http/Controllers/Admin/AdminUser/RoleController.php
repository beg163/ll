<?php

namespace App\Http\Controllers\Admin\AdminUser;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Admin\Role;
use App\Models\Admin\Permission;
use Auth;

class RoleController extends Controller
{
	public function __construct()
	{
		$this->middleware('permit:admin.role,对不起，你没有此权限！,admin/index');
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$role = Role::select('*');

		if($request->input('search')) {
			$role->where('name', 'like', '%'.$request->input('search').'%');
			$role->orWhere('description', '%' .$request->input('search'). '%');
		}

		$roles	= $role->paginate($request->input('pagesize') ? $request->input('pagesize') : config('app.page_size'));

		return view('admin.adminuser.roleList', [
			'bdb'	=> [['name'=>'后台用户管理'], ['name'=>'角色管理'],], 
			'roles'	=> $roles,
			]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$permissions	= Permission::all();

		$temp	= [];
		foreach ($permissions as $pn) {
			if($pn->cid == 0) {
				$temp[$pn->id]['node']	= $pn;
			}
		}
		foreach ($permissions as $pn) {
			if($pn->cid > 0) {
				$temp[$pn->cid]['children'][]	= $pn;
			}
		}

		return view('admin.adminuser.roleForm', [
			'bdb'	=> [['name'=>'后台用户管理'], ['name'=>'添加角色'],], 
			'permissions'	=> $temp,
			]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'name' => 'required|unique:admin_roles|max:255',
			]);

		$role = new Role();
		$role->name	= $request->input('name');
		$role->description	= $request->input('description');
		$role->save();

		if (is_array($request->input('permissions'))) {
			$role->givePermissionsTo($request->input('permissions'));
		}

		event(new \App\Events\AdminActionEvent(
			'\App\Models\Admin\Role', 
			$role->id, 
			1, 
			"用户".Auth::guard('admin')->user()->username."{".Auth::guard('admin')->user()->id."}添加角色".$role->name."{".$role->id."}"
		));

		return redirect('admin/adminuser/role')->withSuccess('添加成功！'); 
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$role	= Role::find((int)$id);

		if(empty($role))
			return redirect('admin/adminuser/role')->withErrors('没有此角色！');

		return view('admin.adminuser.roleForm', [
			'bdb'	=> [['name'=>'后台用户管理'], ['name'=>'修改角色'],], 
			'permissions'	=> Permission::all(),
			'role'	=> $role,
			]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'name' => 'required|unique:admin_roles,name,'.$id.'|max:255',
			]);

		$role = Role::find((int)$id);

		if(empty($role))
			return redirect('admin/adminuser/role')->withErrors('没有此角色！');

		$role->name	= $request->input('name');
		$role->description	= $request->input('description');
		$role->save();

		if (is_array($request->input('permissions'))) {
			$role->givePermissionsTo($request->input('permissions'));
		}

		event(new \App\Events\AdminActionEvent(
			'\App\Models\Admin\Role', 
			$role->id, 
			3, 
			"用户".Auth::guard('admin')->user()->username."{".Auth::guard('admin')->user()->id."}编辑角色".$role->name."{".$role->id."}"
		));

		return redirect('admin/adminuser/role')->withSuccess('修改成功！'); 
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$role = Role::find((int)$id);

		if(empty($role))
			return redirect()->back()->withErrors('没有此角色！');

        foreach ($role->users as $v){
            $role->users()->detach($v);
        }

        foreach ($role->permissions as $v){
            $role->permissions()->detach($v);
        }

        $role->delete();

		event(new \App\Events\AdminActionEvent('\App\Models\Admin\Role',
			$role->id,
			2,"用户".Auth::guard('admin')->user()->username."{".Auth::guard('admin')->user()->id."}删除角色".$role->name."{".$role->id."}"
		));
        return redirect()->back()
            ->withSuccess("删除成功");
	}
}
