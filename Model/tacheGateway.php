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

    public function ajouterTache($id, $nom, $desc, $fait)
    {
        $this->con->executeQuery("insert into tache values(:id, :nom, :desc, :fait)", array(
            ':id' => array($id, PDO::PARAM_INT),
            ':nom' => array($nom, PDO::PARAM_STR),
            ':desc' => array($desc, PDO::PARAM_STR),
            ':fait' => array($fait, PDO::PARAM_INT)
        ));
    }
}