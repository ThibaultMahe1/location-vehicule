<?php
session_start();
include("liaisonPHP-SQL.php");
if($_GET["type"]=="modifier"){
    $type="modifier";
    $id = $_GET["id"];
    $_SESSION["id"]=$id;
    if($_SESSION["admin"]==1){
        $sql='SELECT * FROM voiture WHERE id='.$id;
        $temp = $pdo->query($sql);
        $resultats=$temp->fetch();
        $marque=$resultats["marque"];
        $modele=$resultats["modele"];
        $immatriculation=$resultats["immatriculation"];
        $statut=$resultats["statut"];
        $prix=$resultats["prix"];
    }

}else if($_GET["type"]=="ajouter"){
    $type="ajouter";
    if($_SESSION["admin"]==1){
        $marque="";
        $modele="";
        $immatriculation="";
        $statut=1;
        $prix="";
    }
}


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta name="description" content="">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="acceuil.php" method="post">
    <?php
    if($_SESSION["admin"]==1){
        echo '
        <label for="">marque</label>
        <input type="text" name="marque" value="'.$marque.'">
        <label for="">modele</label>
        <input type="text" name="modele" value="'.$modele.'">
        <label for="">immatriculation</label>
        <input type="text" name="immatriculation" value="'.$immatriculation.'">
        <label for="">statut</label>
        <select name="statut" id="">
            <option value="1">disponible</option>
            <option value="0" ';
            if($statut==false){echo "selected";}
        echo    '>rupture de stock</option>
        </select>
        <label for="">prix</label>
        <input type="text" name="prix" value="'.$prix.'">
        <input type="submit" name="type" value="'.$type.'">';
    }
    ?>


    </form>


    <a href="acceuil.php">retour</a>
    <script src="script.js"></script>
</body>
</html>