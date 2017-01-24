@extends('layouts.adminApp')

@section('content')
<div class="row">
	<div class="col-xs-12">
		<div class="box box-success">
			<div class="box-body table-responsive">
				@if (isset($user) && $user->id) 
				<form class="form-horizontal" role="form" action="{{url('admin/adminuser/user/'.$user->id)}}" method="POST">
					{{ method_field('PUT') }}
				@else  
				<form class="form-horizontal form-to-check" role="form" action="{{url('admin/adminuser/user')}}" method="post">
					{{ method_field('POST') }}
				@endif
			
					{{ csrf_field() }}

					<input type="hidden" name="id" value="{{@$user->id}}">

					<div class="form-group">
						<label class="col-sm-1 control-label">用户账号:</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="name" placeholder="用户账号" value="{{@$user->name}}" required autofocus>
						</div>
						@if ($errors->has('name'))
                        <span class="help-block">
                              <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
					</div>

					<div class="form-group">
						<label class="col-sm-1 control-label">Email:</label>
						<div class="col-sm-5">
							<input type="email" class="form-control" name="email" placeholder="email" value="{{@$user->email}}" autofocus>
						</div>
						@if ($errors->has('email'))
                        <span class="help-block">
                              <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
					</div>

					<div class="form-group">
						<label class="col-sm-1 control-label">登陆密码:</label>
						<div class="col-sm-5">
							<input type="password" class="form-control" name="password" placeholder="password"  autofocus>
						</div>
						@if ($errors->has('password'))
                        <span class="help-block">
                              <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
					</div>

					<div class="form-group">
						<label class="col-sm-1 control-label">确认密码:</label>
						<div class="col-sm-5">
							<input type="password" class="form-control" name="password_confirmation" placeholder="comfirm"  autofocus>
						</div>
						@if ($errors->has('comfirm'))
                        <span class="help-block">
                              <strong>{{ $errors->first('comfirm') }}</strong>
                        </span>
                        @endif
					</div>

					<div class="form-group">
						<label class="col-sm-1 control-label">角色:</label>
						<div class="col-sm-5">
							@foreach ($roles as $role)
							<div class="col-sm-6 checkbox">
        						<label>
									<input type="checkbox" name="roles[]" value="{{$role->id}}" 
									@if (isset($user))
									@foreach($user->roles as $r) 
									@if ($role->id == $r->id)  
									checked
									@endif
									@endforeach
									@endif> 
									{{$role->name}}
        						</label>
							</div>
							@endforeach
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-11">
							<button type="submit" class="btn btn-default">@lang('form.submit')</button>
						</div>
					</div>
				</form>

			</div><!-- /.box-body -->
			<div class="box-footer clearfix">
			</div>

		</div><!-- /.box -->
	</div>
</div>
@endsection
