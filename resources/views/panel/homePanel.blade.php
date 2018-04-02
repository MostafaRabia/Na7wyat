@extends(app('users').'.Index')
@section('center')
{!! Html::style(app('css').'/homePanel.css') !!}
{!! Html::style(app('css').'/datatables.min.css') !!}
{!! Html::script(app('js').'/datatables.min.js') !!}
{!! Html::script(app('js').'/homePanel.min.js') !!}
<!-- Start Section Info -->
<section class="pageSection">
	<div class="container">
		<div class="row">
			<div class="asideLeft col s12 left">
				<h5>
					{{trans('homePanel.Refresh')}}: 
					<a class="btn-floating waves-effect waves-light red lighten-2" href="{{url('getusers/')}}/{{session('token')}}">
						<i class="material-icons">send</i>
					</a>
				</h5>
				<h5>
					{{trans('homePanel.Exams')}}: 
					<a class="btn-floating waves-effect waves-light teal" href="{{url('admin/panel/exams')}}">
						<i class="material-icons">send</i>
					</a>
				</h5>
				<h5>
					{{trans('homePanel.Add')}}: 
					<a class="btn-floating waves-effect waves-light deep-purple" href="{{url('admin/panel/add')}}">
						<i class="material-icons">send</i>
					</a>
				</h5>
				<hr />
				<table id="example" class="display" style="width:100%">
			        <thead>
			            <tr style="color:white;">
			                <th>{{trans('homePanel.Id')}}</th>
			                <th>{{trans('homePanel.Name')}}</th>
			                <th>{{trans('homePanel.Admin')}}</th>
			                <th>{{trans('homePanel.Edit')}}</th>
			            </tr>
			        </thead>
			        <tbody>
			        	@foreach($getUsers as $User)
				            <tr>
				                <td>{{$User->id}}</td>
				                <td>{{$User->username}}</td>
				                <td>{{$User->admin}}</td>
				                <td>
				                	<a class="btn-floating waves-effect waves-light teal" href="{{url('admin/panel/edit/')}}/{{$User->id}}">
										<i class="material-icons">send</i>
									</a>
				                </td>
				            </tr>
			            @endforeach
			        </tbody>
			        <tfoot>
			            <tr style="color:white;">
			            	<th>{{trans('homePanel.Id')}}</th>
			                <th>{{trans('homePanel.Name')}}</th>
			                <th>{{trans('homePanel.Admin')}}</th>
			                <th>{{trans('homePanel.Edit')}}</th>
			            </tr>
			        </tfoot>
			    </table>
			</div>
		</div>
	</div>
</section>
<!-- End Section Info -->
@stop