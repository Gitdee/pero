<head>

    <meta charset="utf-8">
    
    <title>@hasSection('htmlheader_title')@yield('htmlheader_title') - @endif{{ LAConfigs::getByKey('sitename') }}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="@hasSection('meta_description')@yield('meta_description') @endif{{ LAConfigs::getByKey('site_description') }}">

    <meta name="keywords" content="@hasSection('meta_keywords')@yield('meta_keywords') @endif{{ LAConfigs::getByKey('site_keywords') }}">

    <link rel="shortcut icon" href="{{ asset('/la-assets/favicon.ico') }}" type="image/x-icon">

  	<!-- Bootstrap core CSS -->

    <link href="{{ asset('/la-assets/css/bootstrap.css') }}" rel="stylesheet">

    <link href="{{ asset('la-assets/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />


    <script>

      var base_url = '{{url('/')}}';

      var cur_locale = '{{App::getLocale()}}';

    </script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>

    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>

    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->

    @stack('styles')

</head>

