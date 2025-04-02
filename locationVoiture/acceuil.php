<?php
session_start();
include("header.php");
require("vehicule.php");
$pdo = Bdd::PDO();
include("commande_sql_admin.php");
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
    <div class="contner acceuil">
    <?php 

    $vehicules = Vehicule::all();
    


    if($_SESSION["valide"]==0){
        echo
        '
        <a href="formulaireConnection.php" class="bouton">log in</a>';
    }else{
        echo '<h1> bonjours '.$_SESSION["connection"].' ! </h1>
        <a href="acceuil.php?deconnection="" class="bouton">log out</a>';
    }
    ?>
    <?php
        if($_SESSION["admin"]==1){
            echo '<a href="gestionAdmin.php?type=ajouter" class="bouton">ajouter</a>';
        }
    ?>
    <form action="" method="post">
        <a href="acceuil.php?type=''">acceuil</a>
        <input type="text" name="recherche" placeholder="rechercher">
        <input type="hidden" name="type" value="recherche">
        <input type="submit" value="ok">
    </form>
    <table>
        <tr>
            <th>marque</th>
            <th>modèle</th>
            <th>immatriculation</th>
            <th>statut</th>
            <th>prix</th>
        </tr>
    <?php
    if(isset($_POST["type"])){
        if($_POST["type"]=="recherche"){
            $sql = 'SELECT * FROM voiture where id='.$_POST["recherche"];
            $temp = $pdo->query($sql);
            $resultats=$temp->fetch();
            if(isset($resultats["marque"])){
            echo "<tr><td class='table' >" . $resultats["marque"] . "</td>";
            echo "<td class='table'>" . $resultats["modele"] . "</td>";
            echo "<td class='table'>" . $resultats["immatriculation"] . "</td>";
            if ($resultats["statut"]==0){
                echo "<td class='table'>indisponible</td>";
            }elseif ($resultats["statut"]==1){
                echo "<td class='table'>disponible</td>";
            }
            echo "<td class='table'>" . $resultats["prix"] . " €</td>";
            echo '<td><a href="info.php"><img src="info.png" alt="details" title="detail" class="details"></a></td>';
            if($_SESSION["admin"]==1){
                echo '<td><a href="gestionAdmin.php?type=modifier&id='.$resultats["id"] .'" class="bouton">modifier</a></td><td><a href="acceuil.php?type=supprimer&id='.$resultats["id"].'" class="bouton">supprimer</a></td></tr>';
            }
            }
        }else{
            foreach ($vehicules as $vehicule) {
                echo "<tr><td class='table' >" . $vehicule->marque . "</td>";
                echo "<td class='table'>" . $vehicule->modele . "</td>";
                echo "<td class='table'>" . $vehicule->immatriculation . "</td>";
                if ($vehicule->statut==0){
                    echo "<td class='table'>indisponible</td>";
                }elseif ($vehicule->statut==1){
                    echo "<td class='table'>disponible</td>";
                }
                echo "<td class='table'>" . $vehicule->prix . " €</td>";
                echo '<td><a href="info.php"><img src="info.png" alt="details" title="detail" class="details"></a></td>';
                if($_SESSION["admin"]==1){
                    echo '<td><a href="gestionAdmin.php?type=modifier&id='.$vehicule->id.'" class="bouton">modifier</a></td><td><a href="acceuil.php?type=supprimer&id='.$vehicule->id.'" class="bouton">supprimer</a></td></tr>';
                } 
            }
        }
        
}else{
    foreach ($vehicules as $vehicule) {
        echo "<tr><td class='table' >" . $vehicule->marque . "</td>";
        echo "<td class='table'>" . $vehicule->modele . "</td>";
        echo "<td class='table'>" . $vehicule->immatriculation . "</td>";
        if ($vehicule->statut==0){
            echo "<td class='table'>indisponible</td>";
        }elseif ($vehicule->statut==1){
            echo "<td class='table'>disponible</td>";
        }
        echo "<td class='table'>" . $vehicule->prix . " €</td>";
        echo '<td><a href="info.php"><img src="info.png" alt="details" title="detail" class="details"></a></td>';
        if($_SESSION["admin"]==1){
            echo '<td><a href="gestionAdmin.php?type=modifier&id='.$vehicule->id.'" class="bouton">modifier</a></td><td><a href="acceuil.php?type=supprimer&id='.$vehicule->id.'" class="bouton">supprimer</a></td></tr>';
        } 
    }
}
?>
    </table>
    </div>
    <script src="script.js"></script>
</body>
</html>