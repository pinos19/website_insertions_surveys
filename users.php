<!DOCTYPE html>
<html>
    <head>
        <title>Enquête d'insertion professionnelle - Statistiques</title>
        <link rel="stylesheet" type="text/css" href="style.css?d=3"/>
        <link rel="icon" type="image/png" href="img/student.png" />
        <meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
		<?php include 'connect_db.php'?>

    </head>
    <body>

		<header class="flex jc-center center">
			<div class="wrapper flex jc-sb ai-center">
				<div>
					<a href="index.php"><img src="img/logo.png" width="200"/></a>
				</div>
				<div>
					<h1>Enquête Insertion Professionnelle</h1>
				</div>
			</div>
		</header>
			<div class="subheader">
				<div class="subheader-grey flex jc-center ai-center">
					<div>
						<h2>Étudiants</h2>
						<a href="questions.php">Questions</a>
					</div>
				</div>
			</div>

			<div class="flex jc-center center">
				<div class="wrapper">
					<?php
						$taille = $db->query('SELECT count(*) as `nb_questions` from questions');
						$var = $taille->fetch();
						$nb_questions=$var[0];
						$taille->closeCursor();
						$reponse =$db->query('SELECT * FROM utilisateurs');
						echo '<table class="center">';
						echo '<tr><th>N°</th><th>Nom</th><th>Prénom</th><th>complétion</th><th>aperçu</th></tr>';
						while ($donnees = $reponse->fetch()){

							$traitement= $db->prepare('SELECT count(*) FROM reponses WHERE idU = ?');
							$traitement->execute(array($donnees['id']));
							$rep=$traitement->fetch();
							echo '<tr><td>'.$donnees['id'].'</td><td>'.$donnees['nom'].'</td><td>'.$donnees['prenom'].'</td><td>'.(($rep[0]/$nb_questions)*100).' %</td><td><a href="">voir les réponses</a></td></tr>';

						}
						echo '</table>';
						$reponse->closeCursor();
						$traitement->closeCursor();
					?>
				</div>
			</div>
	</body>
</html>
