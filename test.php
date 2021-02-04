<?php
include ( "include/_inc_parametres.php");
include ( "include/_inc_connexion.php");
header( 'content-type: text/html; charset=utf-8' );
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="icon" type="image/png" href="img/logo.png" />
    <title>Notes
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
            $req_pre = $cnx->prepare("SELECT * FROM note WHERE id = :id");
            // liaison de la variable à la requête préparée
            $req_pre->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
            $req_pre->execute();
            //le résultat est récupéré sous forme d'objet
            $note=$req_pre->fetch(PDO::FETCH_OBJ);
?>
            <h2>Note</h2>
            <p>Sur cette page, vous pouvez modifier joueur.</p>
                <div class="formulaire">                    
                    <form method="post" action="note_action.php?action=modifier"> <!--Formulaire pour modifier un joueur-->
                      <input type="hidden" name="numero" value="<?php echo $note->id; ?>" />  <!-- numéro du note sélectionné caché -->
                        <input class="input" type="text" name="newmatiere" id="matiere" value='<?php echo utf8_encode($note->matiere); ?>' required readonly>
                        <input class="input" type="text" placeholder="Note" name="newNote" id="newNote" value='<?php echo utf8_encode($note->note); ?>' required> 
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
                    <h1 class="title">Ajouter note</h1>
                    <form method="post" action="note_action.php?action=ajouter" enctype="multipart/form-data">
                        <h2>Note</h2>
                        <label id="matiere" for="matiere">Matière</label>
                        <input type="text" name="matiere" placeholder="Nom de la matière" required>
                        <label id="note" for="Note">Note</label>
                        <input type="number" name="note" placeholder="Note" required>
                        <label id="utilisateur" for="utilisateur">étudiant</label>
                         <select name="utilisateur" id="utilisateur">
                            <option value="">Choisir un étudiant</option>
<?php       var_dump($_GET['id']);
                            $reponse = $cnx->query("SELECT nom, prenom, id FROM utilisateur where utilisateur.id_formation = ".$_GET['id']);
                            while ($donnees = $reponse->fetch()){
?>
                            <option value="<?php echo $donnees['id'];?>"><?php echo $donnees['nom'];?> <?php echo $donnees['prenom'];?></option>
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
        <h2>Note</h2>
        

        <form method="post" action="test.php" enctype="multipart/form-data">
         <select name="formations" id="formations">
            <option value="">Choisir une formations</option>
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

    <p>A partir de cette page, vous pouvez ajouter, modifier ou supprimer des utilisateur. <a href="test.php?action=nouveau&id=<?php echo $_POST['formations']; ?>">Ajouter un utilisateur</a> </p>
         
<?php


        // affichage lors du clic sur notedans la page index.php
        include("include/_inc_parametres.php");
        include("include/_inc_connexion.php");
        $utilisateur=$cnx->query("SELECT identifiant, motDePasse, adresseMail, nom, prenom, dateNaissance, numeroRue, rue, ville, codePostale, id_formation, role,id FROM utilisateur where id_formation = ".$_POST['formations']); //Récupération de toute la table note avec nom et prenom
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
                    <td><a href='test.php?action=modifier&id=<?php echo $prodUtilisateur->id; ?>'><img src="https://img.icons8.com/color/30/000000/edit.png"></a></td>
                    <!--Icon pour modifier une ligne du tableau-->
                    <td><a href='test_action.php?action=supprimer&id=<?php echo $prodUtilisateur->id; ?>'><img src="https://img.icons8.com/color/30/000000/delete-sign.png"></span></a></td>
                    <!--Icon pour supprimer une ligne du tableau-->
                </tr>
 <?php 
            // lecture de la note suivant
            $prodUtilisateur=$utilisateur->fetch(); 
            }
?>
            </tbody>
        </table>
<?php
    } 
?>

        <p id=footer>Wesh le footer</p>

</body><!--Body-->
</html>