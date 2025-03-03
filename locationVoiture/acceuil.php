<?php
session_start();




include("liaisonPHP-SQL.php");
if(isset($_GET["deconnection"])){
    $_SESSION["valide"]=0;
    $_SESSION["admin"]=0;
}
if($_SESSION["admin"]==1){
    if(isset($_POST["type"])){
        if($_POST["type"]=="ajouter"){
            $marque=$_POST["marque"];
            $modele=$_POST["modele"];
            $immatriculation=$_POST["immatriculation"];
            $statut=$_POST["statut"];
            $prix=$_POST["prix"];
            $sql = 'INSERT INTO voiture(marque, modele, immatriculation, statut, prix) VALUE ("'.$marque.'", "'.$modele.'", "'.$immatriculation.'", "'.$statut.'", "'.$prix.'")';
            $nblignes = $pdo->exec($sql);
        }
        if($_POST["type"]=="modifier"){
            $marque=$_POST["marque"];
            $modele=$_POST["modele"];
            $immatriculation=$_POST["immatriculation"];
            $statut=$_POST["statut"];
            $prix=$_POST["prix"];
            $sql = 'UPDATE voiture SET marque="'.$marque.'", modele="'.$modele.'", immatriculation="'.$immatriculation.'", statut='.$statut.', prix="'.$prix.'" WHERE id='.$_SESSION["id"];
            $nblignes = $pdo->exec($sql);
        }
    }
    if(isset($_GET["type"])){
        if($_GET["type"]=="supprimer"){
            $id = $_GET["id"];
            $sql = 'DELETE FROM voiture WHERE id = '.$id.'';
            $nblignes = $pdo->exec($sql);
        }
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
    <div class="contner">
    <?php 
    require("vehicule.php");

    $vehicules = Vehicule::all();
    


    if($_SESSION["valide"]==0){
        echo
        '
        <a href="formulaireConnection.php">log in</a>';
    }else{
        echo '<h1> bonjours '.$_SESSION["connection"].' ! </h1>
        <a href="acceuil.php?deconnection="">log out</a>';
    }
    ?>
    <?php
        if($_SESSION["admin"]==1){
            echo '<a href="gestionAdmin.php?type=ajouter">ajouter</a>';
        }
    ?>
    <table>
        <tr>
            <th>marque</th>
            <th>modèle</th>
            <th>immatriculation</th>
            <th>statut</th>
            <th>prix</th>
        </tr>
    <?php
    foreach ($vehicules as $vehicule) {
        echo "<tr><td>" . $vehicule->marque . "</td>";
        echo "<td>" . $vehicule->modele . "</td>";
        echo "<td>" . $vehicule->immatriculation . "</td>";
        echo "<td>" . $vehicule->statut . "</td>";
        echo "<td>" . $vehicule->prix . " €</td>";
        echo '<td><a href="info.php"><img src="info.png" alt="details" title="detail" class="details"></a></td>';
        if($_SESSION["admin"]==1){
            echo '<td><a href="gestionAdmin.php?type=modifier&id='.$vehicule->id.'">modifier</a></td><td><a href="acceuil.php?type=supprimer&id='.$vehicule->id.'">supprimer</a></td></tr>';
        } 
    }
    ?>
    </table>
    </div>
    <script src="script.js"></script>
</body>
</html>