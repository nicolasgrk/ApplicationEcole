<?php
// ce fichier est destiné à être inclus dans les pages PHP qui ont besoin de se connecter à une base de données
// 3 possibilités pour inclure ce fichier :
//     include_once ('_inc_parametres.php');
//     require_once ('_inc_parametres.php');
//     include ( "include/_inc_parametres.php");


// connexion de l'application cliente au SGBD MySQL en local
$HOTE = "localhost";	// nom du serveur de données : localhost ou serv-wamp1 ou serv-wamp1
$PORT = '3306';			// numéro du port
$USER = "root";			// nom de l'utilisateur
$PWD  = "root";		// son mot de passe
$BDD  = "appli_ecole";	// nom de la base de données
?>
