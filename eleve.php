<?php
include ( "include/_inc_parametres.php");
include ( "include/_inc_connexion.php");
header( 'content-type: text/html; charset=utf-8' );

 session_start();
if(isset($_SESSION['id'])){
    if ($_SESSION['role']== 3 || $_SESSION['role']== 4 ){
    ?>





<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="icon" type="image/png" href="img/logo_small.png" />
    <title>Eleve
    </title>
    <meta charset="UTF-8">
    <meta name="description" content="...">
    <meta name="keywords" content="...">
    <meta name="author" content="Nicolas Gurak">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css"
    >
    <link rel="stylesheet" href="css/styles.css">

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
                <?php 
                if ($_SESSION['role']== 3){
                    
                    ?>
                    <a href="eleve.php" class="button is-primary"><strong>Page perso</strong></a>
                    <a href="information_bde.php" class="button is-light">Gestion évenements</a>
                    <?php 
                        }
                    ?>
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
                            <h2 class="subtitle is-4 has-text-centered has-text-black">BDE</h2>
                            <?php 
                                    $infoEcole=$cnx->query("SELECT intituleEvenement, DATE_FORMAT(dateEvenement, '%d %M %Y') as dateEvnt from bde where dateEvenement > CURRENT_DATE ORDER BY dateEvenement limit 5"); //Récupération de toute la table note avec nom et prenom
                                    $infoEcole->setFetchMode(PDO::FETCH_OBJ);
                                    $prodInfo=$infoEcole->fetch();
                                    while ($prodInfo) {
                                        $dateMySQL = ($prodInfo->dateEvnt);
                                        setlocale(LC_TIME, ['fr', 'fra', 'fr_FR']);   
                                        ?><p class="subtitle"><?php echo utf8_encode($prodInfo->intituleEvenement); ?> <?php echo strftime("%A %d %B %Y",strtotime($dateMySQL)); ?> </p><?php
                                        $prodInfo=$infoEcole->fetch(); 
                                    }
                            ?>
                        </article>
                    </div>
                    <div class="tile is-parent">
                        <article class="tile is-child notification is-warning" id="1">
                        <h2 class="subtitle is-4 has-text-centered has-text-black">Emploi du temps</h2>

                        <table class="table" id="open_modal">
                            <tr>
                                <td>Jour</td>
                                <td>Heure</td>
                                <td>Matières</td>
                                <td>Salle</td>
                            </tr>
                        <?php 
                                $infoEcole=$cnx->query('SELECT  DAYOFWEEK(dates) as jour, date(dates) as datedujour, HeureDebut, HeureFin,matiere, salle FROM emploiDuTemps WHERE dates = date(now()) and formation = 2 ORDER by dates;'); 
                                $infoEcole->setFetchMode(PDO::FETCH_OBJ);
                                $prodInfo=$infoEcole->fetch();
                                while($prodInfo)
                                { 
                                    $dateMySQL = ($prodInfo->datedujour);
                                    setlocale(LC_TIME, ['fr', 'fra', 'fr_FR']);                              
                                
                                ?>
                                
                                  <tr>
                                    <td><?php echo strftime("%A %d %B %Y",strtotime($dateMySQL))?> </td>
                                    <td><?php echo $prodInfo->HeureDebut?> - <?php echo $prodInfo->HeureFin?></td>
                                    <td><?php echo $prodInfo->matiere?></td>
                                    <td><?php echo $prodInfo->salle?></td>
                                  </tr>
                                <?php
                                $prodInfo=$infoEcole->fetch(); 
                                
                                }
                                ?>
                                </table>
                        </article>


                        <div class="modal" id="modal_to_open">
                            <div class="modal-background"></div>
                                <div class="modal-content">
                                    <header class="modal-card-head">
                                    <p class="modal-card-title">Emploi du temps</p>
                                    <button class="delete" aria-label="close" id="close_modal"></button>
                                    </header>
                                    <section class="modal-card-body">
                                    <table class="table">
                                        <tr>
                                            <td>Jour</td>
                                            <td>Heure</td>
                                            <td>Matières</td>
                                            <td>Salle</td>
                                        </tr>
                                        <?php 
                                        $infoEcole=$cnx->query('SELECT  DAYOFWEEK(dates) as jour, date(dates) as datedujour, HeureDebut, HeureFin,matiere, salle FROM emploiDuTemps WHERE week(dates) = week(CURRENT_DATE) and formation = 2 ORDER by dates;'); 
                                        $infoEcole->setFetchMode(PDO::FETCH_OBJ);
                                        $prodInfo=$infoEcole->fetch();
                                        while($prodInfo)
                                        { 

                                                $dateMySQL = ($prodInfo->datedujour);
                                                setlocale(LC_TIME, ['fr', 'fra', 'fr_FR']);
                                            
                                        ?>


                                        <tr>
                                            <td><?php echo strftime("%A %d %B %Y",strtotime($dateMySQL))?> </td>
                                            <td><?php echo $prodInfo->HeureDebut?> - <?php echo $prodInfo->HeureFin?></td>
                                            <td><?php echo $prodInfo->matiere?></td>
                                            <td><?php echo $prodInfo->salle?></td>
                                        </tr>
                                        <?php
                                        $prodInfo=$infoEcole->fetch(); 

                                        } 
                                        ?>
                                    </table>
                                    </section>
                                    <footer class="modal-card-foot">
                                    </footer>
                                </div>

                            
                        </div>
                    </div>

                    
                    <div class="tile is-parent">
                        <article class="tile is-child notification is-info" id="1">
                        <h2 class="subtitle is-4 has-text-centered ">Conversation</h2>
                        <p id="open_modal2">Ouvrir la conv</p>
                        <div class="modal" id="modal_to_open2">
                            <div class="modal-background"></div>
                                <div class="modal-content">
                                    <header class="modal-card-head">
                                    <p class="modal-card-title">Conversation</p>
                                    <button class="delete" aria-label="close" id="close_modal2"></button>
                                    </header>
                                    <section class="modal-card-body has-text-black">
                                        <main class="row">

                                            <div class="card">
                                                <div class="card-content">
                                                    <div class="content" id="discussion">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="saisie">
                                                <div class="columns">
                                                    <div class="column is-four-fifths">
                                                        <textarea class="textarea is-rounded"  id="texte" placeholder="Entrez votre texte"></textarea>
                                                    </div>
                                                    <div class="column">
                                                        <div class="control">
                                                                <button class="button is-primary is-rounded" id="valid">Envoyer</button>
                                                        </div>                                                
                                                    </div>
                                                </div>
                                            </div>


                                        </main>
                                    </section>
                                <footer class="modal-card-foot">
                                </footer>
                            </div>                            
                        </div>
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
                                    $dateMySQL = ($prodInfo->dateEvnt);
                                    setlocale(LC_TIME, ['fr', 'fra', 'fr_FR']);
                                    ?><p class="subtitle"><?php echo utf8_encode($prodInfo->intituleEvenement); ?> <?php echo strftime("%A %d %B %Y",strtotime($dateMySQL));?> </p><?php
                                    $prodInfo=$infoEcole->fetch(); 
                                }
                            ?>
                        </article>
                    </div>
                    <div class="tile is-parent">
                        <article class="tile is-child notification is-warning" id="1">
                        <h2 class="subtitle is-4 has-text-centered has-text-black">Note</h2>
                            <?php 
                                $infoEcole=$cnx->query('SELECT * from note where id_utilisateur='.$_SESSION['id'].' ORDER BY note limit 5'); //Récupération de toute la table note avec nom et prenom
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
                        <?php 
                                $infoEcole=$cnx->query('SELECT * from utilisateur where id='.$_SESSION['id']); //Récupération de toute la table note avec nom et prenom
                                $infoEcole->setFetchMode(PDO::FETCH_OBJ);
                                $prodInfo=$infoEcole->fetch();
                                while ($prodInfo) {?>


                                                <div class="columns">
                                                    <div class="column">
                                                        <p class="subtitle"><?php echo utf8_encode($prodInfo->nom); ?> <?php echo utf8_encode($prodInfo->prenom); ?></p>
                                                    </div>
                                                    <div class="column">
                                                    <?php $dateMySQL = ($prodInfo->dateNaissance);
                                                    setlocale(LC_TIME, ['fr', 'fra', 'fr_FR']);?>
                                                    <p class="subtitle"><?php  echo strftime("%d %B %Y",strtotime($dateMySQL)); ?></p>
                                                    </div>
                                                </div>
                                                <div class="columns">
                                                    <div class="column is-one-third">
                                                        <p class="subtitle"><?php echo utf8_encode($prodInfo->identifiant); ?></p>
                                                    </div>
                                                    <div class="column">
                                                    <p class="subtitle"><?php echo utf8_encode($prodInfo->adresseMail); ?></p>
                                                    </div>
                                                </div>
                                                <div class="columns">
                                                    <div class="column is-one-third">
                                                        <p class="subtitle">Adresse:</p>
                                                    </div>
                                                    <div class="column">
                                                    <p class="subtitle"><?php echo utf8_encode($prodInfo->numeroRue); ?> <?php echo utf8_encode($prodInfo->rue); ?> </p>
                                                    <p class="subtitle"><?php echo utf8_encode($prodInfo->codePostale); ?> <?php echo utf8_encode($prodInfo->ville); ?></p>
                                                    </div>
                                                </div>
                                    
                                    <?php
                                    $prodInfo=$infoEcole->fetch(); 
                                }
                                
                            ?>

                        </article>
                    </div>
                </div>

            
            
            
            
            
        </div>
    </section>




    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/524c59c103.js" crossorigin="anonymous"></script>
    <script src="main.js"></script>
    <script type="text/javascript" src="js/scripts.js"></script>

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
