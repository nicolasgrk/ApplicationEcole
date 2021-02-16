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
                    <h1>Mot de passe oublié</h1>
                    <div class="field">
                        <label id="" for="conId">E-mail</label>
                        <input class="input" type="email" name="mdpoemail" placeholder="Saisir votre adresse e-mail" required>
                    </div>
                    <input type="submit" value="Envoyer">      
                </form>
            </div>
        </article>            
    </body>
</html>