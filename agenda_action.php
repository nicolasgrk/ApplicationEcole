<?php
include("include/_inc_parametres.php");
include("include/_inc_connexion.php");
session_start();

if (isset ($_GET['action']))
{
	if ($_GET['action'] == 'modifier')//Si l'action est égale à modifier alors on fait:
	{


		// préparation de la requête : pour modifier les informations de la table
		$req_pre = $cnx->prepare("UPDATE emploiDuTemps SET matiere=:matiere, salle=:salle, dates=:datecours, HeureDebut=:heureDebut, HeureFin=:heureFin
								  WHERE id= :id ");
		// liaison de la variable à la requête préparée
        $req_pre->bindValue(':matiere',$_POST['matiere'] , PDO::PARAM_STR);
        $req_pre->bindValue(':salle',$_POST['salle'], PDO::PARAM_INT);
        $req_pre->bindValue(':datecours',$_POST['date'], PDO::PARAM_STR);
        $req_pre->bindValue(':heureDebut',$_POST['heureDebut'] , PDO::PARAM_STR);
        $req_pre->bindValue(':heureFin',$_POST['heureFin'] , PDO::PARAM_STR);
		$req_pre->bindValue(':id', $_POST['numero'], PDO::PARAM_INT);
		$req_pre->execute();


		?>
		<html>
		<head>
			<meta http-equiv="refresh" content="0 ; url=agenda.php"><!-- Rafraichissement/retour de la page joueur-->
		</head>
		<body>
		</body>
		</html>
		<?php
	}
	if ($_GET['action'] == 'ajouter')//Si l'action est égale à ajouter alors on fait:
	{
		

		// préparation de la requête : pour ajouter les informations de la table

		


		$req_pre = $cnx->prepare("INSERT INTO emploiDuTemps (matiere, salle, dates, HeureDebut, HeureFin, formation, id_utilisateur)
		VALUES ( :matiere, :salle, :datecours, :heureDebut, :heureFin, :idFormation, :id_utilisateur)");
		//liaison de la variable à la requête préparée
		$req_pre->bindValue(':matiere',$_POST['matiere'] , PDO::PARAM_STR);
        $req_pre->bindValue(':salle',$_POST['salle'], PDO::PARAM_INT);
        $req_pre->bindValue(':datecours',$_POST['date'], PDO::PARAM_STR);
        $req_pre->bindValue(':heureDebut',$_POST['heureDebut'] , PDO::PARAM_STR);
        $req_pre->bindValue(':heureFin',$_POST['heureFin'] , PDO::PARAM_STR);
        $req_pre->bindValue(':idFormation',$_POST['formation'] , PDO::PARAM_INT);
		$req_pre->bindValue(':id_utilisateur',$_SESSION['id'] , PDO::PARAM_INT);
        $req_pre->execute();
    

         
        
		

		?>
		<html>
		<head>
			<meta http-equiv="refresh" content="0 ;url=agenda.php"><!--Rafraichissement/retour de la page joueur-->
		</head>
		<body>
		</body>
		</html>
		<?php
	}
	if ($_GET['action'] == 'supprimer')//Si l'action est égale à ajouter alors on fait:
	{

		
		// préparation de la requête : pour supprimer toutes les informations qui concerne le joueur dans la table session
		$req_pre = $cnx->prepare("DELETE FROM emploiDuTemps WHERE id = :id");
		// liaison de la variable à la requête préparée
		$req_pre->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
		$req_pre->execute();



		?>
		<html>
		<head>
			<meta http-equiv="refresh" content="0 ; url=agenda.php"><!--Rafraichissement/retour de la page joueur-->
		</head>
		<body>
		</body>
		</html>
		<?php
	}
	
}?>
