<?php
include("include/_inc_parametres.php");
include("include/_inc_connexion.php");
if (isset ($_GET['action']))
{
	if ($_GET['action'] == 'modifier')//Si l'action est égale à modifier alors on fait:
	{
		$mdp = password_hash($_POST['newmotdepasse'], PASSWORD_BCRYPT);

		// préparation de la requête : pour modifier les informations de la table
		$req_pre = $cnx->prepare("UPDATE utilisateur SET identifiant=:identifiant, motDePasse=:motdepasse, adresseMail=:adressemail, nom=:nom, prenom=:prenom, dateNaissance=:datedenaissance, numeroRue=:numerorue, rue=:rue, ville=:ville, codePostale=:codepostale, id_formation=:idformation,role=:role
								  WHERE id= :id ");
		// liaison de la variable à la requête préparée
		$req_pre->bindValue(':identifiant', $_POST['newIdentifiant'], PDO::PARAM_STR);
		$req_pre->bindValue(':motdepasse', $mdp, PDO::PARAM_STR);
		$req_pre->bindValue(':adressemail', $_POST['newadressemail'], PDO::PARAM_STR);
		$req_pre->bindValue(':nom', $_POST['newnom'], PDO::PARAM_STR);
		$req_pre->bindValue(':prenom', $_POST['newprenom'], PDO::PARAM_STR);
		$req_pre->bindValue(':datedenaissance', $_POST['newdatedenaissance'], PDO::PARAM_STR);
		$req_pre->bindValue(':numerorue', $_POST['newnumerorue'], PDO::PARAM_INT);
		$req_pre->bindValue(':rue', $_POST['newrue'], PDO::PARAM_STR);
		$req_pre->bindValue(':ville', $_POST['newville'], PDO::PARAM_STR);
		$req_pre->bindValue(':codepostale', $_POST['newcodepostale'], PDO::PARAM_INT);
		$req_pre->bindValue(':role', $_POST['newrole'], PDO::PARAM_INT);
		$req_pre->bindValue(':idformation', $_POST['newidformation'], PDO::PARAM_INT);
		$req_pre->bindValue(':id', $_POST['numero'], PDO::PARAM_INT);
		$req_pre->execute();


		?>
		<html>
		<head>
			<meta http-equiv="refresh" content="0 ; url=admin.php"><!-- Rafraichissement/retour de la page joueur-->
		</head>
		<body>
		</body>
		</html>
		<?php
	}
	if ($_GET['action'] == 'ajouter')//Si l'action est égale à ajouter alors on fait:
	{


			// Initialisation des caractères utilisables
			$characters = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z");
			$password="#@&";
			for($i=0;$i<10;$i++)
			{
				$password .= ($i%2) ? strtoupper($characters[array_rand($characters)]) : $characters[array_rand($characters)];
			}
				

		
		$mdp = password_hash($password, PASSWORD_BCRYPT);

		

		$req_pre = $cnx->prepare("INSERT INTO utilisateur (identifiant, motDePasse, adresseMail, nom, prenom, dateNaissance, numeroRue, rue, ville, codePostale, id_formation, role) 
		VALUES (:identifiant, :motdepasse, :adressemail, :nom, :prenom, :datedenaissance, :numerorue, :rue, :ville, :codepostale, :idformation, :role)");
		// liaison de la variable à la requête préparée
		$req_pre->bindValue(':identifiant', $_POST['identifiant'], PDO::PARAM_STR);
		$req_pre->bindValue(':motdepasse', $mdp, PDO::PARAM_STR);
		$req_pre->bindValue(':adressemail', $_POST['adressemail'], PDO::PARAM_STR);
		$req_pre->bindValue(':nom', $_POST['nom'], PDO::PARAM_STR);
		$req_pre->bindValue(':prenom', $_POST['prenom'], PDO::PARAM_STR);
		$req_pre->bindValue(':datedenaissance', $_POST['datedenaissance'], PDO::PARAM_STR);
		$req_pre->bindValue(':numerorue', $_POST['numerorue'], PDO::PARAM_INT);
		$req_pre->bindValue(':rue', $_POST['rue'], PDO::PARAM_STR);
		$req_pre->bindValue(':ville', $_POST['ville'], PDO::PARAM_STR);
		$req_pre->bindValue(':codepostale', $_POST['codepostale'], PDO::PARAM_INT);
		$req_pre->bindValue(':role', $_POST['role'], PDO::PARAM_INT);
		$req_pre->bindValue(':idformation', $_POST['idformation'], PDO::PARAM_INT);
	
		$req_pre->execute();

		
		if($_POST){
		  $email = "nicolasmaheesaip@gmail.com";
		  $name = "Appli école";
		  $object = "Voici votre mot de passe";
		  $message = "<h1>Bonjour</h1>
						<h2>Nouveau mot de passe</h2>
						<p>voici votre nouveau mot de passe: ".$password."</p>";
		
		  $headers = "MIME-Version: 1.0\r\n";
		  $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
		  $headers .= "From: $name <$email>\r\nX-Mailer:PHP";
		
		  $subject="Mot de passe";
		  $destinataire=$_POST['adressemail'];
		  $body="$message";
		
		  if(mail($destinataire,$subject,$body,$headers)) {
			echo 'your mail is sent';
		  } else {
			echo "email pas envoyer";
		  }
		
		  
		}
		

		?>
		<html>
			<head>
 				<!--<meta http-equiv="refresh" content="0 ;url=admin.php">Rafraichissement/retour de la page-->
			</head>
			<body>
			</body>
		</html>
		<?php
	}
	if ($_GET['action'] == 'supprimer')//Si l'action est égale à ajouter alors on fait:
	{

		
		// préparation de la requête : pour supprimer toutes les informations qui concerne le joueur dans la table session
		$req_pre = $cnx->prepare("DELETE FROM utilisateur WHERE id = :id");
		// liaison de la variable à la requête préparée
		$req_pre->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
		$req_pre->execute();



		?>
		<html>
			<head>
				<meta http-equiv="refresh" content="0 ; url=admin.php"><!--Rafraichissement/retour de la page joueur-->
			</head>
			<body>
			</body>
		</html>
		<?php
	}
	
}?>
