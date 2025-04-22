<?php
require_once("Bdd.php");
class Commande extends Bdd {
    public function commande($type, array $parametres){
        $pdo = Bdd::PDO();
        if ($type==="ajouter"){
            $sql = 'INSERT INTO voiture(id, marque, modele, immatriculation, statut, prix) VALUE (" auto "';
            foreach ($parametres as $parametre) {
                $sql=$sql.', "'.$parametre.'"';
            }
            $sql =$sql.')';
        
        }elseif ($type==="modifier"){
            $sql ='UPDATE voiture SET marque = "'.$parametres[0].'", modele ="'.$parametres[1].'", immatriculation ="'.$parametres[2].'", statut ="'.$parametres[3].'", prix ="'.$parametres[4].'" WHERE id='.$_SESSION["id"];             
        }elseif ($type==="supprimer"){
            $sql = 'DELETE FROM `voiture` WHERE id='.$parametres[0];
        }elseif ($type==="reserver"){
            $sql = 'UPDATE voiture SET statut="0", reservation="'.$_SESSION["connection"].'" WHERE id='.$parametres[0];
        }elseif ($type==="annuler"){
            $sql = 'UPDATE voiture SET statut="1", reservation=null WHERE id='.$parametres[0];
        }
        if ($type==="connection"){
            $sql='SELECT * FROM user WHERE names="'.$parametres[0].'" AND mdp="'.$parametres[1].'"';
            $temp = $pdo->query($sql);
            $resultats=$temp->fetch();
            if(isset($resultats["id"])){
                $_SESSION["co"]=1;
                $_SESSION["connection"]=$resultats["names"];
                if($resultats["admin"]==1){
                    $_SESSION["admin"]=1;
                }else{
                    $_SESSION["admin"]=0;
                }
            }else{
                $_SESSION["co"]=0;
            }
        }
        $pdo->exec($sql);

            
    }
    public function recherche($recherche, $parametre){
        $pdo = Bdd::PDO();
        $recherche=mb_strtolower($recherche);
        $sql2='SELECT * FROM voiture WHERE id='.$parametre;
        $temp2=$pdo->query($sql2);
        $resultats=$temp2->fetch();
        if(mb_strtolower($resultats["marque"])==$recherche OR mb_strtolower($resultats["modele"])==$recherche OR mb_strtolower($resultats["immatriculation"])==$recherche OR $resultats["prix"]==$recherche){
            $_SESSION["recherche"]=1;
        }else{
            
            $_SESSION["recherche"]=0;
        }
    }

}
?>