<!DOCTYPE html>
<html>
	<head>
		<title>Fais toi plaiz</title>

		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery.transit.js"></script>
		<script type="text/javascript" src="js/main.js"></script>
	</head>
	<body>
		<div id="site">
			<div id="logo">
				<div class="text">Fais toi plaiz!</div>
			</div>

			<div id="leftBlock">
				<div class="content">
					<div class="firstStep">
						<div class="text">Tu veux un compliment?</div>
						<div class="img"></div>
					</div>
					<div class="secondStep">
						<div class="form">
							<div class="text">
								Comment t'appelles tu
							</div>
							<form type="POST" action="getPhrase.php">
								<input type="text" name="prenom" />
								<input type="submit" value="// Valider //" name="valider">
							</form>
						</div>
					</div>
					<div class="thirdStep">

					</div>
				</div>
			</div>

			<div id="separatorBlock"></div>

			<div id="rightBlock">
				<div class="content">
					<div class="firstStep">
						<div class="text">Tu veux tailler tes amis?</div>
						<div class="img"></div>
					</div>
					<div class="secondStep">
						<div class="text">
							Comment s'appelle ton pote
						</div>
					</div>
				</div>
			</div>
			<div class="clear"></div>
		</div>

	</body>
</html>