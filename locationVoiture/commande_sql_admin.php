<?php
    if(isset($_GET["deconnection"])){
        $_SESSION["valide"]=0;
        $_SESSION["admin"]=0;
    }
    if($_SESSION["admin"]==1){
        if(isset($_POST["type"])){
            if($_POST["type"]=="ajouter"){
                $info = array($_POST["marque"],$_POST["modele"],$_POST["immatriculation"],$_POST["statut"],$_POST["prix"]);
                $Bdd = new Bdd;
                $Bdd->commande("ajouter", $info);
            }
            if($_POST["type"]=="modifier"){
                $info = array($_POST["marque"],$_POST["modele"],$_POST["immatriculation"],$_POST["statut"],$_POST["prix"]);
                $Bdd = new Bdd;
                $Bdd->commande("modifier", $info);
            }

        }
        if(isset($_GET["type"])){
            if($_GET["type"]=="supprimer"){
                $id = array($_GET["id"]);
                $Bdd = new Bdd;
                $Bdd->commande("supprimer", $id);
            }
        }
    }

?>