<?php
class Bdd{
    private $host;
    private $db ;
    private $user ;
    private $pass ;
    private $port ;
    private $charset;

    public static function PDO(){
        $host = '127.0.0.1';
        $db = "location_voiture";
        $user = "root";
        $pass = "";
        $port = '3306';
        $charset = 'utf8mb4';
        $options = [
            PDO::ATTR_ERRMODE=>\PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE=>\PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES=>false,
        ];
        
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset;port=$port";
        try{
            $pdo = new PDO($dsn,$user,$pass,$options);
        
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }   
        return $pdo;
    }

}

?>
