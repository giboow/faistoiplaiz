<html>
	<head>
	<title>Fais toi plaiz</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<style type="text/css">
			<?php if (isset($_GET['datas'])) :?>
				.firstStep{
					display: none;
				}
			<?php endif;?>
		</style>
		<script type="text/javascript" src="/js/jquery-1.8.2.min.js"></script>
		<script type="text/javascript" src="/js/jquery.transit.js"></script>
		<script type="text/javascript" src="/js/jquery.timers.js"></script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('header#homeHeader .imgLogo').click(function(){$(document).attr('location', '/');});
			$('#team .member').hover(function(){
				$(this).find('.text').stop().animate({"margin-top": "120%"}, 800);
			}, function(){
				$(this).find('.text').stop().animate({"margin-top": "200%"}, 800);
			});
			$(window).resize(resize);
			resize();
		});

		function resize(){
			$("#content .blockTeam").css({position: "absolute"});
			$("#content .blockTeam").css({
				top: function(){
					var h = $(this).height();
					var wH = $(window).height();
					var r = (103+wH-h)/2;
					if(r < 103) {
						return false;
					}
					return r;
				},
				left: function(){
					var h = $(this).width();
					var wH = $(window).width();
					return (wH-h)/2;
				}
			});
		}

	</script>
	</head>
	<body>
		<div id="fb-root"></div>
		<script>
		(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/fr_FR/all.js#xfbml=1&appId=375265012567825";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
		</script>
		<div id="site" class="open">
			<header id="homeHeader">
				<div id="logo">
					<div class="imgLogo"></div>
				</div>
			</header>
			<div id="content" class="lightBg">
				<div class="blockTeam">
					<div id="presentation">
						<div class="logo"></div>
						<div class="text">
							<div class="top">3 fois 3 c&apos;est le collectif incontournable de la cr&eacute;ation digital!</div>
							<div class="middle">Anim&eacute; par cette envie d&apos;avancer et de cr&eacute;er des projets</div>
							<div class="bottom">3 Filles et 3 Garcons ce sont lanc&eacute;s dans le projet "FAIS-TOI-PLAIZ.COM"</div>
						</div>
						<div class="clear"></div>
					</div>
					<div id="team">
						<div class="member">
							<div class="text">
							</div>
						</div>
						<div class="member">
							<div class="text">
								<div class="title">Philippe Gibert</div>
								<div class="profession">Ing&eacute;nieur Recherche &amp; D&eacute;veloppement Web</div>
								<div class="prez">"Mes logiciels n&apos;ont jamais de bug. Ils d&eacute;veloppent juste certaines fonctions al&eacute;atoires."</div>
								<div class="reseaux"></div>
							</div>
						</div>
						<div class="member">
							<div class="text">
								<div class="title">John Eber</div>
								<div class="profession">Directeur Artistique chez The Branch Nation &amp; Fondateur d'AGDMAG</div>
								<div class="prez">"J'aime le cousous, les pates &agrave; la carbonara, mais aussi la cr&eacute;a.."</div>
								<div class="reseaux"></div>
							</div>
						</div>
						<div class="member">
							<div class="text">
							</div>
						</div>
						<div class="member">
							<div class="text">
							</div>
						</div>
						<div class="member">
							<div class="text">
							</div>
						</div>
						<div class="clear"></div>
					</div>
				</div>
			</div>
			<footer id="homeFooter">
				<div class="fb-like" data-href="https://www.facebook.com/pages/Fais-toi-plaiz/409891349080073" data-send="false" data-layout="button_count" data-width="50" data-show-faces="false" data-font="arial"></div>
				<div id="team">
					Concept et r&eacute;alisation : <a href="/3x3.php">3X3</a>
					 &amp; <a href="http://agdmag.com/">AGDMAG</a>
				 	// <a href="/partenaires.php">Partenaires</a>
				 </div>
				<div class=".clear"></div>
			</footer>
		</div>
	</body>
</html>