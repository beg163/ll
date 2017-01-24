<?php

namespace App\Http\Controllers\Admin\AdminUser;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Admin\AdminUser;
use App\Models\Admin\Role;
use DB, Auth, Gate;

class UserController extends Controller
{
	public function __construct()
	{
		$this->middleware('permit:admin.adminuser,对不起，你没有此权限！,admin/index');
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		if($request->input('role')) {
			$role_users	= DB::table('admin_role_user')
				->select('user_id')
				->where('role_id', $request->input('role'))
				->get()
				->all();
			$role_users	= array_flatten($role_users);
		} 

		$users = AdminUser::with('roles');

		if(isset($role_users)) 
			$users->whereIn('id', $role_users);
		if($request->input('name'))
			$users->where('name', 'like', '%'.$request->input('name').'%');
		if($request->input('email'))
			$users->where('email', $request->input('email'));
		
		$users	= $users->paginate($request->input('pagesize') ? $request->input('pagesize') : config('app.page_size'));

		return view('admin.adminuser.userList', [
			'bdb'	=> [['name'=>'后台用户管理'], ['name'=>'用户管理'],], 
			'users'	=> $users,
			'roles'	=> Role::all(),
			]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.adminuser.userForm', [
			'bdb'	=> [['name'=>'后台用户管理'], ['name'=>'添加用户'],], 
			'roles'	=> Role::all(),
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
			'name'=>'required|unique:admin_users|min:3|max:255',
            'email'=>'unique:admin_users|email|max:255',
            'password'=>'required|confirmed|min:6|max:50'
			]);

		$user = new AdminUser();
		$user->name	= $request->input('name');
		$user->email	= $request->input('name');
		$user->password	= bcrypt($request->input('password'));
		$user->avatar	= '';
		$user->super	= 0;
		$user->save();

		if (is_array($request->input('roles'))) {
			$user->giveRolesTo($request->input('roles'));
		}

		event(new \App\Events\AdminActionEvent(
			'\App\Models\Admin\AdminUser', 
			$user->id, 
			1, 
			"用户".Auth::guard('admin')->user()->username."{".Auth::guard('admin')->user()->id."}添加用户".$user->name."{".$user->id."}"
		));

		return redirect('admin/adminuser/user')->withSuccess('添加成功！'); 
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
		$user	= AdminUser::find((int)$id);
		if(empty($user))
			return redirect('admin/adminuser/user')->withErrors('没有此用户');

        return view('admin.adminuser.userForm', [
			'bdb'	=> [['name'=>'后台用户管理'], ['name'=>'编辑用户'],], 
			'roles'	=> Role::all(),
			'user'	=> $user,
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
			'name'=>'required|unique:admin_users,name,'.$id.'|min:3|max:255',
            'email'=>'unique:admin_users,email,'.$id.'|email|max:255',
            'password'=>'confirmed|min:6|max:50'
			]);

		$user = AdminUser::find((int)$id);

		if(empty($user))
			return redirect('admin/adminuser/user')->withErrors('没有此用户！');

		$user->name	= $request->input('name');
		$user->email	= $request->input('email');
		if(!empty($request->input('password'))) {
			$user->password	= bcrypt($request->input('password'));
		}
		$user->save();

		$user->giveRolesTo($request->input('roles', []));

		event(new \App\Events\AdminActionEvent(
			'\App\Models\Admin\AdminUser', 
			$user->id, 
			3, 
			"用户".Auth::guard('admin')->user()->username."{".Auth::guard('admin')->user()->id."}编辑用户".$user->name."{".$user->id."}"
		));

		return redirect('admin/adminuser/user')->withSuccess('修改成功！'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$user = AdminUser::find((int)$id);

		if(empty($user)) {
			return redirect()->back()->withErrors('没有此用户！');
		} else if($user->super) {
			return redirect()->back()->withErrors('超级用户！请联系超级管理员');
		}

        foreach ($user->roles as $v){
            $user->roles()->detach($v);
        }

        $user->delete();

		event(new \App\Events\AdminActionEvent('\App\Models\Admin\AdminUser',
			$user->id,
			2,"用户".Auth::guard('admin')->user()->username."{".Auth::guard('admin')->user()->id."}删除用户".$user->name."{".$user->id."}"
		));
        return redirect()->back()
            ->withSuccess("删除成功");
    }
}
