@extends(app('users').'.Index')
@section('center')
{!! Html::style(app('css').'/myExamsStyle.css') !!}
<!-- Start Section Page -->
<section class="pageSection">
	<div class="container">
		<div class="row">
			<div class="asideLeft col s12 left">
				<h4>{{trans('Exam.Exams')}}</h4>
				<table class="responsive-table">
					<thead>
						<tr>
							<th>{{trans('Exam.Name')}}</th>
							<th>{{trans('myExams.From')}}</th>
							<th>{{trans('myExams.To')}}</th>
							<th>{{trans('Exam.countQue')}}</th>
							<th>{{trans('Exam.Setting')}}</th>
						</tr>
					</thead>
					<tbody>
						@foreach($getExams as $Exam)
							@php $countQues = App\Ques::where('id_exam',$Exam->id)->count(); @endphp
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
								<td>
									<a class="btn-floating waves-effect waves-light teal lighten-1" href="{{url('setting/exam')}}/{{$Exam->id}}">
										<i class="material-icons">send</i>
									</a>
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