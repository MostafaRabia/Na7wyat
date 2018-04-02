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
					@php $i++; $b++; @endphp
					<h5>{{trans('showExam.Que')}}{{$getPermission->complete+1}}: {{$Ques->ques}} @if($getId->showDegree==1) <span class="degree">(@if($Ques->degree==1){{trans('showExam.Degree')}}@elseif($Ques->degree==2){{trans('showExam.degreeTwo')}}@elseif($Ques->degree==0){{$Ques->degree}} {{trans('showExam.Degree')}}@elseif($Ques->degree<=10){{$Ques->degree}} {{trans('showExam.degreeThree')}}@elseif($Ques->degree>10){{$Ques->degree}} {{trans('showExam.Degree')}}@endif)</span> @endif</h5>
					<h5>{{trans('showExam.Ans')}}</h5>
					@if ($Ques->ans1!=null&&$Ques->ans2!=null)
						@for($i=1;$i<=4;$i++)
							@php
								$Ans = 'ans'.$i;
								if ($Ques->$Ans==null){}else{
									$Var[] = $Ques->$Ans;
								}
							@endphp
						@endfor
						@php shuffle($Var); @endphp
						<div class="input-field">
						<select name="ans.{{$Ques->id_que}}">
					      <option value="" selected disabled>اختر الاجابة</option>
					      <option value=""></option>
					      <option value="{{$Var[0]}}">{{$Var[0]}}</option>
					      <option value="{{$Var[1]}}">{{$Var[1]}}</option>
					      @if($Ques->ans3!=null)
					      	<option value="{{$Var[2]}}">{{$Var[2]}}</option>
					      @endif
					      @if($Ques->ans4!=null)
					      	<option value="{{$Var[3]}}">{{$Var[3]}}</option>
					      @endif
					    </select>
					    </div>
					@elseif ($Ques->correct==null)
						<textarea id="textarea1" name='ans.{{$Ques->id_que}}' class="materialize-textarea"></textarea>
					@endif
					<hr>
					@php $Var = [];@endphp
				@endforeach
				@if ($getId->isPage==1&&$getPermission->complete<$countQues&&$getPermission->complete!=0&&$getPermission->complete!=$countQues-1)
					<button class="btn waves-effect waves-light submit" type="submit">
						{{trans('showExam.Next')}}
						<i class="material-icons right">send</i>
					</button>
					<button class="btn waves-effect waves-light submitBack left" type="submit">
						{{trans('showExam.Back')}}
						<i class="material-icons left">arrow_back</i>
					</button>
				@elseif ($getId->isPage==1&&$getPermission->complete<$countQues&&$getPermission->complete==0)
					<button class="btn waves-effect waves-light submit" type="submit">
						{{trans('showExam.Next')}}
						<i class="material-icons right">send</i>
					</button>
				@elseif ($getId->isPage==1&&$getPermission->complete==$countQues-1)
					<button class="btn waves-effect waves-light submit" type="submit">
						{{trans('showExam.Finish')}}
						<i class="material-icons right">send</i>
					</button>
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