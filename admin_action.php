<?php
include("include/_inc_parametres.php");
include("include/_inc_connexion.php");
if (isset ($_GET['action']))
{
	if ($_GET['action'] == 'modifier')//Si l'action est égale à modifier alors on fait:
	{

		$addrmail=$cnx->query('SELECT count(*) as nbrAddr from utilisateur WHERE adresseMail= "'.$_POST['newadressemail'].'"');
		while($donne = $addrmail->fetch()){
			if ($donne['nbrAddr'] >= 2){
				echo "Adresse email existe déjà.\n Veuiller en saisir une autre";
			}else{

				// préparation de la requête : pour modifier les informations de la table  motDePasse=:motdepasse,
				$req_pre = $cnx->prepare("UPDATE utilisateur SET identifiant=:identifiant, adresseMail=:adressemail, nom=:nom, prenom=:prenom, dateNaissance=:datedenaissance, numeroRue=:numerorue, rue=:rue, ville=:ville, codePostale=:codepostale, id_formation=:idformation,role=:role
										WHERE id= :id ");
				// liaison de la variable à la requête préparée
				$req_pre->bindValue(':identifiant', $_POST['newIdentifiant'], PDO::PARAM_STR);
				//$req_pre->bindValue(':motdepasse', $mdp, PDO::PARAM_STR);
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
			}
		}
		$addrmail->closeCursor();
		?>
		<html>
		<head>
			<meta http-equiv="refresh" content="0 ; url=admin.php"> <!--Rafraichissement/retour de la page joueur-->
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
 

		$addrmail=$cnx->query('SELECT count(*) as nbrAddr from utilisateur WHERE adresseMail= "'.$_POST['adressemail'].'"');
		while($donne = $addrmail->fetch()){
			if ($donne['nbrAddr'] >= 1){
				echo "Adresse email existe déjà.\n Veuiller en saisir une autre";
			}else{
				$nom= ucwords($_POST['nom']);
				$prenom= ucwords($_POST['prenom']);
				$rue= ucwords($_POST['rue']);
				$ville= ucwords($_POST['ville']);
				$prenomID= strtolower($_POST['prenom']);


				$identifiant= substr($prenomID,0,1) . ".". $_POST['nom'];

				$req_pre = $cnx->prepare("INSERT INTO utilisateur (identifiant, motDePasse, adresseMail, nom, prenom, dateNaissance, numeroRue, rue, ville, codePostale, id_formation, role) 
				VALUES (:identifiant, :motdepasse, :adressemail, :nom, :prenom, :datedenaissance, :numerorue, :rue, :ville, :codepostale, :idformation, :role)");
				// liaison de la variable à la requête préparée
				$req_pre->bindValue(':identifiant', $identifiant, PDO::PARAM_STR);
				$req_pre->bindValue(':motdepasse', $mdp, PDO::PARAM_STR);
				$req_pre->bindValue(':adressemail', $_POST['adressemail'], PDO::PARAM_STR);
				$req_pre->bindValue(':nom', $nom, PDO::PARAM_STR);
				$req_pre->bindValue(':prenom', $prenom, PDO::PARAM_STR);
				$req_pre->bindValue(':datedenaissance', $_POST['datedenaissance'], PDO::PARAM_STR);
				$req_pre->bindValue(':numerorue', $_POST['numerorue'], PDO::PARAM_INT);
				$req_pre->bindValue(':rue', $rue, PDO::PARAM_STR);
				$req_pre->bindValue(':ville', $ville, PDO::PARAM_STR);
				$req_pre->bindValue(':codepostale', $_POST['codepostale'], PDO::PARAM_INT);
				$req_pre->bindValue(':role', $_POST['role'], PDO::PARAM_INT);
				$req_pre->bindValue(':idformation', $_POST['idformation'], PDO::PARAM_INT);
			
				$req_pre->execute();

				
				if($_POST){
				$email = "nicolasmaheesaip@gmail.com";
				$name = "Appli école";
				$object = "Voici votre mot de passe";
				$message = "Bonjour
								Votre identifiant est : ".$identifiant."
								Nouveau mot de passe
								voici votre nouveau mot de passe: ".$password."";


					$message = '<html><body>';
					$message .= '<h1>Bonjour</h1>';
					$message .= '<p>Votre identifiant est : '.$identifiant.'</p><p>Voici votre mot de passe:<strong> '.$password.'</strong></p>';
					$message .= '</body></html>';	
				
				$headers = "MIME-Version: 1.0\r\n";
				$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
				$headers .= "From: $name <$email>\r\nX-Mailer:PHP";
				
				$subject="Mot de passe";
				$destinataire=$_POST['adressemail'];
				$body="$message";
				if(mail($destinataire,$subject,$body,$headers)) {
					echo 'Votre email est envoyer';
				} else {
					echo "Votre adresse e-mail n'a pas pu être envoyer";
				}
				
				
				}

				?>
				<html>
					<head>
						<meta http-equiv="refresh" content="0 ;url=admin.php"><!--Rafraichissement/retour de la page-->
					</head>
					<body>
					</body>
				</html>
				<?php
					}
		}
		$addrmail->closeCursor();				
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
