@extends(app('users').'.Index')
@section('center')
{!! Html::style(app('css').'/createStyle.css') !!}
<script type="text/javascript">
	$(document).ready(function(){
		@if(session()->has('errorEditUser'))
			Materialize.toast('كل الحقول مطلوبة.', 4000);
		@endif
	});
</script>
<!-- Start Section Page -->
<section class="pageSection">
	<div class="container">
		<div class="row">
			<div class="asideLeft col s12 left">
				<h4>{{trans('editUser.H4')}}</h4>
					{!! Form::open(['url'=>'admin/panel/edit/'.$getUser->id,'method'=>'post']) !!}
						<div class="input-field col s12"> 
							<h5>{{trans('editUser.Admin')}}</h5>
							{!! Form::number('admin',$getUser->admin,['class'=>'validate','min'=>0,'max'=>2]) !!}
						</div>
						<p>
						<div class="input-field col s12">
							<button class="btn waves-effect waves-light" type="submit">	 {{trans('editUser.Submit')}}
								<i class="material-icons right">send</i>
							</button>
						</div>
					{!! Form::close() !!}
			</div>
		</div>
	</div>
</section>
@stop