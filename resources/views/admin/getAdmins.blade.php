@extends(app('users').'.Index')
@section('center')
{!! Html::style(app('css').'/Results.css') !!}
<!-- Start Section Page -->
<section class="pageSection">
	<div class="container">
		<div class="row">
			<div class="asideLeft col s12 left">
				<h4>{{trans('getAdmins.H4')}}</h4>
				@foreach($getAdmins as $Admin)
					<h5>{{trans('getAdmins.Name')}}: {{$Admin->username}}</h5>
					<h5>
						{{trans('getAdmins.Edit')}}:
						<a class="btn-floating waves-effect waves-light teal lighten-1" href="{{url('admin/edit')}}/{{$Admin->id}}">
							<i class="material-icons">send</i>
						</a>
					</h5>
					<hr>
				@endforeach
			</div>
		</div>
	</div>
</section>
@stop