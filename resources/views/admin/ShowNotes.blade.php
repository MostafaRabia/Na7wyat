@extends(app('users').'.Index')
@section('center')
{!! Html::style(app('css').'/createStyle.css') !!}
<!-- Start Section Page -->
<section class="pageSection">
	<div class="container">
		<div class="row">
			<div class="asideLeft col s12 left">
				<h4>{{trans('Notes.H4')}}</h4>
					<div class="input-field col s12"> 
						<h5>{{trans('Notes.Que')}}</h5>
						<p class="flow-text">{{$getResult->Ques->ques}}</p>
						<h5>{{trans('Notes.Ans')}}</h5>
						<p class="flow-text">{{$getResult->answer}}</p>
					</div>
					{!! Form::open(['url'=>'notes/'.$getResult->id,'method'=>'post']) !!}
						<div class="input-field col s12"> 
							<h5>{{trans('Notes.Notes')}}</h5>
							<textarea id="textarea1" class="materialize-textarea validate" name='notes'>{{$getResult->notes}}</textarea>
						</div>
						<p>
						<div class="input-field col s12">
							<button class="btn waves-effect waves-light" type="submit">	 {{trans('Notes.Submit')}}
								<i class="material-icons right">send</i>
							</button>
						</div>
					{!! Form::close() !!}
			</div>
		</div>
	</div>
</section>
@stop