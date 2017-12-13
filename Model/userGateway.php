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

    static function getPass($login, $mdp): bool
    {
        global $host, $base, $identifiant, $pass;
        $con = new Connection('mysql:host='. $host . ';dbname='.$base, $identifiant, $pass);

        $con->executeQuery('select identifiant from user where identifiant = :login and mdp = :mdp',
            array(
                ':login' => array($login, PDO::PARAM_STR),
                ':mdp' => array($mdp, PDO::PARAM_STR)
            )
        );
        $tmp = $con->getResults();
        if (isset($tmp) and count($tmp) == 1) {
            return true;
        }
        return false;
    }
}