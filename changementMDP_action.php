<?php 
include("include/_inc_parametres.php");
include("include/_inc_connexion.php");
session_start();

$id =$_SESSION['id'];

if($_POST['mdp1'] === $_POST['mdp2']){
    $mdp = password_hash($_POST['mdp1'], PASSWORD_BCRYPT);

    $cnx->exec('UPDATE utilisateur set motDePasse = "'.$mdp.'" where id='.$id);

    header('refresh:1; url=index.php');
               
            

}else{

    echo "Les mots de passes sont differents";
}






?>
