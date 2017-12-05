<?php

/**
 * Created by PhpStorm.
 * User: bepereiraa
 * Date: 29/11/17
 * Time: 15:00
 */
class tachePGateway
{
    private $con;

    public function __construct(Connection $con)
    {
        $this->con = $con;
    }

    public function ajouterTache($nom, $desc, $status, $user)
    {
        $this->con->executeQuery("insert into tachep(nom, description, status, user) values(:nom, :description, :status, :user)", array(
            ':nom' => array($nom, PDO::PARAM_STR),
            ':description' => array($desc, PDO::PARAM_STR),
            ':status' => array($status, PDO::PARAM_INT),
            ':user' => array($user, PDO::PARAM_STR)
        ));
    }

    public function supprimerTache($id)
    {
        $this->con->executeQuery("delete from tachep where id = :id", array(':id' => array($id, PDO::PARAM_INT)));
    }

    public function modifierTache($id, $nom, $desc, $status, $user)
    {
        $this->con->executeQuery("update tachep set nom = :nom, description = :description, status = :status, user = :user where id = :id", array(
            ':id' => array($id, PDO::PARAM_INT),
            ':nom' => array($nom, PDO::PARAM_STR),
            ':description' => array($desc, PDO::PARAM_STR),
            ':status' => array($status, PDO::PARAM_INT),
            ':user' => array($user, PDO::PARAM_STR)
        ));
    }

    public function afficherTache($user)
    {
        $this->con->executeQuery("select * from tachep where user = :user", array(':user' => array($user, PDO::PARAM_STR)));
//        $this->con->executeQuery('select * from tache');
        return $this->con->getResults();
    }
}
