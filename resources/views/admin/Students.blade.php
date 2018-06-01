@extends(app('users').'.Index')
@section('center')
{!! Html::style(app('css').'/myExamsStyle.css') !!}
{!! Html::style(app('css').'/datatables.min.css') !!}
{!! Html::style(app('css').'/rowReorder.dataTables.min.css') !!}
{!! Html::style(app('css').'/responsive.dataTables.min.css') !!}
{!! Html::script(app('js').'/jquery.dataTables.min.js') !!}
{!! Html::script(app('js').'/dataTables.rowReorder.min.js') !!}
{!! Html::script(app('js').'/dataTables.responsive.min.js') !!}
{!! Html::script(app('js').'/num-html.js') !!}
{!! Html::script(app('js').'/Students.js') !!}
<!-- Start Section Page -->
<section class="pageSection">
	<div class="container">
		<div class="row">
			<div class="asideLeft col s12 left">
				<h4>{{trans('Students.Header')}}({{count($usersFinish)}})</h4>
				<table id="example" style="width:100%">
					<thead>
						<tr>
							<th>{{trans('Students.Username')}}</th>
							<th>{{trans('Students.Result')}}</th>
							<th>{{trans('Students.showAns')}}</th>
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
