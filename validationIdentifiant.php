<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Page Administrateur</title>
    </head>
    <body>
        <?php
            //connexion à la base de données en PDO
            try
            {
            // On se connecte à MySQL
                $bdd = new PDO('mysql:host=localhost;dbname=appli_ecole;charset=utf8', 'root', 'root');
            }
            catch(Exception $e)
            {
            // En cas d'erreur, on affiche un message et on arrête tout
                die('Erreur : '.$e->getMessage());
            }

            // préparation de la requête : recherche d'un stage particulier
            $req_pre = $cnx->prepare("INSERT INTO utilisateur (identifiant, motDePasse, adresseMail, nom, prenom, dateNaissance, numeroRue, rue, ville, codePostale) 
            VALUES (:identifiant, :motdepasse, :adressemail, :nom, :prenom, :numerorue, :rue, :ville, :codepostale)");
            // liaison de la variable à la requête préparée
            $req_pre->bindValue(':identifiant', $_POST['identifiant']), PDO::PARAM_STR);
            $req_pre->bindValue(':motdepasse', $passwordHash, PDO::PARAM_STR);
            $req_pre->bindValue(':adressemail', $_POST['adresseMail'], PDO::PARAM_STR);
            $req_pre->bindValue(':nom', $_POST['nom'], PDO::PARAM_STR);
            $req_pre->bindValue(':prenom', $_POST['prenom'], PDO::PARAM_STR);
            $req_pre->bindValue(':numerorue', $_POST['numeroRue'], PDO::PARAM_STR);
            $req_pre->bindValue(':rue', $_POST['rue'], PDO::PARAM_STR);
            $req_pre->bindValue(':ville', $_POST['ville'], PDO::PARAM_STR);
            $req_pre->bindValue(':codePostale', $_POST['codePostale'], PDO::PARAM_STR);

            $req_pre->execute();

        ?>
    </body>
</html>