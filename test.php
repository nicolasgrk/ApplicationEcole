<?php

     $to      = 'delaslle.sio.gurak.n@gmail.com';
     $subject = 'le sujet';
     $message = 'Bonjour !';
     $headers = 'From: nicolasgurak@gmail.com' . "\r\n" .
     'Reply-To: webmaster@example.com' . "\r\n" .
     'X-Mailer: PHP/' . phpversion();

     mail($to, $subject, $message, $headers);

?>
