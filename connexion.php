<?php
include ( "include/_inc_parametres.php");
include ( "include/_inc_connexion.php");
header( 'content-type: text/html; charset=utf-8' );
?>
<DOCTYPE html>
<html lang="fr">
    <head>
        <link rel="icon" type="image/png" href="img/logo.png" />
        <title>Connexion
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
                <form action="connexion_action.php" method="POST">
                    <div class="field">
                        <label id="" for="conId">Identifiant</label>
                        <input class="input" type="text" name="cnxId" id="cnxId" placeholder="Saisir votre identifiant" required>
                    </div>
                    <div class="field">
                        <label id="" for="conMotdepasse">Mot de passe</label>
                        <input class="input" type="password" name="cnxMotdepasse" id="cnxMotdepasse" placeholder="Votre mot de passe" required>
                    </div>

                    <div class="columns">
                        <div class="column">
                        <a href="motdepasseoublie.php">Mot de passe oublié</a>
                        </div>
                        <div class="column">
                        <input type="submit" value="Envoyer" class="button is-primary" >      
                        </div>
                    </div>
                </form>
            </div>

            </div>
        </article> 
           
    </body>
</html>