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
			$(window).resize(resize);
			resize();
		});

		function resize(){
			$("#content .blockPartenaire").css({position: "absolute"});
			$("#content .blockPartenaire").css({
				top: function(){
					var h = $(this).height();
					var wH = $(window).height();
					return (wH-h)/2;
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
			<div id="content" class="darkBg">
				<div class="blockPartenaire">
					<div class="title">Partenaires</div>
					<div class="partenaires">
						<?php
						$partenaires = array(
							'agdmag', 'giboow', 'FTP', 'Facebook', 'Twitter', 'InTheMix', 'Toto', 'GoldorakGo', 'JamesBond'
						);
						$datas = array_chunk($partenaires, 6);?>
						<?php foreach($datas as $partenaires) :?>
							<div class="line">
							<?php foreach ($partenaires as $p):?>
								<div class="part">
									<?php echo $p?>
								</div>
							<?php endforeach;?>
							</div>
						<?php endforeach;?>

					</div>
				</div>
			</div>
			<footer id="homeFooter">
				<div class="fb-like" width="300px" data-href="https://www.facebook.com/pages/Fais-toi-plaiz/409891349080073" data-send="false" data-layout="button_count" data-width="50" data-show-faces="false" data-font="arial"></div>
				<div id="team">
					Concept et r&eacute;alisation : <a href="/3x3.php">3X3</a>
					 & <a href="http://agdmag.com/">AGDMAG</a>
				 	// <a href="/partenaires.php">Partenaires</a>
				 </div>
				<div class=".clear"></div>
			</footer>
		</div>
	</body>
</html>