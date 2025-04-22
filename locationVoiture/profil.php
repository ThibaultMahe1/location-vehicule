<?php
session_start();
include("image_et_style/header.php");
require("objet/vehicule.php");
require("objet/Commande.php");
$pdo = Bdd::PDO();
include("back/commande_sql_admin.php");
$vehicules = Vehicule::all();
echo "<a href='index.php' class='bouton'>acceuil</a>";
?>

    <body>
        <div class="contner acceuil">
            <?php
            echo '<h1> reservation de '.$_SESSION["connection"].'</h1>';
            ?>
        <table>
            <tr>
                <th>marque</th>
                <th>modèle</th>
                <th>immatriculation</th>
                <th>prix</th>
                <?php
                if ($_SESSION["admin"]==1){
                    echo "<th>reservé par</th>";
                    }
                ?>
            </tr>
        <?php
            foreach($vehicules as $vehicule){
                if ($vehicule->reservation==$_SESSION["connection"] OR ($_SESSION["admin"]==1 AND isset($vehicule->reservation))){
                    echo "<tr><td class='table' >" . $vehicule->marque . "</td>";
                    echo "<td class='table'>" . $vehicule->modele . "</td>";
                    echo "<td class='table'>" . $vehicule->immatriculation . "</td>";
                    echo "<td class='table'>" . $vehicule->prix . " €</td>";
                    if ($_SESSION["admin"]==1){
                    echo "<td class='table'>" . $vehicule->reservation . "  </td>";
                    }
                    if ($vehicule->reservation==$_SESSION["connection"]){ $_SESSION["permition"]=1; }else{$_SESSION["permition"]=0;}
                    if ($_SESSION["permition"]==1){
                    echo'<td><a href="profil.php?type=annuler&id='.$vehicule->id;

                    echo '" class="bouton">annuler</a></td>';  
                }

                }
            }
            

        ?>
    </table>
    </div>
</body>
</html>