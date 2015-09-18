<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0; ">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Fablab Taitung 台東自造</title>

<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
<link rel='stylesheet' id='responsive-style-css'  href='./blog/wp-content/themes/responsive/style.css?ver=1.9.4.5' type='text/css' media='all' />
<link rel='stylesheet' id='responsive-child-style-css'  href='./blog/wp-content/themes/dine-with-me/style.css?ver=1.0.5' type='text/css' media='all' />
<style>

	body{
		  background: url(img/wood3.jpg) no-repeat center center fixed; 
		  -webkit-background-size: cover;
		  -moz-background-size: cover;
		  -o-background-size: cover;
		  background-size: cover;
  
		font-family: Georgia, "Times New Roman", "KaiTi", "楷体", STKaiti, "华文楷体", serif;
	}
	
	#main{
	height:638px;
	width:820px;
	float:left;
	background-color: rgba(225, 225, 225, 0.9);
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	background-size: cover;
	font-weight: bold;
	color:#600;
	}
	#leftmenu{
		width:300px;
		height:600px;
		float:left;
		background-color: rgba(225, 225, 225, 0.9);
	}
	a{
	color:#633;
	font-size:18px;
	}
	a:hover{
		color:#600;
		background-color:#733912;
	}
	.jumbotron{
		background-color: rgba(225, 225, 225, 0.6);
	}
</style>
<script>
  //20150910 add facebook app by Wesley
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1587003548215155',
      xfbml      : true,
      version    : 'v2.4'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));


  //20150910 add Google Analytics by Wesley
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-67412381-1', 'auto');
  ga('send', 'pageview');


	$(document).ready(function(){
		var images = [
			'img/10-Web-Design-Trends-for-2015.png'
			,'img/arduino.jpg'
			,'img/big-data.jpg'
			,'img/maker.jpg'
			];
		var i = 0;
		var timeoutVar;
	
		function changeBackground() {
			clearTimeout(timeoutVar);
			$('#main').css('background-image', function() {
				if (i >= images.length) {
					i=0;
				}
				return 'url(' + images[i++] + ')';      
			}).fadeIn(1000).delay(2000).fadeOut(1000);
			timeoutVar = setTimeout(changeBackground, 4000);
		}
		changeBackground();        
	});



</script>
</head>
	
<body>

<div class="container">

    <div id="leftmenu">
	<img src="img/FablabTaitungLogo.jpg" style="width:300px;"/>
    	<br />
        <br />
    	<ul class="nav nav-pills nav-stacked" style="max-width: 300px;">
          <li><a href="story">我們的故事</a></li>
          <!--<li><a href="ecommerce">我們的電子商店</a></li>-->
          <li><a href="#">聯絡我們</a></li>
          <li><a>地址：</a></li>
          <li><a>電話：</a></li>
	  <li></li>
          <li></li>
          <li></li>
        </ul>
<div class="fb-page" data-href="https://www.facebook.com/IMITaitung" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/facebook"><a href="https://www.facebook.com/facebook">Facebook</a></blockquote></div></div>
    </div>

	<div id="main" style=" font-size:32px;">
    </div>
</div>

</body>
