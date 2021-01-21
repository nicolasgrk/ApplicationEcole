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
    <script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>

</head>
<!--head-->
<!--body-->

<body>
    <!--Header-->
    <!--body-->

</html>
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

<h2>Joueur</h2>
<p>Sur cette page, vous pouvez modifier joueur.
    <div class="formulaire">
        <!--Formulaire pour modifier un joueur-->
        <form method="post" action="note_action.php?action=modifier">
            <!--transmission de l'action modifier-->
            <!-- numéro du notesélectionné caché -->
            <input type="hidden" name="numero" value="<?php echo $note->id; ?>" />
            <input class="input" type="text"  name="newmatiere" id="matiere"
                value='<?php echo utf8_encode($note->matiere); ?>' required readonly>
            <input class="input" type="text" placeholder="Note" name="newNote" id="newNote"
                value='<?php echo utf8_encode($note->note); ?>' required>


    </div><br>
    <button type="submit" value="Submit" class="myButton">Soumettre</button>
    <!--Bouton d'envoi-->
    </form>


    <?php
				}
			if ($_GET['action'] == 'nouveau') //Si l'action est égale à nouveau alors on continue
				{ ?>
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

    <?php 
        $reponse = $cnx->query('SELECT nom, prenom, id FROM utilisateur');

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
    </div>
  </section>
 
    <?php
				}
			}
		else
			{
			// affichage lors du clic sur notedans la page index.php
			include("include/_inc_parametres.php");
			include("include/_inc_connexion.php");

            $noteEleve=$cnx->query("SELECT utilisateur.nom, utilisateur.prenom, matiere, note, utilisateur.id as idUtili, note.id as idNote FROM note, utilisateur where note.id_utilisateur = utilisateur.id"); //Récupération de toute la table note avec nom et prenom
            $noteEleve->setFetchMode(PDO::FETCH_OBJ);

			?>
    <h2>Joueur</h2>
    <p>A partir de cette page, vous pouvez ajouter, modifier ou supprimer des utilisateur.
        <a href="note.php?action=nouveau">Ajouter une note</a> </p>

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
            <?php $prodNote=$noteEleve->fetch();
                    while ($prodNote) {
                ?>
            <tr>
                <td>
                    <?php echo utf8_encode($prodNote->nom); ?> </td>
                <td>
                    <?php echo utf8_encode($prodNote->prenom); ?> </td>
                <td>
                    <?php echo utf8_encode($prodNote->matiere); ?> </td>
                <td>
                    <?php echo utf8_encode($prodNote->note); ?> </td>
                <td>

                    <a href='note.php?action=modifier&id=<?php echo $prodNote->idNote; ?>'><img
                            src="https://img.icons8.com/color/30/000000/edit.png"></a></td>
                <!--Icon pour modifier une ligne du tableau-->
                <td>
                    <a href='note_action.php?action=supprimer&id=<?php echo $prodNote->idNote; ?>'><img
                            src="https://img.icons8.com/color/30/000000/delete-sign.png"></span></a></td>
                <!--Icon pour supprimer une ligne du tableau-->
            </tr>
            <?php // lecture du notesuivant
                    $prodNote=$noteEleve->fetch(); }
                ?>
        </tbody>
    </table>
    
    <?php
			} ?>
    </div>

    <p id=footer>Wesh le footer</p>
    </div><?php  ?>

    </body>
    <!--Body-->