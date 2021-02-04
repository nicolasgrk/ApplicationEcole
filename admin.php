<?php
include ( "include/_inc_parametres.php");
include ( "include/_inc_connexion.php");
header( 'content-type: text/html; charset=utf-8' );
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="icon" type="image/png" href="img/logo.png" />
    <title>Utilisateurs
    </title>
    <meta charset="UTF-8">
    <meta name="description" content="...">
    <meta name="keywords" content="...">
    <meta name="author" content="Nicolas Gurak">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
    <link rel="stylesheet" href="style/style.css">
    <script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'>
    </script>
</head>
<!--head-->
<!--body-->

<body>
    <!--Header-->
    <!--body-->
 

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
            <h2>Modifier utilisateur</h2>
            <p>Sur cette page, vous pouvez modifier un utilisateur.</p>
                <div class="formulaire">                    
                    <form method="post" action="admin_action.php?action=modifier"> <!--Formulaire pour modifier un joueur-->
                      <input type="hidden" name="numero" value="<?php echo $utilisateur->id; ?>" />  <!-- numéro du Utilisateur sélectionné caché -->
                        <input class="input" type="text" name="newIdentifiant" id="identifiant" value='<?php echo utf8_encode($utilisateur->identifiant); ?>' required>
                        
                        <label id="" for="identifiant">Identifiant</label>
                        <input type="text" name="newidentifiant" value='<?php echo utf8_encode($utilisateur->identifiant); ?>' required>

                        <label id="" for="prenom">Prénom</label>
                        <input type="text" name="newprenom" value='<?php echo utf8_encode($utilisateur->prenom); ?>' required>

                        <label id="" for="nom">Nom</label>
                        <input type="text" name="newnom" value='<?php echo utf8_encode($utilisateur->nom); ?>' required>

                        <label id="" for="datedenaissance">Date de naissance</label>
                        <input type="date" name="newdatedenaissance"value='<?php echo utf8_encode($utilisateur->dateNaissance); ?>' required>

                        <label id="" for="adressemail">Email</label>
                        <input type="email" name="newadressemail" value='<?php echo utf8_encode($utilisateur->adresseMail); ?>' required>

                        <label id="" for="motdepasse">Mot de passe</label>
                        <input type="password" name="newmotdepasse"  value='<?php echo utf8_encode($utilisateur->motDePasse); ?>' required>
                        
                        <label id="" for="numerorue">N°Rue</label>
                        <input type="text" name="newnumerorue" value='<?php echo utf8_encode($utilisateur->numeroRue); ?>' required>

                        <label id="" for="rue">Rue</label>
                        <input type="text" name="newrue" value='<?php echo utf8_encode($utilisateur->rue); ?>' required>

                        <label id="" for="ville">Ville</label>
                        <input type="text" name="newville" value='<?php echo utf8_encode($utilisateur->ville); ?>' required>

                        <label id="" for="codepostale">Code Postale</label>
                        <input type="text" name="newcodepostale" value='<?php echo utf8_encode($utilisateur->codePostale); ?>' required>

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
                        <option value="">Enseignant/secrétaire/Administrateur</option>
                    </select>
                        


                        <button type="submit" value="Submit" class="myButton">Soumettre</button><!--Bouton d'envoi-->
                    </form>
                </div>
