<?php
include ( "include/_inc_parametres.php");
include ( "include/_inc_connexion.php");
header( 'content-type: text/html; charset=utf-8' );
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="icon" type="image/png" href="img/logo.png" />
    <title>Informations de l'école
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
            $req_pre = $cnx->prepare("SELECT * FROM infoEcole WHERE id = :id");
            // liaison de la variable à la requête préparée
            $req_pre->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
            $req_pre->execute();
            //le résultat est récupéré sous forme d'objet
            $info=$req_pre->fetch(PDO::FETCH_OBJ);
?>
            <h2>Note</h2>
            <p>Sur cette page, vous pouvez modifier joueur.</p>
                <div class="formulaire">                    
                    <form method="post" action="information_ecole_action.php?action=modifier"> <!--Formulaire pour modifier un joueur-->
                      <input type="hidden" name="numero" value="<?php echo $info->id; ?>" />  <!-- numéro du note sélectionné caché -->
                        <input class="input" type="text" name="newName" id="evenement" value='<?php echo utf8_encode($info->intituleEvenement); ?>' required >
                        <input class="input" type="date"  name="newDate" id="date" value='<?php echo $info->date; ?>' required> 
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
                    <h1 class="title">Ajouter une information</h1>
                    <form method="post" action="information_ecole_action.php?action=ajouter" enctype="multipart/form-data">
                        <h2>Informations école</h2>
                        <label id="nomEvenement" for="evenement">Intitulé de l'évenement</label>
                        <input type="text" name="nomEvenement" placeholder="Intitulé de l'évenement" required>
                        <label id="date" for="date">Date</label>
                        <input type="date" name="date" required>
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
        <h2>Information école </h2>
        

    <p>A partir de cette page, vous pouvez ajouter, modifier ou supprimer les informations de l'ecole. <a href="information_ecole.php?action=nouveau">Ajouter une information</a> </p>
         
<?php


        // affichage lors du clic sur notedans la page index.php
        include("include/_inc_parametres.php");
        include("include/_inc_connexion.php");
        $infoEcole=$cnx->query("SELECT * FROM infoEcole "); //Récupération de toute la table note avec nom et prenom
        $infoEcole->setFetchMode(PDO::FETCH_OBJ);
?>


        <table class="table">
            <thead>
                <tr>
                    <th>Nom de l'information</th>
                    <th>Date</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody>
<?php 
            $prodInfo=$infoEcole->fetch();
            while ($prodInfo) {
?>
                <tr>
                    <td><?php echo utf8_encode($prodInfo->intituleEvenement); ?></td>
                    <td><?php echo utf8_encode($prodInfo->date); ?></td>
                    <td><a href='information_ecole.php?action=modifier&id=<?php echo $prodInfo->id; ?>'><img src="https://img.icons8.com/color/30/000000/edit.png"></a></td><!--Icon pour modifier une ligne du tableau-->
                    <td><a href='information_ecole_action.php?action=supprimer&id=<?php echo $prodInfo->id; ?>'><img src="https://img.icons8.com/color/30/000000/delete-sign.png"></a></td><!--Icon pour supprimer une ligne du tableau-->
                </tr>
 <?php 
            // lecture de la note suivant
            $prodInfo=$infoEcole->fetch(); 
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