@extends(app('users').'.Index')
@section('center')
{!! Html::style(app('css').'/showExamStyle.css') !!}
<script type="text/javascript">
	$(document).ready(function() {
    	$('select').material_select();
  	});
</script>
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
						@for($c=1;$c<=8;$c++)
							@php
								$Ans = 'ans'.$c;
								if ($Ques->$Ans==null){}else{
									$Var[] = $Ques->$Ans;
								}
							@endphp
						@endfor
						@php $Var = collect($Var); $Var = $Var->shuffle(); @endphp
						<div class="input-field">
						<select name="ans.{{$Ques->id_que}}">
					      <option value="" selected disabled>اختر الاجابة</option>
					      <option value=""></option>
					      <option value="{{$Var[0]}}">{{$Var[0]}}</option>
					      <option value="{{$Var[1]}}">{{$Var[1]}}</option>
					      @for($n=3;$n<=8;$n++)
					      	  @php $Ans = 'ans'.$n; @endphp
						      @if($Ques->$Ans!=null)
						      	<option value="{{$Var[$n-1]}}">{{$Var[$n-1]}}</option>
						      @endif
					      @endfor
					    </select>
					    </div>
					@elseif ($Ques->correct==null)
						<textarea id="textarea1" name='ans.{{$Ques->id_que}}' class="materialize-textarea"></textarea>
					@endif
					<hr>
					@php $Var = [];@endphp
				@endforeach
			</div>
		</div>
	</div>
</section>
@stop