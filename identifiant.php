<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <title>Page Admin</title>
    </head>
    <body>
        <?php
            //connexion à la base de données en PDO
            try
            {
            // On se connecte à MySQL
                $bdd = new PDO('mysql:host=localhost;dbname=appli_ecole;charset=utf8', 'root', 'root');
            }
            catch(Exception $e)
            {
            // En cas d'erreur, on affiche un message et on arrête tout
                die('Erreur : '.$e->getMessage());
            }
        ?>

        <h1>Inscription</h1>

		<form class="form" action="validationIdentifiant.php" method="post">
			
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

            <label id="" for="role">Role</label>
            <select name="role" required>
            <option value="1">Administrateur</option>
            <option value="2">Professeur</option>
            <option value="3">BDE</option>
            <option value="4">Elèves</option>
            <option value="5">Secrétaire</option>
            </select>

            <label id="" for="idformation">Formation</label>
        <select name=idformation>
        
            <?php
                $reponse = $bdd->query("SELECT * FROM formation");
                while ($donnees=$reponse->fetch()){
                    ?>
                    <option value="<?php echo $donnees['id'];?>"><?php echo $donnees['intituleFormation'];?></option>
                    <?php
                }
                $reponse->closeCursor();
            ?>
        </select>

			<input type="submit" name="ajout" value="Ajouter">

		</form>

    </body>
</html>