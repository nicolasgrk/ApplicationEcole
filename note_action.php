<?php
include("include/_inc_parametres.php");
include("include/_inc_connexion.php");
if (isset ($_GET['action']))
{
	if ($_GET['action'] == 'modifier')//Si l'action est égale à modifier alors on fait:
	{


		// préparation de la requête : pour modifier les informations de la table
		$req_pre = $cnx->prepare("UPDATE note SET matiere=:matiere, note=:note
								  WHERE id= :id ");
		// liaison de la variable à la requête préparée
        $req_pre->bindValue(':matiere', utf8_encode($_POST['newmatiere']), PDO::PARAM_STR);
        $req_pre->bindValue(':note', utf8_encode($_POST['newNote']), PDO::PARAM_STR);
		$req_pre->bindValue(':id', $_POST['numero'], PDO::PARAM_INT);
		$req_pre->execute();


		?>
		<html>
		<head>
			<!-- <meta http-equiv="refresh" content="0 ; url=note.php">Rafraichissement/retour de la page joueur-->
		</head>
		<body>
		</body>
		</html>
		<?php
	}
	if ($_GET['action'] == 'ajouter')//Si l'action est égale à ajouter alors on fait:
	{
		

		// préparation de la requête : pour ajouter les informations de la table
		$matiere =$_POST['matiere'];
		$note=$_POST['note'];
		

	
		for ($i = 0; $i <=0; $i++) {
		$req_pre = $cnx->prepare("INSERT INTO note (matiere, note, id_utilisateur)
		VALUES ( :matiere, :note, :id_utilisateur)");
		//liaison de la variable à la requête préparée
		$req_pre->bindValue(':matiere',$_POST['matiere'] , PDO::PARAM_STR);
        $req_pre->bindValue(':note',$_POST['note'], PDO::PARAM_STR);
        $req_pre->bindValue(':id_utilisateur',$_POST['utilisateur'], PDO::PARAM_INT);
		$req_pre->execute();
		}

		?>
		<html>
		<head>
			 <!-- <meta http-equiv="refresh" content="0 ;url=note.php"><!--Rafraichissement/retour de la page joueur-->
		</head>
		<body>
		</body>
		</html>
		<?php
	}
	if ($_GET['action'] == 'supprimer')//Si l'action est égale à ajouter alors on fait:
	{

		
		// préparation de la requête : pour supprimer toutes les informations qui concerne le joueur dans la table session
		$req_pre = $cnx->prepare("DELETE FROM note WHERE id = :id");
		// liaison de la variable à la requête préparée
		$req_pre->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
		$req_pre->execute();



		?>
		<html>
		<head>
			<!--<meta http-equiv="refresh" content="0 ; url=note.php"><!--Rafraichissement/retour de la page joueur-->
		</head>
		<body>
		</body>
		</html>
		<?php
	}
	
}?>
