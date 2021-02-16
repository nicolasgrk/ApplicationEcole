<?php include('../include/head.php'); ?>
<?php include('../include/menu.php'); ?>
<div class="container">
    <?php
    if (empty($_SESSION['numMembre'])) //les membres connectes ne peuvent pas s'inscrire
    {
        /* il faut que toutes les variables du formulaire existent*/
        if(isset($_POST['identifiant']) && isset($_POST['mdp']))
        {
            /*il faut que tous les champs soient renseignes*/
            if($_POST['identifiant']!="" && $_POST['mdp']!="")
            {
                /*on crypte le mot de passe pour faire le test*/
                $mdphache = md5($_POST['mdp']);

                include("../include/_inc_parametres.php");
			          include("../include/_inc_connexion.php");
                /* on verifie qu'un membre a bien cet email et ce mot de passe*/
                $req = $cnx->prepare('SELECT * FROM membre WHERE identifiant = :identifiant AND mdp= :mdp ');
                $req->execute(array('identifiant'=> $_POST['identifiant'], 'mdp'=> $mdphache));
                $resultat=$req->fetch();

                /*s'il n'y a pas de resultat, on renvoie a la page de connexion*/
                if(!$resultat)
                {
                    ?>
                    <div class="alert alert-danger">
                        <strong>Erreur :</strong> Une erreur s'est produite !
                    </div>
                    <?php
                }
                else
                {
                    $_SESSION['numMembre']= $resultat['numMembre'];
                    $_SESSION['identifiant']= $resultat['identifiant'];
                    $_SESSION['email']= $resultat['email'];
                    $_SESSION['prenom']= $resultat['prenom'];
                    $_SESSION['nom']= $resultat['nom'];
                    if($resultat['numPrivilege'] == 0)
                    header('refresh:5; url=eleve.php');
                    elseif ($resultat['numPrivilege'] == 1)
                    header('refresh:5; url=prof.php');
                    elseif ($resultat['numPrivilege'] == 2)
                    header('refresh:5; url=admin.php');
                    /* on cree les variables de session du membre qui lui serviront pendant sa session*/


                    ob_flush();
                    ?>
                        <div class="alert alert-success">
                            <strong>Succès :</strong> Vous êtes à présent connecté !
                        </div>
                    <?php
                    $req->closeCursor();
                }
            }
            else {
                    header('refresh:5; url=login.php');
                    ob_flush();
                ?>
                <div class="alert alert-danger">
                    <strong>Erreur :</strong> Il faut remplir tous les champs !
                </div>
                <?php
            }
        }
        else
        {
            header('refresh:5; url=login.php');
            ob_flush();
            ?>
            <div class="alert alert-danger">
                <strong>Erreur :</strong> Une erreur s'est produite !
            </div>
            <?php
        }
    } else {
        ?>
        <div class="alert alert-danger">
            <strong>Erreur :</strong> Vous êtes déjà connecté !
        </div>
        <?php
    } ?>
</div> <!-- /container -->
<?php include('../include/footer.php'); ?>
