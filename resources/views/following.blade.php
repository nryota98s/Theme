<!DOCTYPE html>


<html>


<head>

<meta charset='utf-8"'>

<link rel='stylesheet' href='/css/app.css'>

<meta name="viewport" content="width=device-width, initial-scale=1">

</head>


<body>




<div class='container'>
<h2>フォロー中のユーザー</h2>
  @foreach ($list as $list)


<div class="fing_info">

  <img class="icon" src="{{ asset('storage/icon/'.$list->image) }}" alt="プロフィール画像">
<div class="fing_nb">

<p class="fing_i">{{ $list->name }}</p>

<p class="fing_i">{{ $list->bio }}</p>
<p>フォロー中</p>
</div>

</div>







@endforeach

@if(empty($list))
<p>フォローしているユーザーはいません</p>
@endif



</div>

<footer>



</footer>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

</body>


</html>
