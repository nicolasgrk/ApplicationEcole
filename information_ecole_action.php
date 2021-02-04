<?php
include("include/_inc_parametres.php");
include("include/_inc_connexion.php");
if (isset ($_GET['action']))
{
	if ($_GET['action'] == 'modifier')//Si l'action est égale à modifier alors on fait:
	{


		// préparation de la requête : pour modifier les informations de la table
		$req_pre = $cnx->prepare("UPDATE infoEcole SET intituleEvenement=:evenement, date=:newDate
								  WHERE id= :id ");
		// liaison de la variable à la requête préparée
        $req_pre->bindValue(':evenement', utf8_encode($_POST['newName']), PDO::PARAM_STR);
        $req_pre->bindValue(':newDate', utf8_encode($_POST['newDate']), PDO::PARAM_STR);
		$req_pre->bindValue(':id', $_POST['numero'], PDO::PARAM_INT);
		$req_pre->execute();


		?>
		<html>
		<head>
			 <meta http-equiv="refresh" content="0 ; url=information_ecole.php"><!--Rafraichissement/retour de la page joueur-->
		</head>
		<body>
		</body>
		</html>
		<?php
	}
	if ($_GET['action'] == 'ajouter')//Si l'action est égale à ajouter alors on fait:
	{
		

		// préparation de la requête : pour ajouter les informations de la table
		$nomEvenement =$_POST['nomEvenement'];
		$date=$_POST['date'];

	
		for ($i = 0; $i <=0; $i++) {
		$req_pre = $cnx->prepare("INSERT INTO infoEcole (intituleEvenement, date)
		VALUES ( :nomEvenement, :date)");
		//liaison de la variable à la requête préparée
		$req_pre->bindValue(':nomEvenement',$_POST['nomEvenement'] , PDO::PARAM_STR);
        $req_pre->bindValue(':date',$_POST['date'], PDO::PARAM_STR);
		$req_pre->execute();
		}

		?>
		<html>
		<head>
			  <meta http-equiv="refresh" content="0 ;url=information_ecole.php"><!--Rafraichissement/retour de la page joueur-->
		</head>
		<body>
		</body>
		</html>
		<?php
	}
	if ($_GET['action'] == 'supprimer')//Si l'action est égale à ajouter alors on fait:
	{

		
		// préparation de la requête : pour supprimer toutes les informations qui concerne le joueur dans la table session
		$req_pre = $cnx->prepare("DELETE FROM infoEcole WHERE id = :id");
		// liaison de la variable à la requête préparée
		$req_pre->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
		$req_pre->execute();



		?>
		<html>
		<head>
			<meta http-equiv="refresh" content="0 ; url=information_ecole.php"><!--Rafraichissement/retour de la page joueur-->
		</head>
		<body>
		</body>
		</html>
		<?php
	}
	
}?>
