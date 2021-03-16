<?php
include("include/_inc_parametres.php");
include("include/_inc_connexion.php");

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
			echo 'Votre email est envoyé';
		  } else {
			echo "Votre email ne s'est pas envoyé correctement";
		  }
		
		  
}

?>