<?php
include ( "include/_inc_parametres.php");
include ( "include/_inc_connexion.php");
header( 'content-type: text/html; charset=utf-8' );
session_start();
if(isset($_SESSION['id'])){
    if ($_SESSION['role']== 1){

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="icon" type="image/png" href="img/logo.png" />
    <title>Administrateur
    </title>
    <meta charset="UTF-8">
    <meta name="description" content="...">
    <meta name="keywords" content="...">
    <meta name="author" content="Mahé Louis">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
    <link rel="stylesheet" href="style/style.css">
    <script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'>
    </script>
    <style type="text/css">

    </style>
</head>
<!--head-->
<!--body-->

<body>
    <!--Header-->
    <!--body-->
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="admin.php">
            <img src="img/logo.png" >
            </a>

            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            </a>
        </div>

        <div class="navbar-end">
            <div class="navbar-item">
                <div class="buttons">
                    <a href="admin.php" class="button is-primary">Gestion utilisateurs</a>
                    <a href="formation.php" class="button is-light"><strong>Gestion formations</strong></a>
                    <a href="deconnexion.php" class="button is-light">Déconnexion</a>
                </div>
            </div>
        </div>
    </nav>
 

<?php
    if (isset ($_GET['action'])) //Si on récupère "action on exécute la suite
    {
    if ($_GET['action'] == 'modifier') //Si l'action est égale a modifier on continue d'executer
        { 
            include("include/_inc_parametres.php");
            include("include/_inc_connexion.php");
            // préparation de la requête : recherche d'un élèves particulier
            $req_pre = $cnx->prepare("SELECT * FROM utilisateur WHERE id = :id");
            // liaison de la variable à la requête préparée
            $req_pre->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
            $req_pre->execute();
            //le résultat est récupéré sous forme d'objet
            $utilisateur=$req_pre->fetch(PDO::FETCH_OBJ);
?>
            <section class="section">
                <div class="container">  
                    <div class="columns is-centered">
                    <div class="column has-text-centered is-5">
                            <h1 class="title">Modifer un utilisateur</h1>    
                        </div>
                    </div>
                    <article class="columns is-centered">
                        <div class="column has-text-centered is-4">               
                            <form method="post" action="admin_action.php?action=modifier" class="box"> <!--Formulaire pour modifier un joueur-->
                                <input type="hidden" name="numero" value="<?php echo $utilisateur->id; ?>" />  <!-- numéro du Utilisateur sélectionné caché -->
                                <div class="field">
                                    <div class="control">
                                        <input class="input" class="input" type="text" name="newIdentifiant" id="identifiant" value='<?php echo $utilisateur->identifiant; ?>' required>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="control">                                
                                        <input class="input" type="text" name="newprenom" value='<?php echo $utilisateur->prenom; ?>' placeholder="Prénom" required>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="control"> 
                                        <input class="input" type="text" name="newnom" value='<?php echo $utilisateur->nom; ?>' placeholder="Nom"required>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="control"> 
                                        <input class="input" type="date" name="newdatedenaissance"value='<?php echo $utilisateur->dateNaissance; ?>' placeholder="Date de naissance" required>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="control"> 
                                        <input class="input" type="email" name="newadressemail" value='<?php echo $utilisateur->adresseMail; ?>' placeholder="Adresse mail"required>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="control">                                         
                                        <input class="input" type="number" name="newnumerorue" value='<?php echo $utilisateur->numeroRue; ?>' placeholder="Numéro de rue" required>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="control"> 
                                        <input class="input" type="text" name="newrue" value='<?php echo $utilisateur->rue; ?>'placeholder="Rue" required>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="control"> 
                                        <input class="input" type="text" name="newville" value='<?php echo $utilisateur->ville; ?>' placeholder="Ville"required>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="control"> 
                                        <input class="input" type="number" name="newcodepostale" value='<?php echo $utilisateur->codePostale; ?>' placeholder="Code postale"required>
                                        </div>
                                </div>
                                <div class="field">
                                    <label class="label">Statut</label>
                                    <div class="select is-rounded">
                                        <select name="newrole"  required>
                                            <?php if($utilisateur->role == 1){?>
                                                    <option value="1">Administrateur</option>
                                                    <option value="2">Professeur</option>
                                                    <option value="3">BDE</option>
                                                    <option value="4">Elèves</option>
                                                    <option value="5">Secrétaire</option>
                                                <?php

                                            }elseif($utilisateur->role == 2){

                                                ?>

                                                    <option value="2">Professeur</option>
                                                    <option value="1">Administrateur</option>
                                                    <option value="3">BDE</option>
                                                    <option value="4">Elèves</option>
                                                    <option value="5">Secrétaire</option>
                                                <?php

                                            }elseif($utilisateur->role == 3){
                                                
                                                ?>
                                                    <option value="3">BDE</option>
                                                    <option value="2">Professeur</option>
                                                    <option value="1">Administrateur</option>
                                                    <option value="4">Elèves</option>
                                                    <option value="5">Secrétaire</option>
                                                <?php
                                                
                                            }elseif($utilisateur->role == 4){
                                                ?>
                                                    <option value="4">Elèves</option>
                                                    <option value="3">BDE</option>
                                                    <option value="2">Professeur</option>
                                                    <option value="1">Administrateur</option>
                                                    <option value="5">Secrétaire</option>
                                                <?php
                                                
                                            }elseif($utilisateur->role == 5){
                                                ?>
                                                    <option value="5">Secrétaire</option>
                                                    <option value="4">Elèves</option>
                                                    <option value="3">BDE</option>
                                                    <option value="2">Professeur</option>
                                                    <option value="1">Administrateur</option>
                                                <?php
                                            }
                                            
                                            
                                            ?>
                                        </select>
                                        </div>
                                </div>
                                <div class="field">
                                    <label class="label">Role</label>
                                    <div class="select is-rounded">
                                        <select name=newidformation required>
                                            <option value=""> Choisir une formation</option>
                                                <?php
                                                $reponse = $cnx->query("SELECT * FROM formation");
                                                while ($donnees=$reponse->fetch()){
                                                ?>
                                                <option value="<?php echo $donnees['id'];?>"><?php echo $donnees['intituleFormation'];?></option>
                                                <?php
                                                }
                                                $reponse->closeCursor();
                                                ?>
                                        </select>
                                    </div>
                                </div>
                                <input class="button is-primary" type="submit" value="Envoyer">
                            </form>
                        </div>
                    </article>
                </div>
            </section>
<?php
        }
        if ($_GET['action'] == 'nouveau')//Si l'action est égale à nouveau alors on continue{
        { 
?>
            <section class="section">
                <div class="container">
                    <div class="columns is-centered">
                        <div class="column has-text-centered is-5">
                            <h1 class="title">Ajouter un utilisateur</h1>    
                        </div>
                    </div>
                    <article class="columns is-centered">
                        <div class="column has-text-centered is-4">
                            <form method="post" action="admin_action.php?action=ajouter" enctype="multipart/form-data" class="box">
                                <div class="field">
                                    <label id="" for="prenom">Prénom</label>
                                    <input class="input" type="text" name="prenom" placeholder="Votre prénom"  required>
                                </div>
                                <div class="field">
                                    <label id="" for="nom">Nom</label>
                                    <input class="input" type="text" name="nom" placeholder="Votre nom" required>
                                </div>
                                <div class="field">
                                    <label id="" for="datedenaissance">Date de naissance</label>
                                    <input class="input" type="date" name="datedenaissance" placeholder="Votre date de naissance" required>
                                </div>
                                <div class="field">
                                    <label id="" for="adressemail">Email</label>
                                    <input class="input" type="email" name="adressemail" placeholder="Votre email" required>
                                </div>
                                <div class="field">
                                    <label id="" for="numerorue">N°Rue</label>
                                    <input class="input" type="number" name="numerorue" placeholder="Numéro de rue" required>
                                </div>
                                    <div class="field">
                                    <label id="" for="rue">Rue</label>
                                <input class="input" type="text" name="rue" placeholder="Nom de rue" required>
                                </div>
                                <div class="field">
                                    <label id="" for="ville">Ville</label>
                                    <input class="input" type="text" name="ville" placeholder="Votre ville" required>
                                </div>
                                <div class="field">
                                    <label id="" for="codepostale">Code Postale</label>
                                    <input class="input" type="number" name="codepostale" placeholder="Votre code postale"  required>
                                </div>
                                <div class="field">
                                    <div class="select is-rounded">
                                        <select name="role" required>
                                        <option value="">Choisir statut</option>
                                            <option value="1">Administrateur</option>
                                            <option value="2">Professeur</option>
                                            <option value="3">BDE</option>
                                            <option value="4">Elèves</option>
                                            <option value="5">Secrétaire</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="select is-rounded">
                                        <select name=idformation required>           
                                        <option value="">Choisir formation</option>           
                                            <?php
                                                $reponse = $cnx->query("SELECT * FROM formation");
                                                while ($donnees=$reponse->fetch()){
                                                    ?>
                                                    <option value="<?php echo $donnees['id'];?>"><?php echo $donnees['intituleFormation'];?></option>
                                                    <?php
                                                }
                                                $reponse->closeCursor();
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <input class="button is-primary" type="submit" value="Envoyer">
                            </form>
                        </div>
                    </article>
                </div>
             </section>
<?php
        }
    }
    else
    {         
?>
    <div class="columns is-centered">
        <div class="column has-text-centered is-5">
            <h1 class="title is-2">Administration</h1>
        </div>
    </div>  
     <div class="columns is-centered">
        <div class="column has-text-centered is-5">
            <div class="select">
                <form method="post" action="admin.php" enctype="multipart/form-data">
                    <select name="formations" id="formations" onChange="this.form.submit();">
                    <option value="">Veuillez choisir une formation</option>
            <?php 
                        $reponse = $cnx->query('SELECT id, intituleFormation FROM formation');
                        while ($donnees = $reponse->fetch()){
            ?>
                        <option value="<?php echo $donnees['id'];?>"><?php echo $donnees['intituleFormation'];?></option>
            <?php         $idFormation=  $donnees['id'];

                        }
                        $reponse->closeCursor();
            ?>


                    </select>
                    <noscript><input type="submit" value="Envoyer" /></noscript>
                </form>
            </div>
            <p>A partir de cette page, vous pouvez ajouter, modifier ou supprimer des utilisateur. <a href="admin.php?action=nouveau">Ajouter un utilisateur</a> </p>
        </div>
    </div>
<?php

if(isset($_POST['formations'])){
        // affichage lors du clic sur Utilisateur dans la page index.php
        include("include/_inc_parametres.php");
        include("include/_inc_connexion.php");

            $utilisateur=$cnx->query("SELECT identifiant, motDePasse, adresseMail, nom, prenom, dateNaissance, numeroRue, rue, ville, codePostale, id_formation, role,id FROM utilisateur where id_formation = ".$_POST['formations']); //Récupération de toute la table Utilisateur avec nom et prenom
            $utilisateur->setFetchMode(PDO::FETCH_OBJ);
            ?>


        <table class="table">
            <thead>
            <tr>
                    <th>Identifiant</th>
                    <th>Email</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Date de Naissance</th>
                    <th>Numéro de Rue</th>
                    <th>Rue</th>
                    <th>Ville</th>
                    <th>Code Postal</th>
                    <th>Rôle</th>
                    <th>ID</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody>
<?php 
            $prodUtilisateur=$utilisateur->fetch();
            while ($prodUtilisateur) {
?>
                <tr>
                    <td><?php echo $prodUtilisateur->identifiant; ?> </td>
                    <td><?php echo $prodUtilisateur->adresseMail; ?> </td>
                    <td><?php echo $prodUtilisateur->nom; ?> </td>
                    <td><?php echo $prodUtilisateur->prenom; ?> </td>
                    <td><?php echo $prodUtilisateur->dateNaissance; ?> </td>
                    <td><?php echo $prodUtilisateur->numeroRue; ?> </td>
                    <td><?php echo $prodUtilisateur->rue; ?> </td>
                    <td><?php echo $prodUtilisateur->ville; ?> </td>
                    <td><?php echo $prodUtilisateur->codePostale; ?> </td>
                    <td><?php echo $prodUtilisateur->role; ?> </td>
                    <td><?php echo $prodUtilisateur->id_formation; ?> </td>
                    <td><a href='admin.php?action=modifier&id=<?php echo $prodUtilisateur->id; ?>&idForm=<?php echo $prodUtilisateur->id_formation; ?>'><img src="https://img.icons8.com/color/30/000000/edit.png"></a></td>
                    <!--Icon pour modifier une ligne du tableau-->
                    <td><a href='admin_action.php?action=supprimer&id=<?php echo $prodUtilisateur->id; ?>'><img src="https://img.icons8.com/color/30/000000/delete-sign.png"></span></a></td>
                    <!--Icon pour supprimer une ligne du tableau-->
                </tr>
 <?php 
            // lecture de la Utilisateur suivant
            $prodUtilisateur=$utilisateur->fetch(); 
            }
?>
            </tbody>
        </table>
<?php

    
}else{
    ?>
    <section class="section">
    <div class="container">               
        <div class="columns is-centered">
            <div class="column has-text-centered is-5">
                <p class="title is-4">Veuillez choisir une formation</p>    
            </div>
        </div>
    <?php
}
} 
?>


</body><!--Body-->
</html>
<?php
    }else{

    echo "vous n'avez pas le droit d'etre la ";
    
    }
}else{

echo "impossible car pas co";

}
?>