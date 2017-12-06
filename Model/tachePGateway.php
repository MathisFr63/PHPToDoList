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

    public function ajouterTachePublique($nom, $desc)
    {
<<<<<<< HEAD
        $this->con->executeQuery("insert into tache(nom, description, status) values(:nom, :desc, 0)", array(
            ':nom' => array($nom, PDO::PARAM_STR),
            ':desc' => array($desc, PDO::PARAM_STR)
        ));
    }

    public function ajouterTachePrivee($nom, $desc, $user)
    {
        $this->con->executeQuery("insert into tachep(nom, description, status, user) values(:nom, :description, 0, :user)", array(
=======
        $this->con->executeQuery("insert into tacheP(nom, description, status, user) values(:nom, :description, :status, :user)", array(
>>>>>>> 7907d0f0fed660d4eb50d8a897871996a2930d71
            ':nom' => array($nom, PDO::PARAM_STR),
            ':description' => array($desc, PDO::PARAM_STR),
            ':user' => array($user, PDO::PARAM_STR)
        ));
    }

    public function supprimerTache($id)
    {
        $this->con->executeQuery("delete from tacheP where id = :id", array(':id' => array($id, PDO::PARAM_INT)));
    }

    public function modifierTache($id, $nom, $desc, $status, $user)
    {
        $this->con->executeQuery("update tacheP set nom = :nom, description = :description, status = :status, user = :user where id = :id", array(
            ':id' => array($id, PDO::PARAM_INT),
            ':nom' => array($nom, PDO::PARAM_STR),
            ':description' => array($desc, PDO::PARAM_STR),
            ':status' => array($status, PDO::PARAM_INT),
            ':user' => array($user, PDO::PARAM_STR)
        ));
    }

    public function afficherTaches() : array
    {
        $this->con->executeQuery('select * from tache');
        return $this->con->getResults();
    }

    public function afficherTachesUser($login) : array
    {
<<<<<<< HEAD
        $this->con->executeQuery("select * from tacheP where user = :user", array(':user' => array($login, PDO::PARAM_STR)));
=======
        $this->con->executeQuery("select * from tacheP where user = :user", array(':user' => array($user, PDO::PARAM_STR)));
>>>>>>> 7907d0f0fed660d4eb50d8a897871996a2930d71
//        $this->con->executeQuery('select * from tache');
        return $this->con->getResults();
    }
}
