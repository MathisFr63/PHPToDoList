<?php
/**
 * Created by PhpStorm.
 * User: mafrizot1
 * Date: 15/11/17
 * Time: 13:56
 */

$login = "mafrizot1";

function recupererDonnees()
{
}

$dsn = 'mysql:host=hina;dbname=dbmafrizot1';

try{
    $db = new PDO($dsn, $login, $login);

    //$query = "insert into tache values(2, 'Manger', 'Manger de 12h à 14h', 0)";
    //$stmt=$db->prepare($query);
    //$stmt->execute();


    $query = "select * from tache";
    $stmt=$db->prepare($query);
    $stmt->execute();
    $results = $stmt->fetchAll();
    foreach($results as $row){
        print $row['nom'];
        print " : ";
        print $row['description'];
        print "<BR>";
    }

    $query = "select * from tache where id = 1";
    $stmt=$db->prepare($query);
    $stmt->execute();
    $results = $stmt->fetchAll();
    foreach($results as $row){
        print $row['nom'];
        print "<BR>";
    }

    $query = "update tache set nom='Manger' where id = 2";
    $stmt=$db->prepare($query);
    $stmt->execute();

    $query = "select * from tache where id = 2";
    $stmt=$db->prepare($query);
    $stmt->execute();
    $results = $stmt->fetchAll();
    foreach($results as $row){
        print $row['nom'];
        print "<BR>";
    }
    $results = $stmt->fetchAll();
    foreach($results as $row){
        print $row['nom'];
        print "<BR>";
    }

}catch(PDOException $e){
    echo 'erreur2';
}