@extends(app('users').'.Index')
@section('center')
{!! Html::style(app('css').'/Results.css') !!}
{!! Html::script(app('js').'/materialize-pagination.min.js') !!}
<!-- Start Section Page -->
<section class="pageSection">
	<div class="container">
		<div class="row">
			<div class="asideLeft col s12 left">
				@if ($notFinish==1)
					<h1 style="text-align: center;">{{trans('Results.notFinish')}}</h1>
				@else
				<h4>{{trans('Results.Results')}}</h4>
				<h5>{{trans('Results.getCorrectAns')}}: {{$getCorrectAns}}</h5>
				<h5>{{trans('Results.getCorrectAnsWithCorrect')}}: {{$getCorrectAnsWithCorrect}}</h5>
				<h5>{{trans('Results.getFailAns')}}: {{$getFailAns}}</h5>
				<h5>{{trans('Results.getFailAnsWithCorrect')}}: {{$getFailAnsWithCorrect}}</h5>
				<h5>{{trans('Results.getPendings')}}: {{$getPendings}}</h5>
				<h5>{{trans('Results.Final')}}: {{$getDegreesResults}}/{{$getDegreesQues}}</h5>
				<hr>
				@foreach($getResults as $Results)
					@php
						$getQue = App\Ques::where('id_que',$Results->question)->where('id_exam',$Results->id_exam)->first();
					@endphp
					<h5>{{trans('Results.Que')}} {{$getQue->ques}}</h5>
					<h5>{{trans('Results.Ans')}} {{$Results->answer}}</h5>
					<h5>
						{{trans('Results.Correct')}}
						@if($Results->Ques->correct==null)
							{{trans('Results.nullCorrect')}}
						@else
							{{$getQue->correct}}
						@endif
					</h5>
					<h5>
						{{trans('Results.resultQue')}}
						@if($Results->result==3&&$Results->degree>=(1/2)*$Results->Ques->degree)
							<span class="green-text">{{trans('Results.successNullCorrect')}}</span>
						@elseif($Results->result==4&&$Results->degree<=(1/2)*$Results->Ques->degree)
							<span class="red-text">{{trans('Results.successNullCorrect')}}</span>
						@elseif($Results->result==1&&$Results->Ques->correct!=null)
							<span class="green-text">{{trans('Results.Success')}}</span>
						@elseif($Results->result==2)
							{{trans('Results.Pending')}}
						@elseif($Results->result==0)
							<span class="red-text">{{trans('Results.Fail')}}</span>
						@endif
					 </h5>
					<h5>{{trans('adminResults.Degree')}}: @if($Results->degree==0&&$Results->result==2) ---- @else {{$Results->degree}} @endif / {{$getQue->degree}}</h5>
					 <h5>{{trans('Results.Notes')}} {{$Results->notes}}</h5>
					 <hr>
				@endforeach
				{{$getResults->links()}}
				@endif
			</div>
		</div>
	</div>
</section>
@stop
