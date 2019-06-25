<!doctype html>
<html lang="en" dir="ltr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta http-equiv="Content-Language" content="en" />
	<meta name="msapplication-TileColor" content="#2d89ef">
	<meta name="theme-color" content="#4188c9">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<link rel="icon" href="{{ asset('favicon.ico')}} " type="image/x-icon" />
	<link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
	<!-- Generated: 2018-04-16 09:29:05 +0200 -->
	<title>Selamat Datang | Masuk</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet"
		href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
	<script src="{{ asset('assets/js/require.min.js')}}"></script>
	<script>
		requirejs.config({
			baseUrl: '{{ route('web.index') }}'
		});
	</script>
	<!-- Dashboard Core -->
	<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet" />
	<script src="{{ asset('assets/js/dashboard.js')}}"></script>
	<!-- c3.js Charts Plugin -->
	<link href="{{ asset('assets/plugins/charts-c3/plugin.css')}}" rel="stylesheet" />
	<script src="{{ asset('assets/plugins/charts-c3/plugin.js')}}"></script>
	<!-- Google Maps Plugin -->
	<link href="{{ asset('assets/plugins/maps-google/plugin.css')}}" rel="stylesheet" />
	<script src="{{ asset('assets/plugins/maps-google/plugin.js')}}"></script>
	<!-- Input Mask Plugin -->
	<script src="{{ asset('assets/plugins/input-mask/plugin.js')}}"></script>
	<!-- Custom CSS -->
	@yield('css')
</head>
<body class="">
    <div class="page">
        <div class="page-single">
            <div class="container">
                <div class="row">
                    <div class="col col-login mx-auto">
                        <div class="text-center mb-6">
                            {{-- <img src="{{ asset('img/logo.jpg')}}" class="h-6" alt=""> --}}
                        </div>
                        <form class="card" action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="card-body p-6">
                                <div class="card-title"><h3>Masuk</h3></div>
                                <div class="form-group">
                                    <label class="form-label">Email</label>
									<input type="email" name="email" class="form-control {{ ($errors->has('email')) ? 'is-invalid' : '' }}" placeholder="Masukan email" value="{{ old('email') }}">
                                    @if($errors->has('email'))
                                        <small class="form-text invalid-feedback" style="display: block !important">{{ $errors->first('email') }}</small>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control {{ ($errors->has('password')) ? 'is-invalid' : '' }}" id="exampleInputPassword1" placeholder="Password">
                                    @if($errors->has('password'))
                                            <small class="form-text invalid-feedback">{{ $errors->first('password') }}</small>
                                    @endif
                                </div>
                                <div class="form-footer">
                                    <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>