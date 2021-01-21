<?php 
              //connexion à la base de données en PDO
              try{
                // On se connecte à MySQL
                $bdd = new PDO('mysql:host=localhost;dbname=appli_ecole', 'root', 'root');
              }
              catch(Exception $e){
                // En cas d'erreur, on affiche un message et on arrête tout
                die('Erreur : '.$e->getMessage());
              }





$req = $bdd->prepare('INSERT INTO note(matiere, note, id_utilisateur) VALUES(:matiere, :note, :id_utilisateur)');
$req->execute(array(
	'matiere' => $_POST['matiere'],
	'note' => $_POST['note'],
	'id_utilisateur' => $_POST['utilisateur'],

	));

echo 'Ntm';



?>