@extends(app('users').'.Index')
@section('center')
{!! Html::style(app('css').'/createStyle.css') !!}
{!! Html::script(app('js').'/createJs.min.js') !!}
<script type="text/javascript">
	$(document).ready(function(){
		@if(session()->has('errorCreateExam'))
			Materialize.toast('كل الحقول مطلوبة.', 4000);
		@endif
		@if(session()->has('errorCreateQue'))
			Materialize.toast('اسم السؤال مطلوب.', 4000);
		@endif
		@if(session()->has('addQue'))
			Materialize.toast('تم أضافة السؤال بنجاح', 4000);
		@endif
	});
</script>
<!-- Start Section Page -->
<section class="pageSection">
	<div class="container">
		<div class="row">
			<div class="asideLeft col s12 left">
				@if($id==null)
					<h4>{{trans('createExam.h4CreateExam')}}</h4>
						{!! Form::open(['url'=>'create/exam','method'=>'post']) !!}
							<div class="input-field col s12"> 
								<h5>{{trans('createExam.Name')}}</h5>
								{!! Form::text('name','',['class'=>'validate']) !!}
							</div>
							<div class="input-field col s12"> 
								<h5>{{trans('createExam.dateFrom')}}</h5>
								<input type="text" class="datepicker" name='dateFrom'>
							</div>
							<div class="input-field col s12"> 
								<h5>{{trans('createExam.dateTo')}}</h5>
								<input type="text" class="datepicker" name="dateTo">
							</div>
							<div class="input-field col s12"> 
								<h5>{{trans('createExam.timeFrom')}}</h5>
								<input type="text" class="timepicker" name="timeFrom">
							</div>
							<div class="input-field col s12"> 
								<h5>{{trans('createExam.timeTo')}}</h5>
								<input type="text" class="timepicker" name="timeTo">
							</div>
							<div class="input-field col s12">
								<select name="isTime" id="isTime">
							      <option value="" disabled selected>{{trans('createExam.isTime')}}</option>
							      <option value="yes">{{trans('createExam.Yes')}}</option>
							      <option value="no">{{trans('createExam.No')}}</option>
							    </select>
							</div>
							<div class="input-field col s12 time">
								<h5>{{trans('createExam.Time')}}</h5>
								{!! Form::number('time','',['class'=>'validate']) !!}
							</div>
							<div class="input-field col s12">
								<select name="page" id="page">
							      <option value="" disabled selected>{{trans('createExam.Page')}}</option>
							      <option value="yes">{{trans('createExam.Yes')}}</option>
							      <option value="no">{{trans('createExam.No')}}</option>
							    </select>
							</div>
							<div class="input-field col s12 quesToShowSelect" style="display: none;">
								<select name="quesToShowSelect" id="quesToShowSelect">
							      <option value="" disabled selected>{{trans('createExam.quesToShowSelect')}}</option>
							      <option value="yes">{{trans('createExam.Yes')}}</option>
							      <option value="no">{{trans('createExam.No')}}</option>
							    </select>
							</div>
							<div class="input-field col s12 quesToShow">
								<h5>{{trans('createExam.quesToShow')}}</h5>
								{!! Form::number('quesToShow','',['class'=>'validate']) !!}
							</div>
							<div class="input-field col s12 back" style="display: none;">
								<select name="back" id="back">
							      <option value="" disabled selected>{{trans('createExam.Back')}}</option>
							      <option value="yes">{{trans('createExam.Yes')}}</option>
							      <option value="no">{{trans('createExam.No')}}</option>
							    </select>
							</div>
							<div class="input-field col s12 rand">
								<select name="rand">
							      <option value="" disabled selected>{{trans('createExam.Rand')}}</option>
							      <option value="yes">{{trans('createExam.Yes')}}</option>
							      <option value="no">{{trans('createExam.No')}}</option>
							    </select>
							</div>
							<div class="input-field col s12">
								<select name="show">
							      <option value="" disabled selected>{{trans('createExam.Show')}}</option>
							      <option value="yes">{{trans('createExam.Yes')}}</option>
							      <option value="no">{{trans('createExam.No')}}</option>
							    </select>
							</div>
							<div class="input-field col s12">
								<button class="btn waves-effect waves-light" type="submit">	 {{trans('createExam.Submit')}}
									<i class="material-icons right">send</i>
								</button>
							</div>
						{!! Form::close() !!}
					@elseif($id!=null)
						<h4>{{trans('createExam.h4CreateQue')}}</h4>
						{!! Form::open(['url'=>'create/exam/'.$id,'method'=>'post','class'=>'formAddQue']) !!}
							<div class="input-field col s12">
								<h5>{{trans('createExam.Ques')}}</h5>
								{!! Form::text('ques','',['class'=>'validate']) !!}
							</div>
							@for($i=1;$i<=8;$i++)
								<div class="input-field col s12 ans">
									<h5>{{trans('createExam.Ans')}} {{$i}}</h5>
									{!! Form::text('ans'.$i,'',['class'=>'validate']) !!}
								</div>
							@endfor
							<div class="input-field col s12">
								<h5>{{trans('createExam.Correct')}}</h5>
								<select name="correct">
									<option value="" disabled selected>{{trans('createExam.Correct')}}</option>
									@for($i=1;$i<=8;$i++)
										<option value="ans{{$i}}.{{$i}}">{{trans('createExam.'.$i)}}</option>
									@endfor
								</select>
							</div>
							<div class="input-field col s12">
								<h5>{{trans('createExam.Degree')}}</h5>
								{!! Form::number('degree',0,['class'=>'validate','step'=>'any']) !!}
							</div>
							<div class="input-field col s12">
								<button class="btn waves-effect waves-light submit">	 {{trans('createExam.Submit')}}
									<i class="material-icons right">send</i>
								</button>
							</div>
						{!! Form::close() !!}
				@endif
			</div>
		</div>
	</div>
</section>
@stop
