<html>
	<head>
	<title>Fais toi plaiz</title>
		<meta charset="utf-8">
		<link rel="icon" type="image/png" href="/img/favicon.png" />
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<style type="text/css">
			<?php if (isset($_GET['datas'])) :?>
				.firstStep{
					display: none;
				}
			<?php endif;?>
		</style>
		<script type="text/javascript" src="/js/jquery-1.8.2.min.js"></script>

		<script type="text/javascript">
			$(document).ready(function(){
				$('header#homeHeader .imgLogo').click(function(){$(document).attr('location', '/');});
				$(window).resize(resize);
				resize();
			});

			function resize(){
				$("#content .blockPartenaire").css({position: "absolute"});
				$("#content .blockPartenaire").css({
					top: function(){
						var h = $(this).height();
						var wH = $(window).height();
						var r = (wH-h)/2;
						if (r<103) {
							return false;
						}
						return r;
					},
					left: function(){
						var h = $(this).width();
						var wH = $(window).width();
						var r = (wH-h)/2;
						if (r<0) {
							return false;
						}
						return r;
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
					<div class="title">
						<div class="text">Partenaires</div>
					</div>
					<div class="partenaires">
						<?php
						$partenaires =
							array(
								'AGDMAG' => array('url' => 'http://www.agdmag.com/', 'img' => '/img/partenaires/AGD.jpg'),
								'KESAKO' => array('url' => 'http://www.kesako-le-blog.fr/', 'img' => '/img/partenaires/KESAKO.jpg'),
								'BEWARE MAG' => array('url' => 'http://bewaremag.com/', 'img' => '/img/partenaires/BEWAREMAG.jpg'),
								'MY GUERILLA MAKETING' => array(
									'url' => 'https://www.facebook.com/MyGuerillaMarketing?fref=ts',
									'img' => '/img/partenaires/my-guerilla-Marketing.jpg'
								),
								'THE BRAND NATION' => array(
									'url' => 'https://www.facebook.com/TheBrandNation?fref=ts',
									'img' => '/img/partenaires/THE-BRAND-NATION.jpg'
								),
								'La Pubotheque' => array(
									'url' => 'https://www.facebook.com/lapubotheque?fref=ts',
									'img' => '/img/partenaires/PUBOTHEQUE.jpg'
								),
								'Houhouhaha' => array('url' => 'http://houhouhaha.fr/', 'img' => '/img/partenaires/HOUHOUHAHA.jpg'),
								'Blog Esprit Design' => array('url' => 'http://www.blog-espritdesign.com/', 'img' => '/img/partenaires/BED.jpg'),
								'ZEUTCH' => array('url' => 'http://www.zeutch.com/', 'img' => '/img/partenaires/ZEUTCH.jpg'),
							);
						$datas = array_chunk($partenaires, 6, true);?>
						<?php foreach($datas as $partenaires) :?>
							<div class="line">
							<?php foreach ($partenaires as $k => $p):?>
								<div class="part">
									<a href="<?php echo $p['url'];?>">
										<img src="<?php echo $p["img"]?>" alt="<?php echo $k?>" title="<?php echo $k?>"/>
									</a>
								</div>
							<?php endforeach;?>
							</div>
						<?php endforeach;?>
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