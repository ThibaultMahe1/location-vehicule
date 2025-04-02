<?php
session_start();
include("header.php");
include("liaisonPHP-SQL.php");
include("back_connection.php");
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
    <body>
        <div class="contner connection">
        <?php
        if($connection==0){
            echo '<form action="" method="post">
                    <label for="identifiant">identifiant</label>
                    <input type="text" id="identifiant" name="identifiant">
                    <label for="mdp">mots de passe</label>
                    <input type="password" id="mdp" name="mdp">
                    <input type="submit" value="log in" class="bouton">
                </form>';

            

        }else if($connection==1){
            header('Location: acceuil.php');
        }
        ?>
        </div>
    </body>
    <script src="script.js"></script>
</body>
</html>