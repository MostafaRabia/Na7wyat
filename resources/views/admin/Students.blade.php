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
{!! Html::script(app('js').'/Students.js?ver=1.1.0') !!}
<!-- Start Section Page -->
<section class="pageSection">
	<div class="container">
		<div class="row">
			<div class="asideLeft col s12 left">
				<h4>{{trans('Students.Header')}}(<span class='count'>{{count($getFinsh)}}</span>)</h4>
				<table id="example" style="width:100%">
					<thead>
						<tr>
							<th>{{trans('Students.Username')}}</th>
							<th>{{trans('Students.Result')}}</th>
							<th>{{trans('Students.showAns')}}</th>
							<th>وقت الدخول</th>
							<th>وقت الانتهاء</th>
							<th>إعادة الامتحان</th>
						</tr>
					</thead>
					<tbody>
						@foreach($getFinsh as $Finish)
						@php
							$getResults = App\Results::where('id_user',$Finish->User->id)->where('id_exam',$id)->sum('degree');
						@endphp
							<tr>
								<td>{{$Finish->User->username}}</a></td>
								<td style="direction:ltr;">{{$getResults}}/{{$getQues}}</td>
								<td>
									<a class="btn-floating waves-effect waves-light teal lighten-1" href="{{url('results/exam')}}/{{$id}}/{{$Finish->User->id}}">
										<i class="material-icons">send</i>
									</a>
								</td>
								<td style="direction:ltr;">{{$Finish->created_at}}</td>
								<td style="direction:ltr;">{{$Finish->updated_at}}</td>
								<td>
									<a class="btn-floating waves-effect waves-light orange darken-4 repeat" href="{{url('repeat')}}/{{$id}}/{{$Finish->User->id}}" token={{csrf_token()}}>
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
