<?php
    $connection=0;
    $sql='SELECT * FROM user';
    $temp = $pdo->query($sql);
    while($resultats=$temp->fetch()){
        if(isset($_POST["identifiant"])){
        if($resultats["name"]==$_POST["identifiant"] && $resultats["mdp"]==$_POST["mdp"]){
            $connection=1;
            $_SESSION["valide"]=1;
            $_SESSION["connection"]=$resultats["name"];
            if($resultats["admin"]==1){
                $_SESSION["admin"]=1;
            }else{
                $_SESSION["admin"]=0;
            }
        }
    }
    }
?>