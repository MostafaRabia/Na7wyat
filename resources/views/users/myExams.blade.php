@extends(app('users').'.Index')
@section('center')
{!! Html::style(app('css').'/myExamsStyle.css') !!}
{!! Html::style(app('css').'/datatables.min.css') !!}
{!! Html::style(app('css').'/rowReorder.dataTables.min.css') !!}
{!! Html::style(app('css').'/responsive.dataTables.min.css') !!}
{!! Html::script(app('js').'/jquery.dataTables.min.js') !!}
{!! Html::script(app('js').'/dataTables.rowReorder.min.js') !!}
{!! Html::script(app('js').'/dataTables.responsive.min.js') !!}
{!! Html::script(app('js').'/myExamsJs.min.js') !!}
<!-- Start Modal -->
<div id="modal1" class="modal modal-fixed-footer">
	<div class="modal-content">
		<h4>{{trans('Modal.h4ModalEnter')}}</h4>
		<p>{!!trans('Modal.pModalEnter')!!}</p>
	</div>
	<div class="modal-footer">
    	<a href="javascript:;" class="modal-action enter-modal waves-effect waves-green btn-flat">{{trans('Modal.Agree')}}</a>
    	<a href="javascript:;" class="modal-action modal-close waves-effect waves-red btn-flat">{{trans('Modal.Disagree')}}</a>
    </div>
</div>
<!-- End Modal -->
<!-- Start Section Page -->
<section class="pageSection">
	<div class="container">
		<div class="row">
			<div class="asideLeft col s12 left">
				<h4>{{trans('myExams.myExams')}}</h4>
				<table id="example" style="width:100%">
					<thead>
						<tr>
							<th>{{trans('myExams.Name')}}</th>
							<th>{{trans('myExams.From')}}</th>
							<th>{{trans('myExams.To')}}</th>
							<th>{{trans('myExams.countQue')}}</th>
							<th>{{trans('myExams.Result')}}</th>
							<th>{{trans('myExams.enterExam')}}</th>
							<th>{{trans('myExams.enterAnswer')}}</th>
						</tr>
					</thead>
					<tbody>
						@foreach($getExams as $Exam)
							@php
								$countAns = App\Results::where('id_user',auth()->user()->id)->where('id_exam',$Exam->id)->sum('degree');
								$getPermission = App\Permission::where('id_exam',$Exam->id)->where('id_user',auth()->user()->id_user)->first();
								$countDegrees = App\Ques::where('id_exam',$Exam->id)->sum('degree');
								$countQues = App\Ques::where('id_exam',$Exam->id)->count();
								$getAns = App\Results::where('id_exam',$Exam->id)->where('id_user',auth()->user()->id)->count();
							@endphp
							<tr>
								<td>{{$Exam->name}}</td>
								<td class="en">
									@if($Exam->dateFrom!=null)
										{{$Exam->dateFrom}} {{$Exam->timeFrom}}
									@else
										{{trans('myExams.notDate')}}
									@endif
								</td>
								<td class="en">
									@if($Exam->dateTo!=null)
										{{$Exam->dateTo}} {{$Exam->timeTo}}
									@else
										{{trans('myExams.notDate')}}
									@endif
								</td>
								<td>{{$countQues}}</td>
								<td style="direction:ltr;">
								@if ($getPermission)
									@if ($Exam->isBack==1&&$getPermission->finish==0&&$getAns>0) {{trans('Results.notFinish')}} @else {{$countAns}}/{{$countDegrees}} @endif
								@else
									 {{$countAns}}/{{$countDegrees}}
								@endif
								</td>
								<td>
									@if ($getPermission)
										@if ($Exam->avil==1&&$getPermission->finish==0)
											<a class="btn-floating waves-effect waves-light teal lighten-1" onclick="$('#modal1').modal();$('#modal1').modal('open');$('.enter-modal').attr('href',$(this).attr('href'));return false;" href="{{url('exam')}}/{{$Exam->name}}">
												<i class="material-icons">send</i>
											</a>
										@endif
										@if ($getAns>0&&$getPermission->finish==0)
										 	<a class="btn-floating waves-effect waves-light teal lighten-1" onclick="$('#modal1').modal();$('#modal1').modal('open');$('.enter-modal').attr('href',$(this).attr('href'));return false;" href="{{url('exam')}}/{{$Exam->name}}">
												<i class="material-icons">send</i>
											</a>
										@endif
									@else
										@if ($Exam->avil==1)
											<a class="btn-floating waves-effect waves-light teal lighten-1" onclick="$('#modal1').modal();$('#modal1').modal('open');$('.enter-modal').attr('href',$(this).attr('href'));return false;" href="{{url('exam')}}/{{$Exam->name}}">
												<i class="material-icons">send</i>
											</a>
										@endif
									@endif
								</td>
								<td>
									@if ($getPermission)
										@if ($getPermission->finish==1)
											<a class="btn-floating waves-effect waves-light teal lighten-1" href="{{url('results')}}/{{$Exam->name}}">
												<i class="material-icons">send</i>
											</a>
										@endif
									@endif
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>
@stop