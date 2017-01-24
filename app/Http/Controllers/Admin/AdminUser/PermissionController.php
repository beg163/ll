<?php

namespace App\Http\Controllers\Admin\AdminUser;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Admin\Permission;
use Auth;

class PermissionController extends Controller
{
	public function __construct()
	{
		$this->middleware('permit:admin.permission,对不起，你没有此权限！,admin/index');
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		$permissions = Permission::orderBy('cid');

		if($request->input('search')) {
			$permissions->where('name', 'like', '%'.$request->input('search').'%');
			$permissions->orWhere('label', 'like', '%'.$request->input('search').'%');
			$permissions->orWhere('description', 'like', '%'.$request->input('search').'%');
		}
		
		$permissions	= $permissions->paginate($request->input('pagesize') ? $request->input('pagesize') : config('app.page_size'));

		return view('admin.adminuser.permissionList', [
			'bdb'	=> [['name'=>'后台用户管理'], ['name'=>'权限管理'],], 
			'permissions'	=> $permissions,
			]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.adminuser.permissionForm', [
			'bdb'	=> [['name'=>'后台用户管理'], ['name'=>'添加权限'],], 
			'groups'=> Permission::where('cid', 0)->get(),
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
			'name' => 'required|unique:admin_permissions|max:255',
			'label' => 'required|max:255',
			'cid' => 'required|integer|between:0,999',
			]);

		$permission = new Permission();
		$permission->name	= $request->input('name');
		$permission->label	= $request->input('label');
		$permission->description	= $request->input('description');
		$permission->cid	= $request->input('cid');
		$permission->icon	= '';
		$permission->save();

		event(new \App\Events\AdminActionEvent(
			'\App\Models\Admin\Permission', 
			$permission->id, 
			1, 
			"用户".Auth::guard('admin')->user()->username."{".Auth::guard('admin')->user()->id."}添加了权限".$permission->name."{".$permission->label."}"
		));

		return redirect('admin/adminuser/permission')->withSuccess('添加成功！');
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
        $permission	= Permission::find((int)$id);

		if(empty($permission))
			return redirect('admin/adminuser/permission')->withErrors('没有此权限！');

		return view('admin.adminuser.permissionForm', [
			'bdb'	=> [['name'=>'后台用户管理'], ['name'=>'修改权限'],], 
			'permission'	=> $permission,
			'groups'=> Permission::where('cid', 0)->get(),
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
			'name' => 'required|unique:admin_permissions,name,'.$id.'|max:255',
			'label' => 'required|max:255',
			'cid' => 'required|integer|between:0,999',
			]);

		$permission = Permission::find((int)$id);

		if(empty($permission))
			return redirect('admin/adminuser/permission')->withErrors('没有此权限！');

		$permission->name	= $request->input('name');
		$permission->label	= $request->input('label');
		$permission->description	= $request->input('description');
		$permission->cid	= $request->input('cid');
		$permission->save();

		event(new \App\Events\AdminActionEvent(
			'\App\Models\Admin\Permission', 
			$permission->id, 
			3, 
			"用户".Auth::guard('admin')->user()->username."{".Auth::guard('admin')->user()->id."}编辑权限".$permission->name."{".$permission->label."}"
		));

		return redirect('admin/adminuser/permission')->withSuccess('修改成功！'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = Permission::find((int)$id);

		if(empty($permission))
			return redirect('admin/adminuser/permission')->withErrors('没有此权限！');

		$child = Permission::where('cid', $id)->first();

        if ($child)
            return redirect()->back()->withErrors("请先将该权限的子权限删除后再做删除操作!");

		foreach ($permission->roles as $v) {
            $permission->roles()->detach($v->id);
        }

        $permission->delete();

		event(new \App\Events\AdminActionEvent('\App\Models\Admin\Permission',
			$permission->id,
			2,"用户".Auth::guard('admin')->user()->username."{".Auth::guard('admin')->user()->id."}删除成功权限".$permission->name."{".$permission->label."}"
		));
        return redirect()->back()
            ->withSuccess("删除成功");
    }
}
