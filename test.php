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
<?php


$infoEcole=$cnx->query('SELECT HOUR(date) as heure, DAYOFWEEK(date) as jour, date(date) as datedujour, matiere, salle FROM emploiDuTemps WHERE date >= now() and formation = 2 ORDER by date;'); 
$infoEcole->setFetchMode(PDO::FETCH_OBJ);
$prodInfo=$infoEcole->fetch();


while($prodInfo)
{ 
     if ($prodInfo->jour ==1){ 
          $jour2= "Dimanche";
     }elseif($prodInfo->jour ==2){ 
          $jour2= "Lundi";
     }elseif($prodInfo->jour ==3){ 
          $jour2= "Mardi";
     }elseif($prodInfo->jour ==4){ 
          $jour2= "Mercredi";
     }elseif($prodInfo->jour ==5){ 
          $jour2= "Jeudi";
     }elseif($prodInfo->jour ==6){ 
          $jour2= "Vendredi";
     }elseif($prodInfo->jour ==7){ 
          $jour2= "Samedi";
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
?>
</table>

</body>


