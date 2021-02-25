<?php
if($_POST){
  $email = "jbbg49000@gmail.com";
  $name = "GURAK";
  $object = "Voici votre mot de passe";
  $message = "Voici votre nouveau mot de passe  qui est $mdpAleatoire";

  $headers = "MIME-Version: 1.0\r\n";
  $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
  $headers .= "From: $name <$email>\r\nReply-to : $name <$email>\nX-Mailer:PHP";

  $subject="dfsfsfsdfdsfsdfdsfds";
  $destinataire="nicolasgurak@gmail.com";
  $body="$message";

  if(mail($destinataire,$subject,$body,$headers)) {
    echo 'your mail is sent';
  } else {
    echo "email pas envoyer";
  }

  
}
?>