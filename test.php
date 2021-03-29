<?php
include ( "include/_inc_parametres.php");
include ( "include/_inc_connexion.php");
header( 'content-type: text/html; charset=utf-8' );
?>


     <html>
<head>
    <title>Mon super emploi du temps</title>
    <style type="text/css">
        caption /* Titre du tableau */
        {
           margin: auto; /* Centre le titre du tableau */
           font-family: Arial, Times, "Times New Roman", serif;
           font-weight: bold;
           font-size: 1.2em;
           color: #009900;
           margin-bottom: 20px; /* Pour éviter que le titre ne soit trop collé au tableau en-dessous */
        }
 
        table /* Le tableau en lui-même */
        {
           margin: auto; /* Centre le tableau */
           border: 4px outset green; /* Bordure du tableau avec effet 3D (outset) */
           border-collapse: collapse; /* Colle les bordures entre elles */
           width:100%;
        }
        th /* Les cellules d'en-tête */
        {
           background-color: #006600;
           color: white;
           font-size: 1.1em;
           font-family: Arial, "Arial Black", Times, "Times New Roman", serif;
           border:1px solid red;
        }
 
        td /* Les cellules normales */
        {
           border: 1px solid black;
           font-family: "Comic Sans MS", "Trebuchet MS", Times, "Times New Roman", serif;
           text-align: center; /* Tous les textes des cellules seront centrés*/
           padding: 5px; /* Petite marge intérieure aux cellules pour éviter que le texte touche les bordures */
        }
        td.time
        {
            width:5%;
        }
    </style>
 
</head>
<body>
<table>
<tr>
    <td>Jour</td>
    <td>Heure</td>
    <td>Matières</td>
    <td>Salle</td>
</tr>
<?php


$infoEcole=$cnx->query('SELECT HOUR(date) as heure, DAYOFWEEK(date) as jour, date(date) as datedujour, matiere, salle FROM emploiDuTemps WHERE week(date) = week(CURRENT_DATE) and formation = 2 ORDER by date;'); 
$infoEcole->setFetchMode(PDO::FETCH_OBJ);
$prodInfo=$infoEcole->fetch();


while($prodInfo)
{ 
     if ($prodInfo->jour ==1){ 
          $jour2= "Dimanche";
?> 
<h1>Dimanche </h1><?php echo $prodInfo->matiere?></p>
<?php
     }elseif($prodInfo->jour ==2){ 
          $jour2= "Lundi";
          ?> 
          <h1>Lundi </h1><?php echo $prodInfo->matiere ?></p>
          <?php
     }elseif($prodInfo->jour ==3){ 
          $jour2= "Mardi";
          ?> 
          <h1>Mardi </h1><?php echo $prodInfo->matiere?></p>
          <?php     
     }elseif($prodInfo->jour ==4){ 
          $jour2= "Mercredi";
          ?> 
          <h1>Mercredi </h1><?php echo $prodInfo->matiere?></p>
          <?php     
     }elseif($prodInfo->jour ==5){ 
          $jour2= "Jeudi";
          ?> 
          <h1>Jeudi </h1><?php echo $prodInfo->matiere?></p>
          <?php
     }elseif($prodInfo->jour ==6){ 
          $jour2= "Vendredi";
          ?> 
          <h1>Vendredi </h1><p><?php echo $prodInfo->matiere?></p>
          <?php
     }elseif($prodInfo->jour ==7){ 
          $jour2= "Samedi";
          ?> 
          <h1>Samedi </h1><?php echo $prodInfo->matiere?></p>
          <?php
          }





?>

  <tr>
    <td><?php echo $prodInfo->datedujour?> </td>
    <td><?php echo $prodInfo->heure?></td>
    <td><?php echo $prodInfo->matiere?></td>
    <td><?php echo $prodInfo->salle?></td>
  </tr>
<?php
$prodInfo=$infoEcole->fetch(); 

}

            setlocale(LC_TIME, ['fr', 'fra', 'fr_FR']);
            echo strftime('%A %d %B %Y %I:%M:%S'). '<br>';
            echo strftime('%x'). '<br>';
            echo strftime('%T'). '<br>';
            echo strftime('%c'). '<br>';
            $date = '27/09/2013';
            echo strftime('%c'). '<br>';
          echo date('%A %d %B %Y %I:%M:%S', strftime($date));
            
?>


<?php
    $dateMySQL = "2018-04-27 12:34:35";

    $seulementAnnee = date("Y", strtotime($dateMySQL));
    $seulementHeure = date("h:i", strtotime($dateMySQL));
    $seulementDate = date("Y-%B-%A", strtotime($dateMySQL));
?>
<div>
    Année : <?= $seulementAnnee ?>
</div>
<div>
    Heure : <?= $seulementHeure ?>
</div>
<div>
    Date : <?= $seulementDate ?>
</div>
</table>



<table>

<tr>
     <td> Lundi</td>
</tr>
<tr>
     <td> Mardi</td>
</tr>
<tr>
     <td> Mercredi</td>
</tr>
<tr>
     <td> Jeudi</td>
</tr>
<tr>
     <td> Vendredi</td>
</tr>

</table>

</body>


