@extends(app('users').'.Index')
@section('center')
{!! Html::style(app('css').'/homePanel.css') !!}
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
			                <th>{{trans('examUsersPanel.Name')}}</th>
			                <th>{{trans('examUsersPanel.Degree')}}</th>
			            </tr>
			        </thead>
			        <tbody>
			        	@foreach($getExamUsers as $User)
			        		@php
			        			$getUser = App\Users::where('id_user',$User->id_user)->first();
			        			$getDegree = App\Results::where('id_user',$getUser->id)->where('id_exam',$id)->sum('degree');
			        			$getDegreeQues = App\Ques::where('id_exam',$id)->sum('degree');
			        		@endphp
				            <tr>
				                <td>{{$getUser->username}}</td>
				                <td>{{$getDegree}}/{{$getDegreeQues}}</td>
				            </tr>
			            @endforeach
			        </tbody>
			        <tfoot>
			            <tr style="color:white;">
			                <th>{{trans('examUsersPanel.Name')}}</th>
			                <th>{{trans('examUsersPanel.Degree')}}</th>
			            </tr>
			        </tfoot>
			    </table>
			</div>
		</div>
	</div>
</section>
<!-- End Section Info -->
@stop