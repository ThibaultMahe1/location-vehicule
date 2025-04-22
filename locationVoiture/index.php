<?php 
session_start();
include("image_et_style/header.php");
require("objet/vehicule.php");
require_once("objet/Commande.php");
include("back/commande_sql_admin.php");
$vehicules = Vehicule::all();
?>
<body>
<div class="contner acceuil">
    <?php
        if(isset($_SESSION["co"])){
        if($_SESSION["co"]==0){
            echo'<a href="form/formulaireConnection.php" class="bouton">log in</a>';
        }else{
            echo '<h1> bonjours '.$_SESSION["connection"].' ! </h1>
            <a href="index.php?deconnection="" class="bouton">log out</a>';
        }
        if($_SESSION["admin"]==1){
            echo '<a href="profil.php" class="bouton">toute les reservation</a>';
            echo '<a href="form/gestionAdmin.php?type=ajouter" class="bouton">ajouter</a>';
        }elseif($_SESSION["co"]==1){
            echo '<a href="profil.php" class="bouton">mes location</a>';
        }
        }else{
            echo'<a href="form/formulaireConnection.php" class="bouton">log in</a>';
        }
    ?>
<form action="" method="POST">
        <a href="index.php" class="bouton">acceuil</a>
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
            foreach($vehicules as $vehicule){
                if(isset($_POST["type"]) && $_POST["type"]=="recherche"){
                    $Commande = new Commande;
                    $Commande->recherche($_POST["recherche"], $vehicule->id);
                }else{
                    $_SESSION["recherche"]=1;
                }
                if($_SESSION["recherche"]==1){
                    echo "<tr><td class='table' >" . $vehicule->marque . "</td>";
                    echo "<td class='table'>" . $vehicule->modele . "</td>";
                    echo "<td class='table'>" . $vehicule->immatriculation . "</td>";
                    if ($vehicule->statut==0){
                        echo "<td class='table'>indisponible</td>";
                    }elseif ($vehicule->statut==1){
                        echo "<td class='table'>disponible</td>";
                    }
                    echo "<td class='table'>" . $vehicule->prix . " €</td>";
                    echo '<td><a href="info.php"><img src="image_et_style/info.png" alt="details" title="detail" class="details"></a></td>';
                    if(isset($_SESSION["admin"]) && $_SESSION["admin"]==1){
                        echo '<td><a href="form/gestionAdmin.php?type=modifier&id='.$vehicule->id.'" class="bouton">modifier</a></td><td><a href="index.php?type=supprimer&id='.$vehicule->id.'" class="bouton">supprimer</a></td></tr>';
                    } 
                    elseif (isset($_SESSION["co"]) && $_SESSION["co"]==1 && $vehicule->statut==1){
                        echo'<td><a href="acceuil.php?type=reserver&id='.$vehicule->id.'" class="bouton">reserver</a></td>';
                    }

                }
            }
    ?>
    </table>
        </div>
</body>
</html>