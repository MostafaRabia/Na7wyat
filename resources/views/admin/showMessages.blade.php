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
							<th>#</th>
							<th>الرسالة</th>
							<th>للأسبوع</th>
							<th>تعديل</th>
							<th>حذف</th>
						</tr>
					</thead>
					<tbody>
						@foreach($showMessages as $message)
							<tr>
								<td>{{$message->id}}</td>
								<td>{{$message->message}}</td>
								<td>{{$message->for_weak}}</td>
								<td>
									<a class="btn-floating waves-effect waves-light teal lighten-1" href="{{url('admin/edit/message')}}/{{$message->id}}">
										<i class="material-icons">send</i>
									</a>
								</td>
								<td>
									<a class="btn-floating waves-effect waves-light red lighten-2" href="{{url('admin/delete/message')}}/{{$message->id}}">
										<i class="material-icons">send</i>
									</a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				<br>
				<a class="btn teal lighten-1" href="{{url('admin/add/message')}}">إضافة رسائل
				</a>
			</div>
		</div>
	</div>
</section>
@stop