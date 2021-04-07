<?php
include ( "include/_inc_parametres.php");
include ( "include/_inc_connexion.php");
header( 'content-type: text/html; charset=utf-8' );
?>
<DOCTYPE html>
<html lang="fr">
    <head>
        <link rel="icon" type="image/png" href="img/logo.png" />
        <title>Mot de passe oublié
        </title>
        <meta charset="UTF-8">
        <meta name="description" content="...">
        <meta name="keywords" content="...">
        <meta name="author" content="Mahé Louis">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
        <link rel="stylesheet" href="css/styles.css">
        <script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'>
        </script>       
    </head>
    <body>
        <article class="columns is-centered">
            <div class="column has-text-centered is-4">
            <figure class="image" id="imgcnx">
                <img src="img/logo.png">
            </figure>
                <form action="motdepasseoublie_action.php" method="post">
                    <h1 class="title is-1">Mot de passe oublié</h1>
                    <div class="field">
                        <label id="" for="conId">E-mail</label>
                        <input class="input" type="email" name="mdpoemail" placeholder="Saisir votre adresse e-mail" required>
                    </div>
                        <input type="submit" value="Envoyer" class="button is-primary">                  
                </form>
            </div>
        </article>                      
    </body>
</html>