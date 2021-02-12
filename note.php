<?php
include ( "include/_inc_parametres.php");
include ( "include/_inc_connexion.php");
header( 'content-type: text/html; charset=utf-8' );
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="icon" type="image/png" href="img/logo.png" />
    <title>Notes</title>
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
    <a class="navbar-item" href="note.php">
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
          <a href="note.php" class="button is-primary"><strong>Gestion note</strong></a>
          <a href="agenda.php" class="button is-light">Gestion agenda</a>
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
            $req_pre = $cnx->prepare("SELECT * FROM note WHERE id = :id");
            // liaison de la variable à la requête préparée
            $req_pre->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
            $req_pre->execute();
            //le résultat est récupéré sous forme d'objet
            $note=$req_pre->fetch(PDO::FETCH_OBJ);
?>

            <section class="section">
                <div class="container">  
                    <div class="columns is-centered">
                        <div class="column has-text-centered is-5">
                            <p>Sur cette page, vous pouvez modifier une note.</p>
                        </div>
                    </div>
                    <article class="columns is-centered">
                        <div class="column has-text-centered is-4">
                            <form method="post" action="note_action.php?action=modifier" class="box"> <!--Formulaire pour modifier un joueur-->
                                <input type="hidden" name="numero" value="<?php echo $note->id; ?>" />  <!-- numéro du note sélectionné caché -->
                                <div class="field">
                                    <div class="control">
                                        <input class="input" type="text" name="newmatiere" id="matiere" value='<?php echo utf8_encode($note->matiere); ?>' required readonly>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="control">
                                        <input class="input" type="text" placeholder="Note" name="newNote" id="newNote" value='<?php echo utf8_encode($note->note); ?>' required> 
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
                            <h1 class="title">Ajouter note</h1>    
                        </div>
                    </div>
                    <article class="columns is-centered">
                        <div class="column has-text-centered is-4">
                            <form method="post" action="note_action.php?action=ajouter" enctype="multipart/form-data" class="box">
                                <div class="field">
                                    <label class="label">Matière</label>
                                    <div class="control">
                                    <input class="input"type="text" name="matiere" placeholder="Nom de la matière" required>
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label">Note</label>
                                    <div class="control">
                                    <input class="input" type="number" name="note" placeholder="Note" required>
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label">Étudiant</label>
                                    <div class="select is-rounded">
                                        <select name="utilisateur" id="utilisateur">
                                            <option value="">Choisir un étudiant</option>
                <?php  
                                            $reponse = $cnx->query("SELECT nom, prenom, id FROM utilisateur where utilisateur.id_formation = ".$_GET['id']);
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
            <div class="select">
                <form method="post" action="note.php" enctype="multipart/form-data">
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
                            // affichage lors du clic sur notedans la page index.php
        include("include/_inc_parametres.php");
        include("include/_inc_connexion.php");
        $noteEleve=$cnx->query("SELECT utilisateur.nom, utilisateur.prenom, matiere, note, utilisateur.id as idUtili, note.id as idNote FROM note, utilisateur where note.id_utilisateur = utilisateur.id and utilisateur.id_formation = ".$_POST['formations']); //Récupération de toute la table note avec nom et prenom
        $noteEleve->setFetchMode(PDO::FETCH_OBJ);
?>

            <div class="columns is-centered">
                <div class="column has-text-centered is-5">
                    <p>A partir de cette page, vous pouvez ajouter, modifier ou supprimer des notes. <a href="note.php?action=nouveau&id=<?php echo $_POST['formations']; ?>">Ajouter une note</a> </p>
                </div>
            </div>


        <article class="columns is-centered">
        <div class="column has-text-centered is-4">
            
        <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Matière</th>
                <th>Note</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody>
<?php 
        $prodNote=$noteEleve->fetch();
        while ($prodNote) {
?>
            <tr>
                <td><?php echo utf8_encode($prodNote->nom); ?></td>
                <td><?php echo utf8_encode($prodNote->prenom); ?></td>
                <td><?php echo utf8_encode($prodNote->matiere); ?></td>
                <td><?php echo utf8_encode($prodNote->note); ?></td>
                <td><a href='note.php?action=modifier&id=<?php echo $prodNote->idNote; ?>'><img src="https://img.icons8.com/color/30/000000/edit.png"></a></td><!--Icon pour modifier une ligne du tableau-->
                <td><a href='note_action.php?action=supprimer&id=<?php echo $prodNote->idNote; ?>'><img src="https://img.icons8.com/color/30/000000/delete-sign.png"></a></td><!--Icon pour supprimer une ligne du tableau-->
            </tr>
<?php 
        // lecture de la note suivant
        $prodNote=$noteEleve->fetch(); 
        }
?>
        </tbody>
    </table>
    <?php
            }else{
                ?>


            <div class="columns is-centered">
                <div class="column has-text-centered is-5">
                    <p>A partir de cette page, vous pouvez ajouter, modifier ou supprimer des notes.</p>
                </div>
            </div>
                <section class="section">
                <div class="container">               
                    <div class="columns is-centered">
                        <div class="column has-text-centered is-5">
                            <p class="title">Veuillez choisir une formation</p>    
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