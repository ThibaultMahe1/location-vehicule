<?php
session_start();
include("liaisonPHP-SQL.php");
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
        <?php
        if($connection==0){
            echo '<form action="" method="post">
                    <label for="identifiant">identifiant</label>
                    <input type="text" id="identifiant" name="identifiant">
                    <label for="mdp">mots de passe</label>
                    <input type="password" id="mdp" name="mdp">
                    <input type="submit" value="log in">
                </form>';

            

        }else if($connection==1){
            echo '<a href="acceuil">acceder au site</a>';
        }
            ?>
    </body>
    <script src="script.js"></script>
</body>
</html>