<?php

/**
 * Created by PhpStorm.
 * User: mafrizot1
 * Date: 15/11/17
 * Time: 14:51
 */
class Connection extends PDO
{
    private $stmt;

    public function __construct($dsn, $username, $password)
    {
        parent::__construct($dsn, $username, $password);
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function afficherTache(){
        $query = "select * from tache";
        $stmt=$this->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll();
        foreach($results as $row){
            print $row['nom'];
            print " : ";
            print $row['description'];
            print "<BR>";
        }
    }

    public function ajouterTache($id, $nom, $desc, $fait){
        $query = "insert into tache values(?, ?, ?, ?)";
        $stmt=$this->prepare($query);
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->bindValue(2, $nom, PDO::PARAM_STR);
        $stmt->bindValue(3, $desc, PDO::PARAM_STR);
        $stmt->bindValue(4, $fait, PDO::PARAM_INT);
        $stmt->execute();
    }
}