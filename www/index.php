<!DOCTYPE html>
<html>
	<?php
	include_once __DIR__.'/config/functions.php';
	?>
	<head>
		<title>Fais toi plaiz</title>
		<link rel="icon" type="image/png" href="/img/favicon.png" />
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
		<script type="text/javascript">
			<?php if (isset($_GET['datas'])) :?>
				$(document).data('encodedData', jQuery.parseJSON('<?php echo  json_encode(decodeData($_GET['datas']));?>'));
			<?php endif;?>
		</script>

		<script type="text/javascript" src="/js/main.js"></script>
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

		<div id="site">
			<header id="homeHeader">
				<div id="logo">
					<div class="imgLogo"></div>
					<div class="firstStep">
						<div class="separator"></div>
						<div class="text">Besoin d'&ecirc;tre compliment&eacute; ?</div>
						<div class="text">Ou besoin de vanner tes potes ?</div>
					</div>
				</div>
			</header>
			<div id="content">
				<div class="secondStep">
					<div id="leftBlock" class="lightBg">
						<div class="contentBlock">
							<div class="imgBlock"></div>
							<div class="title">
								<div class="first">Fais-toi plaiz</div>
								<div class="middle">
									avec
									<div class="separatorLeft"></div>
									<div class="separatorRight"></div>
								</div>
								<div class="last">un compliment</div>
							</div>
							<div class="subTitle">
								<div class="text">
									T'es un peu triste ?<br />
									Remonte toi le moral en recevant<br />
									un compliment !<br />
								</div>
								<div class="beginBt">// commencer \\</div>
							</div>
						</div>
					</div>
					<div id="rightBlock" class="darkBg">
						<div class="contentBlock">
							<div class="imgBlock"></div>
							<div class="title">
								<div class="first">Fais-toi plaiz</div>
								<div class="middle">
									avec
									<div class="separatorLeft"></div>
									<div class="separatorRight"></div>
								</div>
								<div class="last">une vanne</div>
							</div>
							<div class="subTitle">
								<div class="text">
									T'as besoin de te d&eacute;fouler ?<br />
									Choisis ta cible et taille la avec<br />
									une insulte !
								</div>
								<div class="beginBt">// commencer \\</div>
							</div>
						</div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="thirdStep">
					<div class="content">
						<div id="first">
							<div class="text">
								?
								<div class="leftSeparator"></div>
								<div class="rightSeparator"></div>
							</div>
							<div class='title'>
								<span class="upper">Fille</span> ou <span class="upper">Gar&ccedil;on</span>
								<div class="choice">
									<div class="female"></div>
									<div class="separator"></div>
									<div class="male"></div>
								</div>
								<div class="clear"></div>
							</div>
							<div class="text">
								?
								<div class="leftSeparator"></div>
								<div class="rightSeparator"></div>
							</div>
							<div class="ombre"></div>
							<div class="help">Choisis le sexe de la personne que tu veux complimenter</div>
						</div>
						<div id="second">
							<div class="text">
								?
								<div class="leftSeparator"></div>
								<div class="rightSeparator"></div>
							</div>
							<div class='title'>
								<div class="upper big">Comment</div>
								<div class="upper">t'appelles tu</div>
							</div>
							<div class="text">
								?
								<div class="leftSeparator"></div>
								<div class="rightSeparator"></div>
							</div>
							<div class="form">
								<form action="/getPhrase.php">
									<input type="text" name="prenom" placeholder="ENTRE TON PRENOM" autocomplete="off"></input>
									<div class="ombre"></div>
									<input type="submit" name="valider" value="// VALIDER //" />
								</form>
							</div>
						</div>
						<div id="final">
							<div id="postit" class="jaune">
								<div class="content">
									<div class="text">
										<div class="left logoSeparator"></div>
										<div class="right logoSeparator"></div>
										<div class="logo"></div>
										<div class="clear"></div>
									</div>
									<div class="phrase"></div>
									<div class="separatorBottom"></div>
								</div>
							</div>
							<div class="helpSharing"></div>
							<div class="next"></div>
							<div class="fbSharing"></div>
							<div class="ombre"></div>
							<div class="clear"></div>
						</div>
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