<?php
session_start();
require("../objet/vehicule.php");
require_once("../image_et_style/header.php");
if($_GET["type"]=="modifier"){
    $type="modifier";
    $id = $_GET["id"];
    $_SESSION["id"]=$id;
    if($_SESSION["admin"]==1){  
        $vehicules = Vehicule::all();
        foreach($vehicules as $vehicule){
            if($vehicule->id==$id){
                $marque=$vehicule->marque;
                $modele=$vehicule->modele;
                $immatriculation=$vehicule->immatriculation;
                $statut=$vehicule->statut;
                $prix=$vehicule->prix;

            }

        }
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

<body>
    <form action="../index.php" method="post">
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
        <input type="number" step="0.01" name="prix" value="'.$prix.'">
        <input type="submit" name="type" value="'.$type.'">';
    }
    ?>


    </form>


    <a href="../index.php">retour</a>
</body>
</html>