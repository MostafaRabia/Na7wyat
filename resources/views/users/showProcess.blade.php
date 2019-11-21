@extends(app('users').'.Index')
@section('center')
    {!! Html::style(app('css').'/showProcessPage.css') !!}
	<!-- Start Section Info -->
	<section class="infoSection">
		<div class="container">
			<div class="row">
				<div class="infoDiv col s12 left">
                    <h4>- ما هو نظام المتابعة؟</h4>
                    <h5>هو نظام يذكرك بإرساله رسالة لك على تطبيق <a href='javascript:;'>Telegram</a> فيها أنه قد حان الوقت لرؤية فيديوهات الأسبوع المقرر عليك.</h5>
                    <br><br>
                    <h4>- كيف يمكنني الاشتراك في النظام؟</h4>
                    <h5>
                        اتبع الآتي:
                        <ul>
                            <li>
                                1- قم بتحميل تطبيق Telegram المناسب لك.
                                <ul>
                                    <li>للأندرويد: <a href="https://play.google.com/store/apps/details?id=org.telegram.messenger" target="_blank">Telegram Android</a></li>
                                    <li>للآيفون: <a href="https://apps.apple.com/app/telegram-messenger/id686449807" target="_blank">Telegram Iphone</a></li>
                                    <li>للويندوز فون: <a href="https://www.microsoft.com/ar-eg/p/telegram-messenger/9wzdncrdzhs0?rtc=1" target="_blank">Telegram WP</a></li>
                                    <li>للكمبيوتر: <a href="https://desktop.telegram.org/" target="_blank">Telegram Desktop</a></li>
                                    <li>macOS: <a href="https://macos.telegram.org/" target="_blank">Telegram macOS</a></li>
                                    <li>ويمكنك الدخول عليه من المتصفح: <a href="https://web.telegram.org/" target="_blank">Telegram Web</a></li>
                                </ul>

                                <li>2- ثم قم بالتسجيل عليه كما الواتس آب برقمك، وتأكد أننا لن نستطيع الحصول عليه.</li>
                                <li>3- أثناء تسجيلك، سوف تكتب اسمًا، لا تنسه لأنك ستحتاجه في الموقع هنا ويكون هو هو 100%.</li>
                                <li>4- اضغط هنا <a href="https://t.me/na7wyatBot" target="_blank">@na7wyatBot</a> ثم قم بإرسال رسالة له، وبهذا قد انتهى الاشتراك في Telegram.</li>
                                <li>5- اضغط هنا: <a href="{{url('profile/processing/settings')}}">إعدادات الاشتراك</a></li>

                            </li>
                        </ul>
                    </h5>
				</div>
			</div>
		</div>
	</section>
	<!-- End Section Info -->
@stop