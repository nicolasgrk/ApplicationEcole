<?php
include("include/_inc_parametres.php");
include("include/_inc_connexion.php");



if(isset($_POST['cnxId']) && isset($_POST['cnxMotdepasse']))
{
    /*il faut que tous les champs soient renseignes*/
    if($_POST['cnxId']!="" && $_POST['cnxMotdepasse']!="")
    {
        /*on crypte le mot de passe pour faire le test*/
        $mdphache = $_POST['cnxMotdepasse']; //md5($_POST['cnxMotdepasse']);


        
        include("include/_inc_parametres.php");
        include("include/_inc_connexion.php");
        /* on verifie qu'un membre a bien cet email et ce mot de passe*/
        $req = $cnx->prepare('SELECT * FROM utilisateur WHERE identifiant = :identifiant');
        $req->execute(array('identifiant'=> $_POST['cnxId']));
        //$req->bindValue(':identifiant', $_POST['cnxId'], PDO::PARAM_INT);
        //$req->bindValue(':motDePasse', $_POST['cnxMotdepasse'], PDO::PARAM_INT);
        $resultat=$req->fetch();

        /*s'il n'y a pas de resultat, on renvoie a la page de connexion*/
        if(!$resultat || password_verify($mdphache, $resultat['motDePasse'])== false)
        {
            header('refresh:1; url=connexion.php');
            ?>
            <div class="alert alert-danger">
                <strong>Erreur :</strong> Mauvais mdp ou identifiant!
            </div>
            <?php
        }
        else
        {

            session_start();
        /* on cree les variables de session du membre qui lui serviront pendant sa session*/
            $_SESSION['id']= $resultat['id'];
            $_SESSION['identifiant']= $resultat['identifiant'];
            $_SESSION['adressemail']= $resultat['adresseMail'];
            $_SESSION['prenom']= $resultat['prenom'];
            $_SESSION['nom']= $resultat['nom'];
            $_SESSION['datedenaissance']= $resultat['dateNaissance'];
            $_SESSION['numerorue']= $resultat['numeroRue'];
            $_SESSION['rue']= $resultat['rue'];
            $_SESSION['ville']= $resultat['ville'];
            $_SESSION['codepostale']= $resultat['codePostale'];
            $_SESSION['idformation']= $resultat['id_formation'];
            $_SESSION['role']= $resultat['role'];

            if($resultat['role'] == 1)
                header('refresh:1; url=admin.php');
            elseif ($resultat['role'] == 2)
                header('refresh:1; url=note.php');
            elseif ($resultat['role'] == 3)
                header('refresh:1; url=eleve_bde.php');
            elseif ($resultat['role'] == 4)
                header('refresh:1; url=eleve.php');
            elseif ($resultat['role'] == 5)
                header('refresh:1; url=information_ecole.php');

            ?>
                <div class="alert alert-success">
                    <strong>Succès :</strong> Vous êtes à présent connecté !
                </div>
            <?php
            $req->closeCursor();
        }
    }
    else {
            header('refresh:1; url=connexion.php');
            //ob_flush();
        ?>
        <div class="alert alert-danger">
            <strong>Erreur :</strong> Il faut remplir tous les champs !
        </div>
        <?php
    }
}
else
{
    header('refresh:1; url=connexion.php');
    //ob_flush();
    ?>
    <div class="alert alert-danger">
        <strong>Erreur :</strong> Une erreur s'est produite !
    </div>
    <?php
}
?>