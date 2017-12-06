<?php

/**
 * Created by PhpStorm.
 * User: bepereiraa
 * Date: 29/11/17
 * Time: 15:07
 */
class userGateway
{
    private $con;

    public function __construct(Connection $con)
    {
        $this->con = $con;
    }

    public function ajouterUser($id, $mdp, $nom, $prenom)
    {
        $this->con->executeQuery("insert into user(identifiant, mdp, nom, prenom) values(:id, :mdp, :nom, :prenom)", array(
            ':id' => array($id, PDO::PARAM_STR),
            ':mdp' => array($mdp, PDO::PARAM_STR),
            ':nom' => array($nom, PDO::PARAM_STR),
            ':prenom' => array($prenom, PDO::PARAM_STR)
        ));
    }

    public function supprimerUser($id)
    {
        $this->con->executeQuery("delete from user where identifiant = :id", array(':id' => array($id, PDO::PARAM_STR)));
    }

    public function modifierUser($id, $mdp, $nom, $prenom)
    {
        $this->con->executeQuery("update user set mdp = :mdp nom = :nom, prenom = :prenom where identifiant = :id", array(
            ':id' => array($id, PDO::PARAM_STR),
            ':mdp' => array($mdp, PDO::PARAM_STR),
            ':nom' => array($nom, PDO::PARAM_STR),
            ':prenom' => array($prenom, PDO::PARAM_STR)
        ));
    }
}
