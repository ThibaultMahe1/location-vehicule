<?php

class Vehicule{
    public $id;
    public $marque;
    public $modele;
    public $immatriculation;
    public $statut;
    public $prix;

    public function __construct(array $row = []) 
    {
        $this->id = $row["id"] ?? null;
        $this->marque = $row["marque"] ?? null;
        $this->modele = $row["modele"] ?? null;
        $this->immatriculation = $row["immatriculation"] ?? null;
        $this->statut = $row["statut"] ?? null;
        $this->prix = $row["prix"] ?? null;
    }
    
public static function all()
{
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

    $sql = 'SELECT * FROM voiture';
    $temp = $pdo->query($sql);
    $resultats=$temp->fetchALL();

    $vehicules=[];
    foreach($resultats as $row){
        $vehicules[]= new Vehicule($row);
    }
    return $vehicules;
}

}
?>