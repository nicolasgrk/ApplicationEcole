<?php 
              //connexion à la base de données en PDO
    try{
      // On se connecte à MySQL
      $bdd = new PDO('mysql:host=localhost;dbname=appli_ecole', 'root', 'root');
    }
    catch(Exception $e){
      // En cas d'erreur, on affiche un message et on arrête tout
      die('Erreur : '.$e->getMessage());
    } ?>


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
  <script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>

</head>

<body>

  <header>

  </header>
  <h1>Ajouter note</h1>

  <form class="form" action="note_action.php" method="post">
    <h2>Note</h2>

    <label id="matiere" for="matiere">Matière</label>
    <input type="text" name="matiere" placeholder="Nom de la matière" required>

    <label id="note" for="Note">Note</label>
    <input type="number" name="note" placeholder="Note " required>

    <label id="utilisateur" for="utilisateur">étudiant</label>
    <select name="utilisateur" id="utilisateur">
    <option value="">Choisir un étudiant</option>

    <?php 
        $reponse = $bdd->query('SELECT nom, prenom, id FROM utilisateur');

        while ($donnees = $reponse->fetch()){
    ?>
     <option value="<?php echo $donnees['id'];?>"> <?php echo $donnees['nom'];?> <?php echo $donnees['prenom'];?></option>


    <?php
    }

    $reponse->closeCursor();

  ?>
    </select>

    <input type="submit" value="Envoyer">


  </form>


<?php
  $reponse = $bdd->query('SELECT utilisateur.nom, utilisateur.prenom, matiere, note FROM note, utilisateur where note.id_utilisateur = utilisateur.id' );

while ($donnees = $reponse->fetch()){
   echo $donnees['matiere'] . '<br />';

}

$reponse->closeCursor();
?>
  <footer class="footer">

  </footer>
  <script>
  </script>
</body>


</html>


