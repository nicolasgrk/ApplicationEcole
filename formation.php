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
    <title>formations</title>
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
     <nav class="navbar" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="formation.php">
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
                <a href="admin.php" class="button is-light">Gestion utilisateurs</a>
                <a href="formation.php" class="button is-primary"><strong>Gestion formations</strong></a>
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
            $req_pre = $cnx->prepare("SELECT * FROM formation WHERE id = :id");
            // liaison de la variable à la requête préparée
            $req_pre->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
            $req_pre->execute();
            //le résultat est récupéré sous forme d'objet
            $formation=$req_pre->fetch(PDO::FETCH_OBJ);
?>

            <section class="section">
                <div class="container">  
                    <div class="columns is-centered">
                        <div class="column has-text-centered is-5">
                            <p>Sur cette page, vous pouvez modifier une formation.</p>
                        </div>
                    </div>
                    <article class="columns is-centered">
                        <div class="column has-text-centered is-4">
                            <form method="post" action="formation_action.php?action=modifier" class="box"> <!--Formulaire pour modifier un joueur-->
                                <input type="hidden" name="numero" value="<?php echo $formation->id; ?>" />  <!-- numéro du formation sélectionné caché -->
                                <div class="field">
                                    <div class="control">
                                        <input class="input" type="text" name="formation" id="formation" value='<?php echo utf8_encode($formation->intituleFormation); ?>' required >
                                    </div>
                                </div>

                                <input class="button is-primary" type="submit" value="Envoyer"><!--Bouton d'envoi-->
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
                            <h1 class="title">Ajouter formation</h1>    
                        </div>
                    </div>
                    <article class="columns is-centered">
                        <div class="column has-text-centered is-4">
                            <form method="post" action="formation_action.php?action=ajouter" enctype="multipart/form-data" class="box">
                                <div class="field">
                                    <label class="label">Intitulé de la formation</label>
                                    <div class="control">
                                    <input class="input"type="text" name="formation" placeholder="Nom de la formation" required>
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
            <h1 class="title is-2">Gestions des formations</h1>
        </div>
    </div>

         
<?php
        include("include/_inc_parametres.php");
        include("include/_inc_connexion.php");
        $formationEleve=$cnx->query("SELECT * from formation"); //Récupération de toute la table formation avec nom et prenom
        $formationEleve->setFetchMode(PDO::FETCH_OBJ);
?>

            <div class="columns is-centered">
                <div class="column has-text-centered is-5">
                    <p>A partir de cette page, vous pouvez ajouter, modifier ou supprimer des formations. <a href="formation.php?action=nouveau">Ajouter une formation</a> </p>
                </div>
            </div>


        <article class="columns is-centered">
        <div class="column has-text-centered is-3">
            
        <table class="table">
        <thead>
            <tr>
                <th>Intitulé</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody>
<?php 
        $prodformation=$formationEleve->fetch();
        while ($prodformation) {
?>
            <tr>
                <td><?php echo utf8_encode($prodformation->intituleFormation); ?></td>

                <td><a href='formation.php?action=modifier&id=<?php echo $prodformation->id; ?>'><img src="https://img.icons8.com/color/30/000000/edit.png"></a></td><!--Icon pour modifier une ligne du tableau-->
                <td><a href='formation_action.php?action=supprimer&id=<?php echo $prodformation->id; ?>'><img src="https://img.icons8.com/color/30/000000/delete-sign.png"></a></td><!--Icon pour supprimer une ligne du tableau-->
            </tr>
<?php 
        // lecture de la formation suivant
        $prodformation=$formationEleve->fetch(); 
        }
?>
        </tbody>
    </table>

<?php
    } 
?>
            </div>
          </article>





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