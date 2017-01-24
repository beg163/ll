@extends('layouts.adminApp')

@section('content')
<div class="row">
	<div class="col-xs-12">
		<div class="box box-success">
			<div class="box-header">
				<div class="box-tools">
					<div class="pull-left"><a href="{{url('admin/adminuser/user/create')}}" class="text-red">[<i class="fa fa-plus"></i>添加账户]</a></div>
					<form method="GET" class="pull-right">
						<div class="input-group">
							<label class="">账号:</label>
							<input type="text" name="name" class="form-control input" style="width: 200px;" placeholder="账号" value="{{request()->input('name')}}">
							<label class="m_left_10">邮箱:</label>
							<input type="text" name="email" class="form-control input" style="width: 200px;" placeholder="邮箱" value="{{request()->input('email')}}">
							<label class="m_left_10">角色:</label>
							<select class="form-control " style="width: 150px;" name="role">
								<option value="">{{trans('form.select')}}</option>
								@foreach ($roles as $role)
								<option value="{{$role->id}}" @if($role->id == request()->input('role')) selected @endif>{{$role->name}}</option>
								@endforeach
							</select>
							<button class="btn btn-primary m_left_20" type="submit"><i class="fa fa-search"></i></button>
						</div>
					</form>
				</div>
			</div><!-- /.box-header -->
			<div class="box-body table-responsive">
				<table class="table table-hover">
					<tbody><tr>
							<th>#</th>
							<th>账号</th>
							<th>邮箱</th>
							<th>角色</th>
							<th>超级用户</th>
							<!--<th>头像</th>-->
							<th>创建时间</th>
							<th>操作</th>
						</tr>
						@foreach ($users as $user)
						<tr>
							<td>{{$user->id}}</td>
							<td>{{$user->name}}</td>
							<td>{{$user->email}}</td>
							<td>
								@if($user->roles->count())
								@foreach ($user->roles as $ur)
								{{$ur->name}}|
								@endforeach
								@else
								<span class="text-danger">无</span>
								@endif
							</td>
							<td>
								@if($user->super) 
								<span class="label label-danger">是</span> 
								@else 
								<span class="label label-success">否</span>
								@endif 
							</td>
							<!--<td>
								@if($user->avatar)
								<img src="{{asset($user-avatar)}}" width="40" height="40">
								@else
								<img src="{{asset('assets/img/avatar3.png')}}" width="40" height="40">
								@endif
							</td>-->
							<td>{{$user->created_at}}</td>
							<td>
								<a href="{{url('admin/adminuser/user/'.$user->id.'/edit')}}" class="small"><i class="fa fa-edit"></i>编辑/查看</a>       
								&nbsp;
								<a href="#" onclick="confirm('{{trans('form.confirm')}}')? $(this).siblings('form').submit(): false;" class="text-red small"><i class="fa fa-times"></i>删除</a>
								<form action="{{url('admin/adminuser/user/'.$user->id)}}" method="post" class="hide">
									{{ method_field('DELETE') }}
									{{ csrf_field() }} 
								</form>
							</td>
						</tr>
						@endforeach
				</tbody></table>
			</div><!-- /.box-body -->
			<div class="box-footer clearfix">
				<div class="pull-right">
					{{$users->appends(request()->all())->links()}}
				</div>
				<div class="pull-right" style="padding: 32px 10px 0px 0px;">
					<span class="small text-maroon">总计<strong class="text-red">{{$users->total()}}</strong>条记录</span>
				</div>
			</div>

		</div><!-- /.box -->
	</div>
</div>
@endsection
