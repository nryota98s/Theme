<!DOCTYPE html>

<html>


<head>

<meta charset='utf-8"'>

<link rel='stylesheet' href="{{ asset('/css/app.css') }}">

<meta name="viewport" content="width=device-width, initial-scale=1">

</head>


<body>

<header>
<p>{{Auth::user()->image}}</p>

</header>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>


<div class='container'>


<p class="pull-right"><a class="btn btn-success" href="/create-form">投稿する</a></p>

<h2 class='page-header'>投稿一覧</h2>

<img src="{{ asset('storage/icon/'. Auth::user()->image) }}" alt="プロフィール画像">

<table class='table table-hover'>

<tr>

<th>ユーザーネーム</th>

<th>投稿内容</th>

<th>投稿日時</th>
<th></th>
</tr>



</table>

</div>

<footer>



</footer>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

</body>


</html>
