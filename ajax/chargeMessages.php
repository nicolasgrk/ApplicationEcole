<?php
// On vérifie la méthode utilisée
session_start();


if($_SERVER['REQUEST_METHOD'] == 'GET'){
    // On est en GET
    // On vérifie si on a reçu un id
    if(isset($_GET['lastId'])){
        $formation = $_SESSION['idformation'];
        // On récupère l'id et on le nettoie
        $lastId = (int)strip_tags($_GET['lastId']);
        // On initialise le filtre
        $filtre = ($lastId > 0) ? " WHERE `message`.`id` > $lastId" : '';
        // On se connecte à la base
        require_once('../inc/bdd.php');

        // On écrit la requête
        //$sql = 'SELECT `message`.`id`, `message`.`message`, `message`.`createdAt`, `utilisateur`.`identifiant` FROM `message` LEFT JOIN `utilisateur` ON `message`.`id_utilisateur` = `utilisateur`.`id`'.$filtre.' WHERE `utilisateur`.`id_formation` ='.$formation.'  ORDER BY `message`.`id` ;';
        $sql = 'SELECT `message`.`id`, `message`.`message`, `message`.`createdAt`, `utilisateur`.`identifiant`FROM `message` LEFT JOIN `utilisateur` ON `message`.`id_utilisateur` = `utilisateur`.`id`'.$filtre.' AND  `utilisateur`.`id_formation` ='.$formation.' ORDER BY `message`.`id` DESC ;';

        // On exécute la requête
        $query = $db->query($sql);

        // On récupère les données
        $messages = $query->fetchAll();

        // On encode en JSON
        $messagesJson = json_encode($messages);

        // On envoie
        echo $messagesJson;
    }
}else{
    // Mauvaise méthode
    http_response_code(405);
    echo json_encode(['message' => 'Mauvaise méthode']);
}