@extends(app('users').'.Index')
@section('center')
{!! Html::style(app('css').'/createStyle.css') !!}
<!-- Start Section Page -->
<section class="pageSection">
	<div class="container">
		<div class="row">
			<div class="asideLeft col s12 left">
				<h4>تعديل رسائل</h4>
				{!! Form::open(['url'=>'admin/edit/message/'.$getMessage->id,'method'=>'post']) !!}
					<div class="input-field col s12"> 
						<h5>الرسالة</h5>
						{!! Form::textarea('message',$getMessage->message,['class'=>'materialize-textarea']) !!}
                    </div>

                    <div class="input-field col s12"> 
						<h5>للأسبوع</h5>
						{!! Form::number('weak',$getMessage->for_weak,['class'=>'validate']) !!}
                    </div>

                    <div class="input-field col s12">
						<button class="btn waves-effect waves-light addBtn" type="submit">	 تعديل الرسالة
							<i class="material-icons right">send</i>
						</button>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</section>
@stop
