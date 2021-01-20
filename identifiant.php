<!DOCTYPE html>
<html>
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
                $bdd = new PDO('mysql:host=localhost;dbname=appli_ecole', 'root', '');
            }
            catch(Exception $e)
            {
            // En cas d'erreur, on affiche un message et on arrête tout
                die('Erreur : '.$e->getMessage());
            }
        ?>
		<form class="form" action="validationInscription.php" method="post">
			<h2>Inscription</h2>
			
			<label id="" for="identifiant">Identifiant</label>
			<input type="text" name="identifiant" placeholder="Votre identifiant" required>

			<label id="" for="prenom">Prénom</label>
			<input type="text" name="prenom" placeholder="Votre prénom" required>

			<label id="" for="nom">Nom</label>
			<input type="text" name="nom" placeholder="Votre nom" required>

			<label id="" for="dateDeNaissance">Date de naissance</label>
			<input type="date" name="dateDeNaissance" placeholder="Votre date de naissance" required>

			<label id="" for="adresseMail">Email</label>
			<input type="email" name="adresseMail" placeholder="Votre email" required>

			<label id="" for="motDePasse">Mot de passe</label>
			<input type="password" name="motDePasse" minlength=8 placeholder="Votre mot de passe" required>
			
			<input type="submit" value="Modifier">
			<input type="reset" value="ANNULER">
		</form>

    </body>
</html>