<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>MVCBOOTSTRAP - Sade Bir MVC Kütüphanesi</title>
	<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.9"></script>
	<link href="https://fonts.googleapis.com/css?family=Inconsolata&display=swap" rel="stylesheet">
	<style>
		html,body{
			padding: 0;
			margin:0;
		}
		center{
			position: absolute;
			top: 0;
			right: 0;
			bottom: 0;
			left: 0;
			margin: auto;
			height: 355px;
		}

		ol{
			list-style-type: disc;
		}

		li{
			display: inline-block;
			padding-right: 30px;
			font-family: monospace;
			font-size: 20px;
		}

		li:hover{
			text-decoration: underline;
			cursor: pointer;
		}

		a:visited{
			color:black;
		}

		a:link{
			color:black;
		}

		.footer{
			background-color: lightgray;
			width: 100%;
			position: fixed;
			bottom: 0;
			font-family: monospace;
			font-size: 15px;
			padding: 7px 0;
			text-align: center; 
		}
		#dberror{
			width:85px;
			height:75px;
			position: fixed;
			bottom:50px;
			right:30px;
			background: url('/images/databasedeactive.png');
			background-size: cover;
		}
		.alert{
			width: 400px;
			/* height: 30px; */
			font-family: trebuchet ms;
			font-weight: 600;
			text-align: center;
			background-color: #ffb900;
			box-shadow: 2px 2px 10px #ff9066;
			float: right;
			margin-right: 19px;
			margin-top: 9px;
			padding: 11px 0px;
			display: none;
			border-radius: 5px;
		}

		.gitbash{
			width: 320px;
			background-color: black;
			color: #12e435;
			font-family: 'Inconsolata', monospace;
			height: 20px;
			padding: 10px 0px;
		}

		.code{
		display: inline-block;
		margin-left: -18px;
		}
	</style>
</head>
<body>
	<?php if(! MYSQL_ENABLED ): ?>
		<div class="alert">Veritabanı Yapılandırması Gerekiyor!</div>
	<?php endif; ?>
	<center>
		<div>
			<img src="/images/mvcbootstraplogo.png" alt="logo">
			<hr></hr>
			<h2 style="font-family: monospace;font-weight: 300">PHP İçin Sade MVC Kütüphanesi</h2>
			<img src="/images/codesample.png" alt="codesample">
			<div class="gitbash"><span style="display:inline-block;float:left;margin-left:6px;">muffinweb@dev:~ $</span><div class="code"></div></div>
		</div>
		<br><br>
		<ol style="list-style-type: disc">
			<li>Dökümantasyon</li>
			<a href="https://github.com/muffinweb/mvcbootstrap" target="_blank"><li>Github</li></a>
			<a href="https://muffinweb.tk" target="_blank"><li>Geliştirici</li></a>
			<li>Versiyon Notları</li>
		</ol>
	</center>
	<?php if(!MYSQL_ENABLED): ?>
		<div id="dberror"></div>
	<?php endif;?>
	<div class="footer">Uğur Cengiz © 2019</div>
	<script src="/js/jquery.min.js"></script>

	<script>
	var options = {
	strings: ["Uncomment Line 14.", " public/index.php", "composer update"],
	typeSpeed: 40,
	loop: true
	}

	var typed = new Typed(".code", options);
	</script>
	<script>
		$(function(){
			$('#dberror').one('mouseenter', function(){
				$('.alert').fadeIn(1000).delay(2000).fadeOut();
				setTimeout(() => {
					$('#dberror').attr('title', 'Veritabanı Yapılandırması Gerekiyor!');
				})
			})
		})
	</script>
</body>
</html>