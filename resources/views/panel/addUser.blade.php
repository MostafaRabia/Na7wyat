@extends(app('users').'.Index')
@section('center')
{!! Html::style(app('css').'/createStyle.css') !!}
{!! Html::script(app('js').'/addUser.min.js') !!}
<section class="pageSection">
	<div class="container">
		<div class="row">
			<div class="asideLeft col s12 left">
				<h4>{{trans('addUser.H4')}}</h4>
					{!! Form::open(['url'=>'admin/panel/add/','method'=>'post','class'=>'addUserForm']) !!}
						<div class="input-field col s12"> 
							<h5>{{trans('addUser.Add')}}</h5>
							{!! Form::number('add','',['class'=>'validate']) !!}
						</div>
						<p>
						<div class="input-field col s12">
							<button class="btn waves-effect waves-light submit" type="submit">	 {{trans('addUser.Submit')}}
								<i class="material-icons right">send</i>
							</button>
						</div>
					{!! Form::close() !!}
			</div>
		</div>
	</div>
</section>
@stop