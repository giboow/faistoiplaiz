<!DOCTYPE html>
<html>
	<head>
		<title>Fais toi plaiz!</title>
		<link rel="icon" type="image/png" href="/img/favicon.png" />
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="/css/style.css">
		<script type="text/javascript" src="/js/jquery-1.8.2.min.js"></script>
		<script type="text/javascript" src="/js/jquery.timers.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				init();
				$(window).resize(resizeWindow);
				$("#compteur").everyTime(500, function(){
					var now = new Date();
					var date = new Date('December 5, 2012 09:00:00');
					var sub = (date - now) / 1000;
					var d = secondsToTime(sub);
					$(this).find('#jours .value').html(d.d);
					$(this).find('#heures .value').html(d.h);
					$(this).find('#minutes .value').html(d.m);
					$(this).find('#secondes .value').html(d.s);
				})
			});

			function init(){
				resizeWindow();
			}

			function resizeWindow() {
				$("#site.wait #content").css({
					left : function() {
						var lW = $(window).width();
						var w = $(this).width();
						var result = (lW - w)/2;
						if (result < 0) {
							return 0;
						}
						return result;
					},
					top : function() {
						var wH = $(window).height();
						var h = $(this).height();
						var result = (wH - h) /2;
						if(result < 0) {
							return 0;
						}
						return result;
					}
				});
			}

			function secondsToTime(secs)
			{

			    var days = Math.floor(secs / (60 * 60 * 24));
			    var rest = secs % (60 * 60 * 24);
			    var hours = Math.floor(rest / (60 * 60));
			    rest = rest % (60 * 60);
			    var minutes = Math.floor(rest / 60);
			    var seconds = Math.floor(rest % 60)
			    var obj = {
			        "d" : days,
			        "h": hours,
			        "m": minutes,
			        "s": seconds
			    };
			    return obj;
			}

		</script>
		<script>
		(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/fr_FR/all.js#xfbml=1&appId=375265012567825";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
		</script>
	</head>

	<body>
		<div id="site" class="darkBg wait">
			<div id="content">
				<div id="top">
					<div class="leftSeparator"></div>
					<div class="rigthSeparator"></div>
					<div id="logo"></div>
					<div class="clear"></div>
				</div>
				<div class="text">
					<div class="top">Le 1<span class="pos">er</span> Site</div>
					<div class="middle">Qui te fait</div>
					<div class="bottom">Du bien !</div>
				</div>
				<div id="compteur">
					<div class="top">
						<span id="jours">
							<span class="value"></span>
							jours
						</span>
						<span id="heures">
							<span class="value"></span>
							Heures
						</span>
					</div>
					<div class="bottom">
						<span id="minutes">
							<span class="value"></span>
							Minutes
						</span>
						<span id="secondes">
							<span class="value"></span>
							secondes
						</span>
					</div>
				</div>
				<div id="share">
					<div class="fb-like" data-href="https://www.facebook.com/pages/Fais-toi-plaiz/409891349080073"
							data-send="false" data-layout="button_count" data-width="50" data-show-faces="false" data-font="arial"></div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
		  //TAG ANALYTICS
		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-36281517-1']);
		  _gaq.push(['_trackPageview']);

		  (function() {
		    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();
		</script>
	</body>
</html>