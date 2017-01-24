@extends('layouts.adminApp')

@section('content')
<div class="row">
	<div class="col-xs-12">
		<div class="box box-success">
			<div class="box-header">
				<div class="box-tools">
					<div class="col-xs-6"><a href="{{url('admin/adminuser/permission/create')}}" class="text-red">[<i class="fa fa-plus"></i>添加权限]</a></div>
					<form method="GET" class="pull-right col-xs-6">
						<div class="input-group">
							<input type="text" name="search" class="form-control input input-sm pull-right" style="width: 200px;" placeholder="请输入关键字" value="{{request()->input('search')}}">
							<div class="input-group-btn">
								<button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-search"></i></button>
							</div>
						</div>
					</form>
				</div>
			</div><!-- /.box-header -->
			<div class="box-body table-responsive">
				<table class="table table-hover">
					<tbody><tr>
							<th>#</th>
							<th>权限名称</th>
							<th>权限解释名称</th>
							<th>描述与备注</th>
							<th width=60>CID</th>
							<th>修改时间</th>
							<th>操作</th>
						</tr>
						@foreach ($permissions as $permission)
						<tr>
							<td>{{$permission->id}}</td>
							<td>{{$permission->name}}</td>
							<td>{{$permission->label}}</td>
							<td>{{$permission->description}}</td>
							<td>{{$permission->cid}}</td>
							<td>{{$permission->updated_at}}</td>
							<td>
								<a href="{{url('admin/adminuser/permission/'.$permission->id.'/edit')}}" class="small"><i class="fa fa-edit"></i>编辑/查看</a>       
								&nbsp;
								<a href="#" onclick="confirm('{{trans('form.confirm')}}')? $(this).siblings('form').submit(): false;" class="text-red small"><i class="fa fa-times"></i>删除</a>
								<form action="{{url('admin/adminuser/permission/'.$permission->id)}}" method="post" class="hide">
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
					{{$permissions->appends(request()->all())->links()}}
				</div>
				<div class="pull-right" style="padding: 32px 10px 0px 0px;">
					<span class="small text-maroon">总计<strong class="text-red">{{$permissions->total()}}</strong>条记录</span>
				</div>
			</div>

		</div><!-- /.box -->
	</div>
</div>
@endsection
