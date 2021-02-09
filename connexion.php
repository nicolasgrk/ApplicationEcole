<?php
include ( "include/_inc_parametres.php");
include ( "include/_inc_connexion.php");
header( 'content-type: text/html; charset=utf-8' );
?>
<DOCTYPE html>
<html lang="fr">
    <head>
        <link rel="icon" type="image/png" href="img/logo.png" />
        <title>Utilisateurs
        </title>
        <meta charset="UTF-8">
        <meta name="description" content="...">
        <meta name="keywords" content="...">
        <meta name="author" content="Mahé Louis">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
        <link rel="stylesheet" href="style/style.css">
        <script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'>
        </script>       
    </head>
    <body>
        <article class="columns is-centered">
            <div class="column has-text-centered is-4">
                <form action="connexion_action.php" method="post">
                    <h1>Connexion</h1>
                    <div class="field">
                        <label id="" for="conId">Identifiant</label>
                        <input class="input" type="text" name="conId" placeholder="Saisir votre identifiant" required>
                    </div>
                    <div class="field">
                        <label id="" for="conMotdepasse">Mot de passe</label>
                        <input class="input" type="password" name="conMotdepasse" placeholder="Votre mot de passe" required>
                    </div>
                    <a>mot de passe oublié</a>
                    <input type="submit" value="Envoyer">      
                </form>
            </div>
        </article>            
    </body>
</html>