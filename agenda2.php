<?php
include ( "include/_inc_parametres.php");
include ( "include/_inc_connexion.php");
header( 'content-type: text/html; charset=utf-8' );
session_start();
if(isset($_SESSION['id'])){
    
    if ($_SESSION['role']== 5){
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="icon" type="image/png" href="img/logo.png" />
    <title>Agenda</title>
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
    <a class="navbar-item" href="information_ecole.php">
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
          <a href="information_ecole.php" class="button is-light">Gestion évenements</a>
          <a href="agenda2.php" class="button is-primary"><strong>Gestion agenda2</strong></a>
          <a href="deconnexion.php" class="button is-light">Déconnexion</a>

        </div>
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
            $req_pre = $cnx->prepare("SELECT * FROM emploiDuTemps WHERE id = :id");
            // liaison de la variable à la requête préparée
            $req_pre->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
            $req_pre->execute();
            //le résultat est récupéré sous forme d'objet
            $agenda2=$req_pre->fetch(PDO::FETCH_OBJ);
?>

            <section class="section">
                <div class="container">  
                    <div class="columns is-centered">
                        <div class="column has-text-centered is-5">
                            <p>Sur cette page, vous pouvez modifier un cours.</p>
                        </div>
                    </div>
                    <article class="columns is-centered">
                        <div class="column has-text-centered is-4">
                            <form method="post" action="agenda2_action.php?action=modifier" class="box"> <!--Formulaire pour modifier un joueur-->
                                <input type="hidden" name="numero" value="<?php echo $agenda2->id; ?>" />  <!-- numéro du agenda2 sélectionné caché -->

                                <div class="field">
                                    <label class="label">Matière</label>
                                    <div class="control">
                                    <input class="input"type="text" name="matiere" placeholder="Nom de la matière" value='<?php echo utf8_encode($agenda2->matiere); ?>'required>
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label">Salle</label>
                                    <div class="control">
                                    <input class="input" type="number" name="salle" placeholder="Salle" value='<?php echo utf8_encode($agenda2->salle); ?>'required>
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label">Date</label>
                                    <div class="control">
                                    <input class="input" type="date" name="date" placeholder="Date" value='<?php echo utf8_encode($agenda2->dates); ?>'required>
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label">Heure de début</label>
                                    <div class="control">
                                    <input class="input" type="time" name="heureDebut" placeholder="Heure de début"value='<?php echo utf8_encode($agenda2->HeureDebut); ?>' required>
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label">Heure de fin</label>
                                    <div class="control">
                                    <input class="input" type="time" name="heureFin" placeholder="Heure de fin" value='<?php echo utf8_encode($agenda2->HeureFin); ?>' required>
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
                            <h1 class="title">Ajouter cours</h1>    
                        </div>
                    </div>
                    <article class="columns is-centered">
                        <div class="column has-text-centered is-4">
                            <form method="post" action="agenda2_action.php?action=ajouter" enctype="multipart/form-data" class="box">
                                <div class="field">
                                    <label class="label">Matière</label>
                                    <div class="control">
                                    <input class="input"type="text" name="matiere" placeholder="Nom de la matière" required>
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label">Salle</label>
                                    <div class="control">
                                    <input class="input" type="number" name="salle" placeholder="Salle" required>
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label">Date</label>
                                    <div class="control">
                                    <input class="input" type="date" name="date" placeholder="Date" required>
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label">Heure de début</label>
                                    <div class="control">
                                    <input class="input" type="time" name="heureDebut" placeholder="Heure de début" required>
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label">Heure de fin</label>
                                    <div class="control">
                                    <input class="input" type="time" name="heureFin" placeholder="Heure de fin" required>
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label">Formateurs</label>
                                    <div class="select is-rounded">
                                        <select name="formateur" id="formation">
                                            <option value="">Choisir un formateurs</option>
                <?php  
                                            $reponse = $cnx->query("SELECT * FROM utilisateur where role = 2");
                                            while ($donnees = $reponse->fetch()){
                ?>
                                            <option value="<?php echo $donnees['id'];?>"><?php echo $donnees['nom'];?> <?php echo $donnees['prenom'];?></option>
                <?php
                                            }
                                            $reponse->closeCursor();
                ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label">Formations</label>
                                    <div class="select is-rounded">
                                        <select name="formation" id="formation">
                                            <option value="">Choisir une formations</option>
                <?php  
                                            $reponse = $cnx->query("SELECT * FROM formation");
                                            while ($donnees = $reponse->fetch()){
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
            <h1 class="title is-2">Agenda</h1>
        </div>
    </div>
    <div class="columns is-centered">
        <div class="column has-text-centered is-5">
            <div class="select">
                <form method="post" action="agenda2.php" enctype="multipart/form-data">
                <select name="formations" id="formations" onChange="this.form.submit();">
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
                <noscript><input type="submit" value="Envoyer" /></noscript>

                </form>
            </div>

        </div>
    </div>

<?php
            if(isset($_POST['formations'])){
                            // affichage lors du clic sur agenda2dans la page index.php
        include("include/_inc_parametres.php");
        include("include/_inc_connexion.php");
        $agenda2Eleve=$cnx->query("SELECT * FROM emploiDuTemps where formation = ".$_POST['formations']); //Récupération de toute la table agenda2 avec nom et prenom
        $agenda2Eleve->setFetchMode(PDO::FETCH_OBJ);
?>

            <div class="columns is-centered">
                <div class="column has-text-centered is-7">
                    <p>A partir de cette page, vous pouvez ajouter, modifier ou supprimer des cours. <a href="agenda2.php?action=nouveau&id=<?php echo $_POST['formations']; ?>">Ajouter un cours</a> </p>
                </div>
            </div>


        <article class="columns is-centered">
        <div class="column has-text-centered is-6">
            
        <table class="table is-fullwidth" >
        <thead>
            <tr>
                <th>Matière</th>
                <th>Salle</th>
                <th>Date</th>
                <th>Heure Début</th>
                <th>Heure Fin</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody>
<?php 
        $prodagenda2=$agenda2Eleve->fetch();
        while ($prodagenda2) {
?>
            <tr>
                <td><?php echo utf8_encode($prodagenda2->matiere); ?></td>
                <td><?php echo utf8_encode($prodagenda2->salle); ?></td>
                <td><?php echo utf8_encode($prodagenda2->dates); ?></td>
                <td><?php echo utf8_encode($prodagenda2->HeureDebut); ?></td>
                <td><?php echo utf8_encode($prodagenda2->HeureFin); ?></td>
                <td><a href='agenda2.php?action=modifier&id=<?php echo $prodagenda2->id; ?>'><img src="https://img.icons8.com/color/30/000000/edit.png"></a></td><!--Icon pour modifier une ligne du tableau-->
                <td><a href='agenda2_action.php?action=supprimer&id=<?php echo $prodagenda2->id; ?>'><img src="https://img.icons8.com/color/30/000000/delete-sign.png"></a></td><!--Icon pour supprimer une ligne du tableau-->
            </tr>
<?php 
        // lecture de la agenda2 suivant
        $prodagenda2=$agenda2Eleve->fetch(); 
        }
?>
        </tbody>
    </table>
    <?php
            }else{
                ?>


            <div class="columns is-centered">
                <div class="column has-text-centered is-5">
                    <p>A partir de cette page, vous pouvez ajouter, modifier ou supprimer des cours.</p>
                </div>
            </div>
                <section class="section">
                <div class="container">               
                    <div class="columns is-centered">
                        <div class="column has-text-centered is-5">
                            <p class="title is-4">Veuillez choisir une formation</p>    
                        </div>
                    </div>
                <?php
            }

?>

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