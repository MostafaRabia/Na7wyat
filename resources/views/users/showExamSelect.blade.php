@extends(app('users').'.Index')
@section('center')
{!! Html::style(app('css').'/showExamStyle.css') !!}
{!! Html::script(app('js').'/js.cookie.min.js') !!}
{!! Html::script(app('js').'/showExamJsUsers.min.js') !!}
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
				{!! Form::open(['url'=>'exam/'.$getId->name,'method'=>'post']) !!}
				@php $i=0; $b=0; @endphp
				@foreach($getQues as $Ques)
					@php $b++; $maxID = $Ques->id_que; @endphp
					<h5>{{trans('showExam.Que')}}{{$getPermission->complete+$b}}: {{$Ques->ques}} @if($getId->showDegree==1) <span class="degree">(@if($Ques->degree==1){{trans('showExam.Degree')}}@elseif($Ques->degree==2){{trans('showExam.degreeTwo')}}@elseif($Ques->degree==0){{$Ques->degree}} {{trans('showExam.Degree')}}@elseif($Ques->degree<=10){{$Ques->degree}} {{trans('showExam.degreeThree')}}@elseif($Ques->degree>10){{$Ques->degree}} {{trans('showExam.Degree')}}@endif)</span> @endif</h5>
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
					      <option value="" @if(count($getResults)==0) selected @endif>اختر الاجابة</option>
					      <option value=""></option>
					      <option value="{{$Var[0]}}" @if(count($getResults)!=0&&$getResults[$i]->answer==$Var[0]) selected @endif>{{$Var[0]}}</option>
					      <option value="{{$Var[1]}}" @if(count($getResults)!=0&&$getResults[$i]->answer==$Var[1]) selected @endif>{{$Var[1]}}</option>
					      @for($n=3;$n<=8;$n++)
						      @php $Ans = 'ans'.$n; @endphp
						      @if($Ques->$Ans!=null)
						      	<option value="{{$Var[$n-1]}}" @if(count($getResults)!=0&&$getResults[$i]->answer==$Var[$n-1]) selected @endif>{{$Var[$n-1]}}</option>
						      @endif
					      @endfor
					    </select>
					    </div>
					@elseif ($Ques->correct==null)
						<textarea id="textarea1" name='ans.{{$Ques->id_que}}' class="materialize-textarea">@if(count($getResults)!=0) {{$getResults[$i]->answer}} @endif</textarea>
					@endif
					<hr>
					@php $Var = []; $i++; @endphp
				@endforeach
				@if ($getId->isPage==1)
					@php $Precent = ($maxID / $countQues) * 100; @endphp
					<div class="progress" style="width: 50%;margin: 0 auto;">
						<div class="determinate" style="width: {{$Precent}}%"></div>
				    </div>
					@if ($Precent<100)
						<button class="btn waves-effect waves-light submit" type="submit">
							{{trans('showExam.Next')}}
							<i class="material-icons right">send</i>
						</button>
					@else
						<button class="btn waves-effect waves-light submit" type="submit">
							{{trans('showExam.Finish')}}
							<i class="material-icons right">send</i>
						</button>
					@endif
					@if ($getId->isBack==1&&$getPermission->complete!=0)
						<button class="btn waves-effect waves-light submitBack left" type="submit">
						{{trans('showExam.Back')}}
							<i class="material-icons left">arrow_back</i>
						</button>
					@endif
				@elseif ($getId->isPage==0)
					<button class="btn waves-effect waves-light submit" type="submit">
						{{trans('showExam.Finish')}}
						<i class="material-icons right">send</i>
					</button>
				@endif
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</section>
@stop