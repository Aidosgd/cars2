{{--http://czsale2.sensemedia.cz/index.html#--}}
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Cars2.kz - доска объявления запчастей автомобилей. Бесплатная доска объявлений Казахстана: Автозвук и мультимедиа, Двигатель и выхлопная система, Шины и диски!">
    <meta name="author" content="Айдос Токаев">
    <meta name="token" id="token" value="{{ csrf_token() }}">
    <title>{{ isset($titleSeo) ? $titleSeo : 'Cars2.kz - бесплатная доска объявления запчастей' }}</title>
    <link href="/css/all.css" rel="stylesheet">
    @yield('head')
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]-->
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <!--[endif]-->
</head>
<head>
<body>
<div class="container wrapper">
        @include('parts.header')
        <div class="row content">
            <div class="col-lg-3 content-left">
                @include('parts.sidebar')
            </div>
            <div class="col-lg-9 content-right">
                @yield('content')
            </div>
        </div>
        @include('parts.footer')
    </div>
     <!-- JavaScripts -->
    <!-- JavaScript -->
    <script src="/js/all.js"></script>
    @yield('scripts')
    <!-- Yandex.Metrika counter --> <script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter37131750 = new Ya.Metrika({ id:37131750, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true, trackHash:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script> <!-- /Yandex.Metrika counter -->
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-81134014-1', 'auto');
        ga('send', 'pageview');

    </script>
</body>
</html>
