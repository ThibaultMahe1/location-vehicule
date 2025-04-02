<?php
require("Bdd.php");
class Vehicule extends Bdd{
    public $id;
    public $marque;
    public $modele;
    public $immatriculation;
    public $statut;
    public $prix;

    public function __construct(array $row = []) 
    {
        $this->id = $row["id"];
        $this->marque = $row["marque"] ?? null;
        $this->modele = $row["modele"] ?? null;
        $this->immatriculation = $row["immatriculation"] ?? null;
        $this->statut = $row["statut"] ?? null;
        $this->prix = $row["prix"] ?? null;
    }
    
public static function all()
{

    $pdo = Bdd::PDO();

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