<?php
        }
        if ($_GET['action'] == 'nouveau')//Si l'action est égale à nouveau alors on continue{
        { 
?>
            <section class="section">
                <div class="container">
                    <h1 class="title">Ajouter un utilisateur</h1>
                    <form method="post" action="admin_action.php?action=ajouter" enctype="multipart/form-data">
                        <h2>Utilisateur</h2>
                        <label id="" for="identifiant">Identifiant</label>
                        <input type="text" name="identifiant" placeholder="Votre identifiant" required>

                        <label id="" for="prenom">Prénom</label>
                        <input type="text" name="prenom" placeholder="Votre prénom" required>

                        <label id="" for="nom">Nom</label>
                        <input type="text" name="nom" placeholder="Votre nom" required>

                        <label id="" for="datedenaissance">Date de naissance</label>
                        <input type="date" name="datedenaissance" placeholder="Votre date de naissance" required>

                        <label id="" for="adressemail">Email</label>
                        <input type="email" name="adressemail" placeholder="Votre email" required>

                        <label id="" for="motdepasse">Mot de passe</label>
                        <input type="password" name="motdepasse" minlength=8 placeholder="Votre mot de passe" required>
                        
                        <label id="" for="numerorue">N°Rue</label>
                        <input type="text" name="numerorue" placeholder="Numéro de rue" required>

                        <label id="" for="rue">Rue</label>
                        <input type="text" name="rue" placeholder="Nom de rue" required>

                        <label id="" for="ville">Ville</label>
                        <input type="text" name="ville" placeholder="Votre ville" required>

                        <label id="" for="codepostale">Code Postale</label>
                        <input type="text" name="codepostale" placeholder="Votre code postale" required>
                        <select name="role" required>
                            <option value="1">Administrateur</option>
                            <option value="2">Professeur</option>
                            <option value="3">BDE</option>
                            <option value="4">Elèves</option>
                            <option value="5">Secrétaire</option>
                        </select>

                        <label id="" for="idformation">Formation</label>

                        <select name=idformation>
                        <option value="">Enseignant/secrétaire/Administrateur</option>                        
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
                        <input type="submit" value="Envoyer">
                    </form>
                </div>
             </section>
<?php
        }
    }
    else
    {         
?>
        <h2>utilisateur</h2>
        

        <form method="post" action="admin.php" enctype="multipart/form-data">
         <select name="formations" id="formations">
         <option value="">Enseignant/secrétaire/Administrateur</option>
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
        <input type="submit" value="Envoyer">
    </form>

    <p>A partir de cette page, vous pouvez ajouter, modifier ou supprimer des utilisateur. <a href="admin.php?action=nouveau">Ajouter un utilisateur</a> </p>
         
<?php


        // affichage lors du clic sur Utilisateurdans la page index.php
        include("include/_inc_parametres.php");
        include("include/_inc_connexion.php");

		if ($_POST['formations'] === '') {
            $utilisateur=$cnx->query("SELECT identifiant, motDePasse, adresseMail, nom, prenom, dateNaissance, numeroRue, rue, ville, codePostale, id_formation, role,id FROM utilisateur where id_formation is null"); //Récupération de toute la table Utilisateur avec nom et prenom
            $utilisateur->setFetchMode(PDO::FETCH_OBJ);

            ?>


            <table class="table">
                <thead>
                <tr>
                        <th>Identifiant</th>
                        <th>Mot de Passe</th>
                        <th>Email</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Date de Naissance</th>
                        <th>Numéro de Rue</th>
                        <th>Rue</th>
                        <th>Ville</th>
                        <th>Code Postal</th>
                        <th>Rôle</th>
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
                        <td><?php echo utf8_encode($prodUtilisateur->identifiant); ?> </td>
                        <td><?php echo utf8_encode($prodUtilisateur->motDePasse); ?> </td>
                        <td><?php echo utf8_encode($prodUtilisateur->adresseMail); ?> </td>
                        <td><?php echo utf8_encode($prodUtilisateur->nom); ?> </td>
                        <td><?php echo utf8_encode($prodUtilisateur->prenom); ?> </td>
                        <td><?php echo utf8_encode($prodUtilisateur->dateNaissance); ?> </td>
                        <td><?php echo utf8_encode($prodUtilisateur->numeroRue); ?> </td>
                        <td><?php echo utf8_encode($prodUtilisateur->rue); ?> </td>
                        <td><?php echo utf8_encode($prodUtilisateur->ville); ?> </td>
                        <td><?php echo utf8_encode($prodUtilisateur->codePostale); ?> </td>
                        <td><?php echo utf8_encode($prodUtilisateur->role); ?> </td>
                        <td><a href='admin.php?action=modifier&id=<?php echo $prodUtilisateur->id; ?>'><img src="https://img.icons8.com/color/30/000000/edit.png"></a></td>
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
            $utilisateur=$cnx->query("SELECT identifiant, motDePasse, adresseMail, nom, prenom, dateNaissance, numeroRue, rue, ville, codePostale, id_formation, role,id FROM utilisateur where id_formation = ".$_POST['formations']); //Récupération de toute la table Utilisateur avec nom et prenom
            $utilisateur->setFetchMode(PDO::FETCH_OBJ);
            ?>


        <table class="table">
            <thead>
            <tr>
                    <th>Identifiant</th>
                    <th>Mot de Passe</th>
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
                    <td><?php echo utf8_encode($prodUtilisateur->identifiant); ?> </td>
                    <td><?php echo utf8_encode($prodUtilisateur->motDePasse); ?> </td>
                    <td><?php echo utf8_encode($prodUtilisateur->adresseMail); ?> </td>
                    <td><?php echo utf8_encode($prodUtilisateur->nom); ?> </td>
                    <td><?php echo utf8_encode($prodUtilisateur->prenom); ?> </td>
                    <td><?php echo utf8_encode($prodUtilisateur->dateNaissance); ?> </td>
                    <td><?php echo utf8_encode($prodUtilisateur->numeroRue); ?> </td>
                    <td><?php echo utf8_encode($prodUtilisateur->rue); ?> </td>
                    <td><?php echo utf8_encode($prodUtilisateur->ville); ?> </td>
                    <td><?php echo utf8_encode($prodUtilisateur->codePostale); ?> </td>
                    <td><?php echo utf8_encode($prodUtilisateur->role); ?> </td>
                    <td><?php echo utf8_encode($prodUtilisateur->id_formation); ?> </td>
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
    } 
} 
?>

        <p id=footer>Wesh le footer</p>

</body><!--Body-->
</html>