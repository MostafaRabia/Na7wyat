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
				<h4>{{trans('Students.notFinish')}}({{count($usersNotFinish)}})</h4>
				<table id="example" style="width:100%">
					<thead>
						<tr>
							<th style="text-align:right;">{{trans('Students.Username')}}</th>
						</tr>
					</thead>
					<tbody>
						@for($i=0;$i<count($usersNotFinish);$i++)
							<tr>
								<td style="text-align:right;">{{$usersNotFinish[$i]['username']}}</td>
							</tr>
						@endfor
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>
@stop