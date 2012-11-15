<!DOCTYPE html>
<html>
	<?php
		include_once '../config/functions.php';
		if(isset($_POST['add'])) {
			addPhrase($bdd, $_POST);
		}
	?>
	<head>
		<title>Fais toi plaiz</title>

		<meta charset="utf-8">
		<title>Fais Yoi Plaiz -  Admin</title>
		<style type="text/css">

			/* root element for tabs  */
			ul.tabs {
			    list-style:none;
			    margin:0 !important;
			    padding:0;
			    border-bottom:1px solid #666;
			    height:30px;
			}

			/* single tab */
			ul.tabs li {
			    float:left;
			    text-indent:0;
			    padding:0;
			    margin:0 !important;
			    list-style-image:none !important;
			}

			/* link inside the tab. uses a background image */
			ul.tabs a {
			    background: #CCCCCC;
			    font-size:11px;
			    display:block;
			    height: 30px;
			    line-height:30px;
			    width: 134px;
			    text-align:center;
			    text-decoration:none;
			    color:#333;
			    padding:0px;
			    margin:0px;
			    position:relative;
			    top:1px;
			    -webkit-border-top-left-radius: 10px;
				-webkit-border-top-right-radius: 10px;
				-moz-border-radius-topleft: 10px;
				-moz-border-radius-topright: 10px;
				border-top-left-radius: 10px;
				border-top-right-radius: 10px;
				margin: 0 5px;
			}

			ul.tabs a:active {
			    outline:none;
			}

			/* when mouse enters the tab move the background image */
			ul.tabs a:hover {
			    background-position: -420px -31px;
			    color:#fff;
			}

			/* active tab uses a class name "current". its highlight is also done by moving the background image. */
			ul.tabs a.current, ul.tabs a.current:hover, ul.tabs li.current a {
			    background-position: -420px -62px;
			    cursor:default !important;
			    background: #A5E8FF	;
			    color:#000 !important;
			}

			/* Different widths for tabs: use a class name: w1, w2, w3 or w2 */


			/* width 1 */
			ul.tabs a.s { background-position: -553px 0; width:81px; }
			ul.tabs a.s:hover { background-position: -553px -31px; }
			ul.tabs a.s.current  { background-position: -553px -62px; }

			/* width 2 */
			ul.tabs a.l { background-position: -248px -0px; width:174px; }
			ul.tabs a.l:hover { background-position: -248px -31px; }
			ul.tabs a.l.current { background-position: -248px -62px; }


			/* width 3 */
			ul.tabs a.xl { background-position: 0 -0px; width:248px; }
			ul.tabs a.xl:hover { background-position: 0 -31px; }
			ul.tabs a.xl.current { background-position: 0 -62px; }


			/* initially all panes are hidden */
			.panes .pane {
			    display:none;
			}

			/* tab pane styling */
			.panes div.phrase {
			    padding:15px 10px;
			    border:1px solid #999;
			    border-top:0;
			    font-size:14px;
			    background-color:#fff;
			}

		</style>
		<script type="text/javascript" src="/js/jquery-1.8.2.min.js"></script>
		<script src="http://cdn.jquerytools.org/1.2.7/full/jquery.tools.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				  $("ul.tabs").tabs("div.panes > div");
				  $('input[name=test]').click(function(){
					var link = $(this).parent().find('input[name=link]').val();
					window.open(link);
				  });

				  $('input[name=modifier]').click(function(){
					var id = $(this).parent().find('input[name=id]').val();
					var phrase = $(this).parent().find('textarea').val();
					$.ajax({
						url: "action.php",
						data: {id: id, action:"modifier", phrase: phrase},
						type: "GET"
					}).success(function(response){
						alert('Modification prise en compte');
						console.log('success');
					});
				  });

				  $('input[name=supprimer]').click(function(){
					var phrase = $(this).parent().find('textarea').html();
					if (!confirm('Supprimer la phrase : "'+phrase+'"')) {
						return;
					}
					var parent = $(this).parent();
					var id = $(this).parent().find('input[name=id]').val();
					$.ajax({
						url: "action.php",
						data: {id: id, action:"supprimer"},
						type: "GET"
					}).success(function(response){
						parent.hide('slow', function(){parent.remove();})
					});
				  });
			});
		</script>
	</head>
	<body>




		<ul class="tabs">
			<li><a href="#">Homme - Compliment</a></li>
			<li><a href="#">Homme - Insulte</a></li>
			<li><a href="#">Femme - Compliment</a></li>
			<li><a href="#">Femme - Insulte</a></li>
			<li><a href="#">New</a></li>
		</ul>

		<div class="panes">
			<?php
			$conf = array(
				array('s' => 'M', 'i' => 0),
				array('s' => 'M', 'i' => 1),
				array('s' => 'F', 'i' => 0),
				array('s' => 'F', 'i' => 1),
			);
			foreach($conf as $c) :
			?>
			<div class="phrase">
			<?php
				$phrases = getPhrases($bdd, $c['s'], $c['i']);
				foreach ($phrases as $id => $phrase) :
			?>
					<div id='p<?php echo $phrase['id'];?>'>
						<textarea rows="2" cols="100"><?php echo htmlentities(utf8_encode($phrase["phrase"]), ENT_XHTML)?></textarea>
						<input type="hidden" name="id" value="<?php echo $phrase['id']?>">
						<input type="hidden" name="link" value="<?php
						echo generateUrl(array(
							'prenom' => 'test',
							'id' => $phrase['id'],
							'insulte' => $c['i'],
							'sexe' => $c['s']
						));
						?>">
						<input type="button" value="Test" name="test">
						<input type="button" value="Modifier" name="modifier">
						<input type="button" value="Supprimer" name="supprimer">

					</div>
			<?php
				endforeach;
			?>
			</div>
			<?php
			endforeach;
			?>
			<div>
				<form name="ajouter" method="post">
					<div>Sexe : <input type="radio" name="sexe" value="F" checked="checked"/>F <input type="radio" name="sexe" value="M"/>M</div>
					<div>Insulte : <input type="checkbox" name="insulte"></div>
					<div>Phrase :
						<div><textarea rows="2" cols="100" name="phrase"></textarea></div>
					</div>
					<div><input type="submit" value="Ajouter" name="add"></div>
				</form>
			</div>
		</div>
	</body>
</html>