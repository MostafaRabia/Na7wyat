@extends(app('users').'.Index')
@section('center')
    {!! Html::style(app('css').'/processSettings.css') !!}
    {!! Html::script(app('js').'/processSettings.js') !!}
	<!-- Start Section Info -->
	<section class="infoSection">
		<div class="container">
			<div class="row">
				<div class="infoDiv col s12 left">
                    {!! Form::open(['url'=>'profile/processing/settings','method'=>'post','class'=>'subscribeForm']) !!}
                        <div class="input-field col s12"> 
                            <h5>اسمك الأول على تليجرام -يرجى كتابته هو هو-</h5>
                            {!! Form::text('name',optional(auth()->user()->Telegram)->name,['class'=>'validate']) !!}
                        </div>

						<div class="input-field col s12"> 
                            <h5>الأسبوع الذي وصلت له</h5>
                            {!! Form::number('weak',optional(auth()->user()->Telegram)->weak,['class'=>'validate','min'=>1]) !!}
                        </div>

                        <div class="input-field col s12"> 
                            <h5>متى تريد أن تُذكَر؟</h5>
                            <div class="input-field col s12">
								<select name="date">
							      <option value="" disabled selected>اختر يومًا</option>
							      <option value="0" @if(optional(auth()->user()->Telegram)->date==0) selected @endif>الأحد</option>
							      <option value="1" @if(optional(auth()->user()->Telegram)->date==1) selected @endif>الإثنين</option>
							      <option value="2" @if(optional(auth()->user()->Telegram)->date==2) selected @endif>الثلاثاء</option>
							      <option value="3" @if(optional(auth()->user()->Telegram)->date==3) selected @endif>الأربعاء</option>
							      <option value="4" @if(optional(auth()->user()->Telegram)->date==4) selected @endif>الخميس</option>
							      <option value="5" @if(optional(auth()->user()->Telegram)->date==5) selected @endif>الجمعة</option>
								  <option value="6" @if(optional(auth()->user()->Telegram)->date==6) selected @endif>السبت</option>
							    </select>
							</div>
                        </div>

						<div class="input-field col s12"> 
                            <h5>متى تريد أن تُذكَر؟ -اليوم الثاني-</h5>
                            <div class="input-field col s12">
								<select name="date2">
							      <option value="" disabled selected>اختر يومًا</option>
							      <option value="0" @if(optional(auth()->user()->Telegram)->date==0) selected @endif>الأحد</option>
							      <option value="1" @if(optional(auth()->user()->Telegram)->date==1) selected @endif>الإثنين</option>
							      <option value="2" @if(optional(auth()->user()->Telegram)->date==2) selected @endif>الثلاثاء</option>
							      <option value="3" @if(optional(auth()->user()->Telegram)->date==3) selected @endif>الأربعاء</option>
							      <option value="4" @if(optional(auth()->user()->Telegram)->date==4) selected @endif>الخميس</option>
							      <option value="5" @if(optional(auth()->user()->Telegram)->date==5) selected @endif>الجمعة</option>
								  <option value="6" @if(optional(auth()->user()->Telegram)->date==6) selected @endif>السبت</option>
							    </select>
							</div>
                        </div>

                        <div class="input-field col s12">
                            <button class="btn waves-effect waves-light subscribe" type="submit" href="{{url('/')}}">	 اشترك
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
                    {!! Form::close() !!}
					<div class='to-hide'>
						<h5>للتحقق من التسجيل: <a href="{{url('profile/processing/check')}}" class='btn check'>اضغط هنا</a></h5>
						<a class="btn waves-effect waves-light subscribed" type="submit" href="{{url('/')}}">	 تم الاشتراك
                                <i class="material-icons right">arrow_forward</i>
						</a>

						<a class="btn waves-effect waves-light unsubscribed" type="submit" href="{{url()->current()}}">	 لم يتم الاشتراك
                                <i class="material-icons left">arrow_back</i>
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End Section Info -->
@stop