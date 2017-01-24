@extends('layouts.adminApp')

@section('content')
<div class="row">
	<div class="col-xs-12">
		<div class="box box-success">
			<div class="box-body table-responsive">
				@if (isset($permission) && $permission->id) 
				<form class="form-horizontal" role="form" action="{{url('admin/adminuser/permission/'.$permission->id)}}" method="POST">
					{{ method_field('PUT') }}
					@else  
					<form class="form-horizontal form-to-check" role="form" action="{{url('admin/adminuser/permission')}}" method="post">
						{{ method_field('POST') }}
						@endif

						{{ csrf_field() }}

						<input type="hidden" name="id" value="{{@$permission->id}}">

						<div class="form-group">
							<label class="col-sm-1 control-label">权限名称<small>(a.b.c)</small>:</label>
							<div class="col-sm-5">
								<input type="text" class="form-control" name="name" placeholder="权限名称" value="{{@$permission->name}}" required autofocus>
							</div>
							@if ($errors->has('name'))
							<span class="help-block">
								<strong>{{ $errors->first('name') }}</strong>
							</span>
							@endif
						</div>
						<div class="form-group">
							<label class="col-sm-1 control-label">权限解释:</label>
							<div class="col-sm-5">
								<input type="text" class="form-control" name="label" placeholder="权限解释" value="{{@$permission->label}}" required autofocus>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-1 control-label">描述与备注:</label>
							<div class="col-sm-5">
								<textarea class="form-control" rows="3" name="description" placeholder="描述与备注 ..." autofocus>{{@$permission->description}}</textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-1 control-label">权限分组:</label>
							<div class="col-sm-3">
								<select class="form-control" name="cid">
									<option value=0>顶级分组</option>
									@foreach ($groups as $group)
									<option value={{$group->id}} @if ($group->id==@$permission->cid) selected @endif>{{$group->label}}<small>{{$group->name}}</small></option>
									@endforeach
								</select>
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
