@extends(app('users').'.Index')
@section('center')
{!! Html::style(app('css').'/myExamsStyle.css') !!}
{!! Html::style(app('css').'/datatables.min.css') !!}
{!! Html::style(app('css').'/rowReorder.dataTables.min.css') !!}
{!! Html::style(app('css').'/responsive.dataTables.min.css') !!}
{!! Html::script(app('js').'/jquery.dataTables.min.js') !!}
{!! Html::script(app('js').'/dataTables.rowReorder.min.js') !!}
{!! Html::script(app('js').'/dataTables.responsive.min.js') !!}
{!! Html::script(app('js').'/Students.min.js') !!}
<!-- Start Section Page -->
<section class="pageSection">
	<div class="container">
		<div class="row">
			<div class="asideLeft col s12 left">
				<h4>{{trans('Students.Header')}}({{count($usersFinish)}})</h4>
				<table id="example" style="width:100%">
					<thead>
						<tr>
							<th onclick="sortTable(0)">{{trans('Students.Username')}}</th>
						</tr>
					</thead>
					<tbody>
						@for($i=0;$i<count($usersFinish);$i++)
							<tr>
								<td><a href="{{url('results/exam')}}/{{$getExam->id}}/{{$usersFinish[$i]['id']}}">{{$usersFinish[$i]['username']}}</a></td>
							</tr>
						@endfor
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>
@stop