<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
    <meta id="token" name="token" value="{{ csrf_token() }}">
    <meta name="keywords" content="无厘头 搞笑 幽默 好去处 goodgoto 游戏 女性 恶搞 gif 笑笑小电影">
    <meta property="qc:admins" content="4457261067477476375" />
	<link rel="stylesheet" href="/css/all.css">
	<link rel="stylesheet" href="/css/main.css">
    <link rel="shortcut icon" href="/images/catalog/30avatardefault.jpg">
    <title>好去处 - Have Fun Now</title>
    <script>
		var _hmt = _hmt || [];
		(function() {
		  var hm = document.createElement("script");
		  hm.src = "//hm.baidu.com/hm.js?0e017dd4be7147b6bbbf67e79b2ae93f";
		  var s = document.getElementsByTagName("script")[0]; 
		  s.parentNode.insertBefore(hm, s);
		})();
	</script>
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</head>
   
<body data-spy="scroll" data-target="#myScrollspy" data-offset="70">
	    @include('partials.nav')
	<div class="container page">
		@yield('content')
		<ins class="adsbygoogle"
		     style="display:inline-block;width:300px;height:600px"
		     data-ad-client="ca-pub-9854929025598162"
		     data-ad-slot="9917246736"></ins>
		     <script>
		(adsbygoogle = window.adsbygoogle || []).push({});
	</script>
	</div> 
	<p id="back-to-top" ><a href="javascript:void(0)"></a></p>
    <script src="/js/all.js"></script>
	@include('footer')
	@include('flash')
	@yield('js')
	<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
	</script>
</body>
</html>
