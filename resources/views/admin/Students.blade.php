@extends(app('users').'.Index')
@section('center')
{!! Html::style(app('css').'/myExamsStyle.css?version=1.1.0') !!}
{!! Html::script(app('js').'/Students.min.js?version=1.0.0') !!}
<!-- Start Section Page -->
<section class="pageSection">
	<div class="container">
		<div class="row">
			<div class="asideLeft col s12 left">
				<h4>{{trans('Students.Header')}}({{count($usersFinish)}})</h4>
				<table id='table'>
					<thead>
						<tr>
							<th onclick="sortTable(0)">{{trans('Students.Username')}}</th>
							<th onclick="sortTable(1)">{{trans('Students.Result')}}</th>
							<th onclick="sortTable(1)">{{trans('Students.showAns')}}</th>
						</tr>
					</thead>
					<tbody>
						@for($i=0;$i<count($usersFinish);$i++)
							<tr>
								<td>{{$usersFinish[$i]['username']}}</a></td>
								<td style="direction:ltr;">{{$getResults[$i]}}/{{$getQues}}</td>
								<td>
									<a class="btn-floating waves-effect waves-light teal lighten-1" href="{{url('results/exam')}}/{{$getExam->id}}/{{$usersFinish[$i]['id']}}">
										<i class="material-icons">send</i>
									</a>
								</td>
							</tr>
						@endfor
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>
@stop