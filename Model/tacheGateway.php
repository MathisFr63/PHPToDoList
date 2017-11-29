<?php

/**
 * Created by PhpSt0orm.
 * User: bepereiraa
 * Date: 22/11/17
 * Time: 15:06
 */
class tacheGateway
{
    private $con;

    public function __construct(Connection $con)
    {
        $this->con = $con;
    }

    public function ajouterTache($nom, $desc, $status)
    {
        $this->con->executeQuery("insert into tache(nom, description, status) values(:nom, :description, :status)", array(
            ':nom' => array($nom, PDO::PARAM_STR),
            ':description' => array($desc, PDO::PARAM_STR),
            ':status' => array($status, PDO::PARAM_INT)
        ));
    }

    public function supprimerTache($id)
    {
        $this->con->executeQuery("delete from tache where id = :id", array(':id' => array($id, PDO::PARAM_INT)));
    }

    public function modifierTache($id, $nom, $desc, $status)
    {
         $this->con->executeQuery("update tache set nom = :nom, description = :description, status = :status where id = :id", array(
            ':id' => array($id, PDO::PARAM_INT),
            ':nom' => array($nom, PDO::PARAM_STR),
            ':description' => array($desc, PDO::PARAM_STR),
            ':status' => array($status, PDO::PARAM_INT)
        ));
    }
}