<?php
include("include/_inc_parametres.php");
include("include/_inc_connexion.php");


if($_POST){
		$mdpoemail = $_POST['mdpoemail'];
		// Initialisation des caractères utilisables
		$characters = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z");
		$password="#@&";
		for($i=0;$i<10;$i++)
		{
			$password .= ($i%2) ? strtoupper($characters[array_rand($characters)]) : $characters[array_rand($characters)];
		}	
			$mdp = password_hash($password, PASSWORD_BCRYPT);
	
		$req_pre = $cnx->prepare("UPDATE utilisateur SET motDePasse = '".$mdp."' WHERE adresseMail ='".$mdpoemail."'");

		$req_pre->execute();


		$email = "nicolasmaheesaip@gmail.com";
		$name = "Appli école";
		$object = "Voici votre mot de passe";



					$message = '<html><body>';
					$message .= '<h1>Bonjour</h1>';
					$message .= '<p>Voici votre nouveau mot de passe:<strong> '.$password.'</strong></p>';
					$message .= '</body></html>';		
		
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers .= "From: $name <$email>\r\nX-Mailer:PHP";
		
		$subject="Mot de passe";
		$destinataire=$mdpoemail;
		$body="$message";
		
		if(mail($destinataire,$subject,$body,$headers)) {
			echo 'Votre email est envoyé';
			header('refresh:1; url=index.php');
		} else {
			echo "Votre email ne s'est pas envoyé correctement";
			header('refresh:1; url=motdepasseoublie.php');
		  }
		
		  
}

?>