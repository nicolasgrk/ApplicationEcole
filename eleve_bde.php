<?php
include ( "include/_inc_parametres.php");
include ( "include/_inc_connexion.php");
header( 'content-type: text/html; charset=utf-8' );
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="icon" type="image/png" href="img/logo.png" />
    <title>Eleve
    </title>
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
            <a class="navbar-item" href="information_bde.php">
                <img src="img/logo.png">
            </a>

            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false"
                data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>



        <div class="navbar-end">
            <div class="navbar-item">
                <div class="buttons">
                    <a href="eleve_bde.php" class="button is-primary"><strong>Page perso</strong></a>
                    <a href="information_bde.php" class="button is-light">Gestion évenements</a>

                </div>
            </div>
        </div>
        </div>
    </nav>
    

    <section class="section">
        <div class="block">
            <div class="container">
            <div class="tile is-ancestor">
                <div class="tile is-parent">
                    <article class="tile is-child notification is-primary" id="1">
                        <?php 
                                $infoEcole=$cnx->query("SELECT intituleEvenement, DATE_FORMAT(dateEvenement, '%d %M %Y') as dateEvnt from bde where dateEvenement > CURRENT_DATE ORDER BY dateEvenement limit 5"); //Récupération de toute la table note avec nom et prenom
                                $infoEcole->setFetchMode(PDO::FETCH_OBJ);
                                $prodInfo=$infoEcole->fetch();
                                while ($prodInfo) {
                                    ?><p class="subtitle"><?php echo utf8_encode($prodInfo->intituleEvenement); ?> le <?php echo utf8_encode($prodInfo->dateEvnt); ?> </p><?php
                                    $prodInfo=$infoEcole->fetch(); 
                                }
                        ?>
                    </article>
                </div>
                <div class="tile is-parent">
                    <article class="tile is-child notification is-warning" id="1">

                    <p class="subtitle">test</p>
                        <p class="subtitle">fddsqfqs</p>
                        <p class="subtitle">test</p>
                        <p class="subtitle">fddsqfqs</p>
                        <p class="subtitle">test</p>

                    </article>
                </div>
                <div class="tile is-parent">
                    <article class="tile is-child notification is-info" id="1">
                        <p class="subtitle">test</p>
                        <p class="subtitle">fddsqfqs</p>
                        <p class="subtitle">test</p>
                        <p class="subtitle">fddsqfqs</p>
                        <p class="subtitle">test</p>

                    </article>
                </div>
            </div>
            
            
            
            
        </div>
    </section>
</body>
<!--Body-->

</html>