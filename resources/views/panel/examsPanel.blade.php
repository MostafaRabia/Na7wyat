@extends(app('users').'.Index')
@section('center')
{!! Html::style(app('css').'/examPanel.css') !!}
{!! Html::style(app('css').'/datatables.min.css') !!}
{!! Html::script(app('js').'/datatables.min.js') !!}
{!! Html::script(app('js').'/homePanel.min.js') !!}
<!-- Start Section Info -->
<section class="pageSection">
	<div class="container">
		<div class="row">
			<div class="asideLeft col s12 left">
				<table id="example" class="display" style="width:100%">
			        <thead>
			            <tr style="color:white;">
			                <th>{{trans('examsPanel.Name')}}</th>
			                <th>{{trans('examsPanel.Time')}}</th>
			                <th>{{trans('examsPanel.dateFrom')}}</th>
			                <th>{{trans('examsPanel.dateTo')}}</th>
			                <th>{{trans('examsPanel.timeFrom')}}</th>
			                <th>{{trans('examsPanel.timeTo')}}</th>
			                <th>{{trans('examsPanel.Rand')}}</th>
			                <th>{{trans('examsPanel.showDegree')}}</th>
			                <th>{{trans('examsPanel.Avil')}}</th>
			                <th>{{trans('examsPanel.countQues')}}</th>
			                <th>{{trans('examsPanel.countDegrees')}}</th>
			                <th>{{trans('examsPanel.countUsers')}}</th>
			                <th>{{trans('examsPanel.showUsers')}}</th>
			                <th>{{trans('examsPanel.updateExam')}}</th>
			                <th>{{trans('examsPanel.updateQues')}}</th>
			            </tr>
			        </thead>
			        <tbody>
			        	@foreach($getExams as $Exam)
			        		@php
			        			$countQues = App\Ques::where('id_exam',$Exam->id)->count();
			        			$countDegrees = App\Ques::where('id_exam',$Exam->id)->sum('degree');
			        			$countUsers = App\Permission::where('id_exam',$Exam->id)->where('finish',1)->count();
			        		@endphp
				            <tr>
				                <td>{{$Exam->name}}</td>
				                <td>{{$Exam->time}}</td>
				                <td>{{$Exam->dateFrom}}</td>
				                <td>{{$Exam->dateTo}}</td>
				                <td>{{$Exam->timeFrom}}</td>
				                <td>{{$Exam->timeTo}}</td>
				                <td>{{$Exam->rand}}</td>
				                <td>{{$Exam->showDegree}}</td>
				                <td>{{$Exam->avil}}</td>
				                <td>{{$countQues}}</td>
				                <td>{{$countDegrees}}</td>
				                <td>{{$countUsers}}</td>
				                <td>
				                	<a class="btn-floating waves-effect waves-light teal" href="{{url('admin/panel/exam/')}}/{{$Exam->id}}">
										<i class="material-icons">send</i>
									</a>
				                </td>
				                <td>
				                	<a class="btn-floating waves-effect waves-light deep-purple" href="{{url('admin/panel/exam/update')}}/{{$Exam->id}}">
										<i class="material-icons">send</i>
									</a>
				                </td>
				                <td>
				                	<a class="btn-floating waves-effect waves-light green" href="{{url('admin/panel/exam/update/ques')}}/{{$Exam->id}}">
										<i class="material-icons">send</i>
									</a>
				                </td>
				            </tr>
			            @endforeach
			        </tbody>
			        <tfoot>
			            <tr style="color:white;">
			                <th>{{trans('examsPanel.Name')}}</th>
			                <th>{{trans('examsPanel.Time')}}</th>
			                <th>{{trans('examsPanel.dateFrom')}}</th>
			                <th>{{trans('examsPanel.dateTo')}}</th>
			                <th>{{trans('examsPanel.timeFrom')}}</th>
			                <th>{{trans('examsPanel.timeTo')}}</th>
			                <th>{{trans('examsPanel.Rand')}}</th>
			                <th>{{trans('examsPanel.showDegree')}}</th>
			                <th>{{trans('examsPanel.Avil')}}</th>
			            	<th>{{trans('examsPanel.countQues')}}</th>
			                <th>{{trans('examsPanel.countDegrees')}}</th>
			                <th>{{trans('examsPanel.countUsers')}}</th>
			                <th>{{trans('examsPanel.showUsers')}}</th>
			                <th>{{trans('examsPanel.updateExam')}}</th>
			                <th>{{trans('examsPanel.updateQues')}}</th>
			            </tr>
			        </tfoot>
			    </table>
			</div>
		</div>
	</div>
</section>
<!-- End Section Info -->
@stop