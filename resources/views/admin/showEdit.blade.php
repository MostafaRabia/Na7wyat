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
<!-- Start Section Page -->
<section class="pageSection">
	<div class="container">
		<div class="row">
			<div class="asideLeft col s12 left">
				<h4>{{trans('Exam.Exams')}}</h4>
				<table id="example" style="width:100%">
					<thead>
						<tr>
							<th>{{trans('Exam.Name')}}</th>
							<th>{{trans('Exam.From')}}</th>
							<th>{{trans('Exam.To')}}</th>
							<th>{{trans('showEdit.Ques')}}</th>
							<th>{{trans('showEdit.Ans1')}}</th>
							<th>{{trans('showEdit.Ans2')}}</th>
							<th>{{trans('showEdit.Ans3')}}</th>
							<th>{{trans('showEdit.Ans4')}}</th>
							<th>{{trans('showEdit.Ans5')}}</th>
							<th>{{trans('showEdit.Ans6')}}</th>
							<th>{{trans('showEdit.Ans7')}}</th>
							<th>{{trans('showEdit.Ans8')}}</th>
							<th>{{trans('showEdit.Correct')}}</th>
							<th>{{trans('showEdit.Degree')}}</th>
							<th>{{trans('Exam.Edit')}}</th>
							<th>{{trans('Exam.Delete')}}</th>
						</tr>
					</thead>
					<tbody>
						@foreach($getQues as $Ques)
							<tr>
								<td>{{$getExam->name}}</td>
								<td class="en">
									@if($Ques->Exam->dateFrom!=null)
										{{$Ques->Exam->dateFrom}} {{$Ques->Exam->timeFrom}}
									@else
										{{trans('myExams.notDate')}}
									@endif
								</td>
								<td class="en">
									@if($Ques->Exam->dateTo!=null)
										{{$Ques->Exam->dateTo}} {{$Ques->Exam->timeTo}}
									@else
										{{trans('myExams.notDate')}}
									@endif
								</td>
								<td>{{$Ques->ques}}</td>
								<td>@if($Ques->ans1!=null){{$Ques->ans1}}@else{{trans('showEdit.nullCorrect')}}@endif</td>
								<td>@if($Ques->ans2!=null){{$Ques->ans2}}@else{{trans('showEdit.nullCorrect')}}@endif</td>
								<td>@if($Ques->ans3!=null){{$Ques->ans3}}@else{{trans('showEdit.nullCorrect')}}@endif</td>
								<td>@if($Ques->ans4!=null){{$Ques->ans4}}@else{{trans('showEdit.nullCorrect')}}@endif</td>
								<td>@if($Ques->ans1!=null){{$Ques->ans5}}@else{{trans('showEdit.nullCorrect')}}@endif</td>
								<td>@if($Ques->ans2!=null){{$Ques->ans6}}@else{{trans('showEdit.nullCorrect')}}@endif</td>
								<td>@if($Ques->ans3!=null){{$Ques->ans7}}@else{{trans('showEdit.nullCorrect')}}@endif</td>
								<td>@if($Ques->ans4!=null){{$Ques->ans8}}@else{{trans('showEdit.nullCorrect')}}@endif</td>
								<td>@if($Ques->correct!=null){{$Ques->correct}}@else{{trans('showEdit.nullCorrect')}}@endif</td>
								<td>@if($Ques->degree!=null){{$Ques->degree}}@else{{trans('showEdit.nullCorrect')}}@endif</td>
								<td>
									<a class="btn-floating waves-effect waves-light teal lighten-1" href="{{url('edit/exam/question')}}/{{$Ques->id}}">
										<i class="material-icons">send</i>
									</a>
								</td>
								<td>
									<a class="btn-floating waves-effect waves-light red lighten-2" href="{{url('delete/question')}}/{{$Ques->id}}">
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