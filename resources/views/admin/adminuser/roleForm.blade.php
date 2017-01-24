@extends('layouts.adminApp')

@section('content')
<div class="row">
	<div class="col-xs-12">
		<div class="box box-success">
			<div class="box-body table-responsive">
				@if (isset($role) && $role->id) 
				<form class="form-horizontal" role="form" action="{{url('admin/adminuser/role/'.$role->id)}}" method="POST">
					{{ method_field('PUT') }}
					@else  
					<form class="form-horizontal form-to-check" role="form" action="{{url('admin/adminuser/role')}}" method="post">
						{{ method_field('POST') }}
						@endif

						{{ csrf_field() }}

						<input type="hidden" name="id" value="{{@$role->id}}">

						<div class="form-group">
							<label class="col-sm-1 control-label">角色名称:</label>
							<div class="col-sm-5">
								<input type="text" class="form-control" name="name" placeholder="角色名称" value="{{@$role->name}}" required autofocus>
							</div>
							@if ($errors->has('name'))
							<span class="help-block">
								<strong>{{ $errors->first('name') }}</strong>
							</span>
							@endif
						</div>
						<div class="form-group">
							<label class="col-sm-1 control-label">角色描述:</label>
							<div class="col-sm-5">
								<textarea class="form-control" rows="3" name="description" placeholder="角色描述 ..." autofocus>{{@$role->description}}</textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-1 control-label">权限分配:</label>
							<div class="col-sm-10">
								@foreach ($permissions as $permission)
								<div class="box box-permission clearfix">
									<div class="box-header">
										<div class="box-tools pull-left m_left_20">
											<i class="fa fa-minus-square" data-widget="collapse" data-toggle="tooltip" title="收缩/展开" data-original-title="Collapse"></i>
										</div>
										<div class="col-sm-3 checkbox m_left_20">
											<label>
												<input type="checkbox" name="permissions[]" value="{{$permission['node']->id}}" 
												@if (isset($role))
												@foreach($role->permissions as $p) 
												@if ($permission['node']->id == $p->id)  
												checked
												@endif
												@endforeach
												@endif> 
												{{$permission['node']->name}}
												<small>[{{$permission['node']->label}}]</small>
											</label>
										</div>
									</div>
									<div class="box-body" style="margin-top:-10px;">
										@if (isset($permission['children']))
										@foreach ($permission['children'] as $child)
										<div class="col-sm-3 checkbox">
											<label>
												<input type="checkbox" name="permissions[]" value="{{$child->id}}" 
												@if (isset($role))
												@foreach($role->permissions as $p) 
												@if ($child->id == $p->id)  
												checked
												@endif
												@endforeach
												@endif> 
												{{$child->name}}
												<small>[{{$child->label}}]</small>
											</label>
										</div>
										@endforeach
										@endif
									</div><!-- /.box-body -->
									<div class="box-footer clearfix">
									</div>
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
<script>
	$(".box-header input[type='checkbox']").change(function(){
		$(this).parents(".box-permission").find("input[type='checkbox']").prop("checked", $(this).prop("checked"));
	});
</script>
@endsection
