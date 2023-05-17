<!DOCTYPE html>

<html>


<head>

  <meta charset='utf-8"'>

  <link rel='stylesheet' href="{{ asset('/css/app.css') }}">

  <meta name="viewport" content="width=device-width, initial-scale=1">

</head>


<body>

  {{-- 時間表示 --}}
  {{--
  <p>{{ $testDateTime }}</p> --}}


  <header>
    <a href="/main"> <img class="logo" src="{{ asset('storage/icon/logo.png') }}" alt="プロフィール画像"></a>

    <h3>＜＜社員用＞＞</h3>

    @yield('admin_error')

  </header>

  @yield('user_info')

  @yield('passup_error')

  <div class='container'>

    @yield('container')

  </div>

  <footer>



  </footer>

  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

</body>


</html>
