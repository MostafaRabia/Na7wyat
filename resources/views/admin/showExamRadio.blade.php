@extends(app('users').'.Index')
@section('center')
{!! Html::style(app('css').'/showExamStyle.css') !!}
<!-- Start Section Page -->
<section class="pageSection">
	<div class="container">
		<div class="row">
			<div class="asideLeft col s12 left">
				<h4>{{$name}} @if($getId->isTime==1)<span class="timer"><i class="material-icons">timer</i> <span>{{$getId->time}}:00</span></span>@endif</h4>
				@php $i=0; $b=0; @endphp
				@foreach($getQues as $Ques)
					@php $i++; $b++; @endphp
					<h5>{{trans('showExam.Que')}}{{$b}}: {{$Ques->ques}} @if($getId->showDegree==1) <span class="degree">(@if($Ques->degree==1){{trans('showExam.Degree')}}@elseif($Ques->degree==2){{trans('showExam.degreeTwo')}}@elseif($Ques->degree==0){{$Ques->degree}} {{trans('showExam.Degree')}}@elseif($Ques->degree<=10){{$Ques->degree}} {{trans('showExam.degreeThree')}}@elseif($Ques->degree>10){{$Ques->degree}} {{trans('showExam.Degree')}}@endif)</span> @endif</h5>
					<h5>{{trans('showExam.Ans')}}</h5>
					@if ($Ques->ans1!=null&&$Ques->ans2!=null)
						@for($z=1;$z<=4;$z++)
							@php
								$Ans = 'ans'.$z;
								$Var[] = $Ques->$Ans;
							@endphp
						@endfor
						@php shuffle($Var); @endphp
						<p>
							<input name="ans.{{$Ques->id_que}}" type="radio" id="{{$i}}" value="" checked />
							<label for="{{$i}}">{{trans('showExam.noAns')}}</label>
							@php $i++ @endphp
						</p>
						<p>
							<input name="ans.{{$Ques->id_que}}" type="radio" id="{{$i}}" value="{{$Var[0]}}" />
							<label for="{{$i}}">{{$Var[0]}}</label>
							@php $i++ @endphp
						</p>
						<p>
							<input name="ans.{{$Ques->id_que}}" type="radio" id="{{$i}}" value="{{$Var[1]}}" />
							<label for="{{$i}}">{{$Var[1]}}</label>
							@php $i++ @endphp
						</p>
					@elseif ($Ques->correct==null)
						<textarea id="textarea1" name='ans.{{$Ques->id_que}}' class="materialize-textarea"></textarea>
					@endif
					@if($Ques->ans3!=null)
						<p>
							<input name="ans.{{$Ques->id_que}}" type="radio" id="{{$i}}" value="{{$Var[2]}}" />
							<label for="{{$i}}">{{$Var[2]}}</label>
							@php $i++ @endphp
						</p>
					@endif
					@if($Ques->ans4!=null)
						<p>
							<input name="ans.{{$Ques->id_que}}" type="radio" id="{{$i}}" value="{{$Var[3]}}" />
							<label for="{{$i}}">{{$Var[3]}}</label>
							@php $i++ @endphp
						</p> 
					@endif
					<hr>
					@php $Var = [];@endphp
				@endforeach
			</div>
		</div>
	</div>
</section>
@stop