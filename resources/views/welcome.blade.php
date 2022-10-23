<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="description" content="自分のオンラインコーヒーショップを">
  <link rel="stylesheet" href="css/destyle.css">
  <link href="https://fonts.googleapis.com/css2?family=Philosopher&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/master.css">
  <title>WCB cafe</title>
</head>
<body>
  <div class="big-bg" id="home">
    <header class="page-header wrapper">
      <h1><a href="/"><img class="logo" src="images/logo.svg" alt="WEB cafe"></a></h1>
      <nav>
        <ul class="main-nav">
          <li><a href="{{ route('login') }}">LOGIN</a></li>
        </ul>
      </nav>
    </header>

    <div class="home-content wrapper">
      <h2 class="page-tittle">Laravel coffee shop</h2>
      <p>自分の一番を色んな人に</p>
      <a class="button" href="{{ route('login') }}">ログインして始める</a>
    </div><!--/.home-content-->
  </div>
</body>
</html>
