@extends(app('users').'.Index')
@section('center')
{!! Html::style(app('css').'/createStyle.css') !!}
{!! Html::script(app('js').'/createJs.min.js') !!}
<script type="text/javascript">
	$(document).ready(function(){
		@if(count($errors)>0||session()->has('pModal'))
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
<!-- Start Section Page -->
<section class="pageSection">
	<div class="container">
		<div class="row">
			<div class="asideLeft col s12 left">
				<h4>{{trans('editQue.H4')}}</h4>
				{!! Form::open(['url'=>'edit/exam/question/'.$getQue->id,'method'=>'post']) !!}
					<div class="input-field col s12"> 
						<h5>{{trans('createExam.Name')}}</h5>
						{!! Form::text('name',$getQue->Exam->name,['class'=>'validate valid']) !!}
					</div>
					<div class="input-field col s12"> 
						<h5>{{trans('createExam.dateFrom')}}</h5>
						<input type="text" class="datepicker" name='dateFrom' value="{{$getQue->Exam->dateFrom}}">
					</div>
					<div class="input-field col s12"> 
						<h5>{{trans('createExam.dateTo')}}</h5>
						<input type="text" class="datepicker" name="dateTo" value="{{$getQue->Exam->dateTo}}">
					</div>
					<div class="input-field col s12"> 
						<h5>{{trans('createExam.timeFrom')}}</h5>
						<input type="text" class="timepicker" name="timeFrom" value="{{$getQue->Exam->timeFrom}}">
					</div>
					<div class="input-field col s12"> 
						<h5>{{trans('createExam.timeTo')}}</h5>
						<input type="text" class="timepicker" name="timeTo" value="{{$getQue->Exam->timeTo}}">
					</div>
					<div class="input-field col s12">
						<select name="isTime" id="isTime">
					      <option value="" disabled>{{trans('createExam.isTime')}}</option>
					      <option value="yes" @if($getQue->Exam->isTime==1) selected @endif>{{trans('createExam.Yes')}}</option>
					      <option value="no" @if($getQue->Exam->isTime==0) selected @endif>{{trans('createExam.No')}}</option>
					    </select>
					</div>
					<div class="input-field col s12 time">
						<h5>{{trans('createExam.Time')}}</h5>
						{!! Form::number('time',$getQue->Exam->time,['class'=>'validate']) !!}
					</div>
					<div class="input-field col s12">
						<select name="page" id="page">
					      <option value="" disabled>{{trans('createExam.Page')}}</option>
					      <option value="yes" @if($getQue->Exam->isPage==1) selected @endif>{{trans('createExam.Yes')}}</option>
					      <option value="no" @if($getQue->Exam->isPage==0) selected @endif>{{trans('createExam.No')}}</option>
					    </select>
					</div>
					<div class="input-field col s12 quesToShowSelect">
						<select name="quesToShowSelect" id="quesToShowSelect">
					      <option value="" disabled>{{trans('createExam.quesToShowSelect')}}</option>
					      <option value="yes" @if($getQue->Exam->quesToShow>1) selected @endif>{{trans('createExam.Yes')}}</option>
					      <option value="no" @if(!isset($getQue->Exam->quesToShow)||$getQue->Exam->quesToShow==1) selected @endif>{{trans('createExam.No')}}</option>
					    </select>
					</div>
					<div class="input-field col s12 quesToShow">
						<h5>{{trans('createExam.quesToShow')}}</h5>
						{!! Form::number('quesToShow',$getQue->Exam->quesToShow,['class'=>'validate']) !!}
					</div>
					<div class="input-field col s12 back">
						<select name="back" id="back">
					      <option value="" disabled>{{trans('createExam.Back')}}</option>
					      <option value="yes" @if($getQue->Exam->isBack==1) selected @endif>{{trans('createExam.Yes')}}</option>
					      <option value="no" @if($getQue->Exam->isBack==0) selected @endif>{{trans('createExam.No')}}</option>
					    </select>
					</div>
					<div class="input-field col s12 rand">
						<select name="rand">
					      <option value="" disabled>{{trans('createExam.Rand')}}</option>
					      <option value="yes" @if($getQue->Exam->rand==1) selected @endif>{{trans('createExam.Yes')}}</option>
					      <option value="no" @if($getQue->Exam->rand==0) selected @endif>{{trans('createExam.No')}}</option>
					    </select>
					</div>
					<div class="input-field col s12">
						<select name="show">
					      <option value="" disabled>{{trans('createExam.Show')}}</option>
					      <option value="yes" @if($getQue->Exam->showDegree==1) selected @endif>{{trans('createExam.Yes')}}</option>
					      <option value="no" @if($getQue->Exam->showDegree==0) selected @endif>{{trans('createExam.No')}}</option>
					    </select>
					</div>
					<div class="input-field col s12">
						<h5>{{trans('createExam.Ques')}}</h5>
						{!! Form::text('ques',$getQue->ques,['class'=>'validate valid']) !!}
					</div>
					@for($i=1;$i<=8;$i++)
						@php $Ans = 'ans'.$i; @endphp
						<div class="input-field col s12 ans">
							<h5>{{trans('createExam.Ans')}} {{$i}}</h5>
							{!! Form::text('ans'.$i,$getQue->$Ans,['class'=>'validate valid']) !!}
						</div>
					@endfor
					<div class="input-field col s12">
						<h5>{{trans('createExam.Correct')}}</h5>
						<select name="correct">
							<option value="" disabled selected>{{trans('createExam.Correct')}}</option>
							@for($i=1;$i<=8;$i++)
								@php
									$Ans = 'ans'.$i;
									$Num = null;
									$correct = $getQue->correct;
									if (isset($correct)&&isset($getQue->$Ans)&&$correct==$getQue->$Ans){
										$Num = $i;
									}
								@endphp
								<option value="ans{{$i}}.{{$i}}" @if($Num==$i) selected @endif>{{trans('createExam.'.$i)}}</option>
							@endfor
						</select>
					</div>
					<div class="input-field col s12">
						<h5>{{trans('createExam.Degree')}}</h5>
						{!! Form::number('degree',$getQue->degree,['class'=>'validate valid','step'=>'any']) !!}
					</div>
					<div class="input-field col s12">
						<button class="btn waves-effect waves-light" type="submit">	 {{trans('editQue.Submit')}}
							<i class="material-icons right">send</i>
						</button>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</section>
@stop
