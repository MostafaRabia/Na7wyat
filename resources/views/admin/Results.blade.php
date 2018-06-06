@extends(app('users').'.Index')
@section('center')
{!! Html::style(app('css').'/Results.css') !!}
{!! Html::script(app('js').'/materialize-pagination.min.js') !!}
{!! Html::script(app('js').'/ResultsJs.min.js') !!}
<!-- Start Section Page -->
<section class="pageSection">
	<div class="container">
		<div class="row">
			<div class="asideLeft col s12 left">
				<h4>{{trans('adminResults.Results')}}</h4>
				<h5>{{trans('Results.getCorrectAns')}}: {{$getCorrectAns}}</h5>
				<h5>{{trans('Results.getCorrectAnsWithCorrect')}}: {{$getCorrectAnsWithCorrect}}</h5>
				<h5>{{trans('Results.getFailAns')}}: {{$getFailAns}}</h5>
				<h5>{{trans('Results.getFailAnsWithCorrect')}}: {{$getFailAnsWithCorrect}}</h5>
				<h5>{{trans('Results.getPendings')}}: {{$getPendings}}</h5>
				<h5>{{trans('Results.Final')}}: {{$getDegreesResults}}/{{$getDegreesQues}}</h5>
				<hr>
				@foreach($getResults as $Results)
					<h5>{{trans('adminResults.nameOfMember')}}: {{$Results->User->username}}</h5>
					<h5>{{trans('adminResults.profileOfMember')}}: <a href='{{$Results->User->profile}}' target="_blank">{{$Results->User->username}}</a></h5>
					@php
						$getQue = App\Ques::where('id_que',$Results->question)->where('id_exam',$Results->id_exam)->first();
					@endphp
					<h5>{{trans('adminResults.Que')}}: {{$getQue->ques}}</h5>
					<h5>{{trans('adminResults.Ans')}}: {{$Results->answer}}</h5>
					<h5>
						{{trans('adminResults.Correct')}}: 
						@if($Results->Ques->correct!=null)
							{{$getQue->correct}}
						@else
							{{trans('Results.nullCorrect')}}
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
					<h5>{{trans('adminResults.Degree')}}: @if($Results->degree==0&&$Results->result==2) <span id="degree{{$Results->id}}">----</span> @else <span id="degree{{$Results->id}}">{{$Results->degree}}</span> @endif / {{$Results->Ques->degree}}</h5>
					<h5>{{trans('adminResults.Notes')}}: {{$Results->notes}}</h5>
					<h5>
						{{trans('adminResults.addResult')}}: 
						<a class="btn-floating waves-effect waves-light red lighten-2" href="{{url('notes/')}}/{{$Results->id}}">
							<i class="material-icons">send</i>
						</a>
					</h5>
					<h5>
						{{trans('adminResults.addDegree')}}: 
						{!! Form::number('degree','',['class'=>'validate addDegreeText','style'=>'width:25%;','id'=>$Results->id,'max'=>$Results->Ques->degree,'userId'=>$Results->User->id_user,'idExam'=>$Results->id_exam,'step'=>'any']) !!}
						<button class="btn-floating waves-effect addDegree waves-light teal lighten-1" id="{{$Results->id}}">
							<i class="material-icons">send</i>
						</button>
					</h5>
					<hr>
				@endforeach
				{{$getResults->links()}}
			</div>
		</div>
	</div>
</section>
@stop
