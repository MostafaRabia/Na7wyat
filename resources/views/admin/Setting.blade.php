@extends(app('users').'.Index')
@section('center')
{!! Html::style(app('css').'/myExamsStyle.css') !!}
{!! Html::script(app('js').'/myExamsScript.min.js') !!}
<!-- Start Modal -->
<div id="modal1" class="modal modal-fixed-footer">
	<div class="modal-content">
		<h4>{{trans('Modal.h4ModalDelete')}}</h4>
		<p>{!!trans('Modal.pModalDelete')!!}</p>
	</div>
	<div class="modal-footer">
    	<a href="javascript:;" class="modal-action enter-modal waves-effect waves-red btn-flat">{{trans('Modal.Agree')}}</a>
    	<a href="javascript:;" class="modal-action modal-close waves-effect waves-green btn-flat">{{trans('Modal.Disagree')}}</a>
    </div>
</div>
<!-- End Modal -->
<!-- Start Section Page -->
<section class="pageSection">
	<div class="container">
		<div class="row">
			<div class="asideLeft col s12 left">
				<h4>{{trans('Exam.Exams')}}</h4>
				<h5>{{trans('Exam.Name')}}: {{$getExam->name}}</h5>
				<h5>
					{{trans('Exam.View')}}:
					<a class="btn-floating waves-effect waves-light teal lighten-1" href="{{url('show/exam')}}/{{$getExam->name}}">
						<i class="material-icons">send</i>
					</a>
				</h5>
				<h5>
					{{trans('Exam.Edit')}}:
					<a class="btn-floating waves-effect waves-light red lighten-2" href="{{url('edit/exam')}}/{{$getExam->id}}">
						<i class="material-icons">send</i>
					</a>
				</h5>
				<h5>
					{{trans('Exam.Stop')}}:
					<div class="switch">
						<label>
							Off
							<input type="checkbox" id="{{$getExam->id}}" value="{{$getExam->avil}}">
							<span class="lever"></span>
							On
						</label>
					</div>
				</h5>
				<h5>
					{{trans('Exam.Students')}}:
					<a class="btn-floating waves-effect waves-light blue darken-4" href="{{url('students/exam/')}}/{{$getExam->id}}">
						<i class="material-icons">send</i>
					</a>
				</h5>
				<h5>
					{{trans('Exam.notStudents')}}:
					<a class="btn-floating waves-effect waves-light blue-grey" href="{{url('notstudents/exam/')}}/{{$getExam->id}}">
						<i class="material-icons">send</i>
					</a>
				</h5>
				<h5>{{trans('Exam.deleteExam')}}: <a class="btn-floating waves-effect waves-light orange darken-4 delete" href="{{url('delete/exam/')}}/{{$getExam->id}}">
									<i class="material-icons">send</i>
								</a></h5>
				<h5>
					{{trans('Exam.addQue')}}:
					<a class="btn-floating waves-effect waves-light green darken-4" href="{{url('create/exam/')}}/{{$getExam->id}}">
						<i class="material-icons">send</i>
					</a>
				</h5>
			</div>
		</div>
	</div>
</section>
@stop
