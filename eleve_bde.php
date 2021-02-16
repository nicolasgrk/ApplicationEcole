<?php
include ( "include/_inc_parametres.php");
include ( "include/_inc_connexion.php");
header( 'content-type: text/html; charset=utf-8' );

 session_start();
if(isset($_SESSION['id'])){
    if ($_SESSION['role']== 3){
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
                    <a href="deconnexion.php" class="button is-light">Déconnexion</a>

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
                        <article class="tile is-child notification is-primary " id="1">
                            <h2 class="subtitle is-4 has-text-centered has-text-black"><?php echo $_SESSION['idformation'];?></h2>
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
                        <h2 class="subtitle is-4 has-text-centered has-text-black">Emploi du temps</h2>

                            <p class="subtitle">test</p>
                            <p class="subtitle">fddsqfqs</p>
                            <p class="subtitle">test</p>
                            <p class="subtitle">fddsqfqs</p>
                            <p class="subtitle">fddsqfqs</p>


                        </article>
                    </div>
                    <div class="tile is-parent">
                        <article class="tile is-child notification is-info" id="1">
                        <h2 class="subtitle is-4 has-text-centered has-text-black">Conversation</h2>

                            <p class="subtitle">test</p>
                            <p class="subtitle">fddsqfqs</p>
                            <p class="subtitle">test</p>
                            <p class="subtitle">fddsqfqs</p>
                            <p class="subtitle">fddsqfqs</p>

                        </article>
                    </div>
                </div>
                <div class="tile is-ancestor">
                    <div class="tile is-parent">
                        <article class="tile is-child notification is-primary" id="1">
                        <h2 class="subtitle is-4 has-text-centered has-text-black">Vie de l'école</h2>                            
                            <?php 
                                $infoEcole=$cnx->query("SELECT intituleEvenement, DATE_FORMAT(date, '%d %M %Y') as dateEvnt from infoEcole where date > CURRENT_DATE ORDER BY date limit 5"); //Récupération de toute la table note avec nom et prenom
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
                        <h2 class="subtitle is-4 has-text-centered has-text-black">Note</h2>
                            <?php 
                                $infoEcole=$cnx->query("SELECT * from note where id_utilisateur=2 ORDER BY note limit 5"); //Récupération de toute la table note avec nom et prenom
                                $infoEcole->setFetchMode(PDO::FETCH_OBJ);
                                $prodInfo=$infoEcole->fetch();
                                while ($prodInfo) {
                                    ?><p class="subtitle"><?php echo utf8_encode($prodInfo->matiere); ?>: <strong class="has-text-right"><?php echo utf8_encode($prodInfo->note); ?> </strong></p><?php
                                    $prodInfo=$infoEcole->fetch(); 
                                }
                            ?>

                        </article>
                    </div>
                    <div class="tile is-parent">
                        <article class="tile is-child notification is-info" id="1">
                        <h2 class="subtitle is-4 has-text-centered has-text-black">Information perso</h2>

                        <p class="subtitle">test</p>
                            <p class="subtitle">fddsqfqs</p>
                            <p class="subtitle">test</p>
                            <p class="subtitle">fddsqfqs</p>
                            <p class="subtitle">fddsqfqs</p>

                        </article>
                    </div>
                </div>

            
            
            
            
            
        </div>
    </section>
</body>
<!--Body-->

</html> 
<?php
    }else{

        echo "vous n'avez pas le droit d'etre la ";
        
        }
}else{

    echo "impossible car pas co";

}
?>
