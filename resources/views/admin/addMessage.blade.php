@extends(app('users').'.Index')
@section('center')
{!! Html::style(app('css').'/createStyle.css') !!}
{!! Html::script(app('js').'/addMessage.js') !!}
<!-- Start Section Page -->
<section class="pageSection">
	<div class="container">
		<div class="row">
			<div class="asideLeft col s12 left">
				<h4>إضافة رسائل</h4>
				{!! Form::open(['url'=>'admin/add/message','method'=>'post','class'=>'addForm']) !!}
					<div class="input-field col s12"> 
						<h5>الرسالة</h5>
						{!! Form::textarea('message','',['class'=>'materialize-textarea']) !!}
                    </div>

                    <div class="input-field col s12"> 
						<h5>للأسبوع</h5>
						{!! Form::number('weak','',['class'=>'validate']) !!}
                    </div>

                    <div class="input-field col s12">
						<button class="btn waves-effect waves-light addBtn" type="submit">	 إضافة الرسالة
							<i class="material-icons right">send</i>
						</button>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</section>
@stop
