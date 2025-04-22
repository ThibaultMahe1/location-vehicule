<?php
session_start();
$_SESSION["co"]=0;
require_once("../objet/Commande.php");
require_once("../image_et_style/header.php");
require_once("../back/commande_sql_admin.php");
?>
<body>
    <body>
        <div class="contner connection">
        <?php
        if($_SESSION["co"]==0){
            echo '<form action="" method="post">
            
                    <input type="hidden" name="type" value="connection">
                    <label for="identifiant">identifiant</label>
                    <input type="text" id="identifiant" name="identifiant">
                    <label for="mdp">mots de passe</label>
                    <input type="password" id="mdp" name="mdp">
                    <input type="submit" value="log in" class="bouton">
                </form>';

            

        }else if($_SESSION["co"]==1){
            header('Location: ../index.php');
        }
        ?>
        </div>
    </body>
</body>
</html>