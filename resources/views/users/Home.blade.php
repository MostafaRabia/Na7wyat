@extends(app('users').'.Index')
@section('center')
	{!! Html::style(app('css').'/homeStyle.css') !!}
	<script type="text/javascript">
		$(document).ready(function(){
			@if(session()->has('Error'))
				$('.modal').modal('open');
			@endif
		});
	</script>
	<!-- Start Modal -->
	<div id="modal1" class="modal">
		<div class="modal-content">
			<h4>{{trans('Modal.h4Modal')}}</h4>
			<p>{{session()->get('pModal')}}</p>
		</div>
	</div>
	<!-- End Modal -->

	<!-- Start Section Info -->
	<section class="infoSection">
		<div class="container">
			<div class="row">
				<div class="infoDiv col s12 left">
					<h4>{{trans('Home.Info')}} {{trans('Titles.nameOfWebSite')}}</h4>
					<p class="flow-text">{!!trans('Home.Login')!!}</p>
					<p class="flow-text">{{trans('Home.examNow')}} @if($getExams) <a href='{{url("exam/".$getExams->name)}}'>{{$getExams->name}}</a> @else {{trans('Home.noExam')}} @endif</p>
					<p class="flow-text">{!!trans('Home.Rules')!!}</ul></p>
					<img src="{{app('image')}}/home.png" />
				</div>
			</div>
		</div>
	</section>
	<!-- End Section Info -->
@stop