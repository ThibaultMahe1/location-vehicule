<?php
    
    if(isset($_GET["deconnection"])){
        session_destroy();
        header('Location: index.php');
    }
    if(isset($_REQUEST["type"]) && $_REQUEST["type"]!="recherche"){
            if(isset($_POST["marque"])){
                $info = array($_POST["marque"],$_POST["modele"],$_POST["immatriculation"],$_POST["statut"],$_POST["prix"]);
            }if(isset($_GET["id"])){
                $info = array($_GET["id"]);
            }   
            if(isset($_POST["identifiant"])){
            $info = array($_POST["identifiant"], $_POST["mdp"]);
            }
            $Commande = new Commande;
            $Commande->commande($_REQUEST["type"], $info);
    }
?>