<?php

/**
 * Created by PhpStorm.
 * User: bepereiraa
 * Date: 29/11/17
 * Time: 15:00
 */
class tacheGateway
{
    private $con;

    public function __construct(Connection $con)
    {
        $this->con = $con;
    }

    public function ajouterTachePublique(string $nom, string $desc)
    {
        $this->con->executeQuery("insert into tache(nom, description, status) values(:nom, :desc, 0)", array(
            ':nom' => array($nom, PDO::PARAM_STR),
            ':desc' => array($desc, PDO::PARAM_STR)
        ));
    }

    public function ajouterTachePrivee(string $nom, string $desc, string $user)
    {
        $this->con->executeQuery("insert into tachep(nom, description, status, user) values(:nom, :description, 0, :user)", array(
            ':nom' => array($nom, PDO::PARAM_STR),
            ':description' => array($desc, PDO::PARAM_STR),
            ':user' => array($user, PDO::PARAM_STR)
        ));
    }

    public function supprimerTachePublique(int $id)
    {
        $this->con->executeQuery("delete from tache where id = :id", array(':id' => array($id, PDO::PARAM_INT)));
    }

    public function SupprimerTachePrivee(int $id, string $user)
    {
        $this->con->executeQuery("delete from tachep where user = :user and id = :id", array(':user' => array($user, PDO::PARAM_STR), ':id' => array($id, PDO::PARAM_INT)));
    }

    public function UpdateStatusPublic(int $id, bool $status)
    {
        $this->con->executeQuery("update tache set status = :status where id = :id", array(':status' => array($status, PDO::PARAM_BOOL), ':id' => array($id, PDO::PARAM_INT)));
    }

    public function UpdateStatusPrivee(int $id, bool $status)
    {
        $this->con->executeQuery("update tachep set status = :status where id = :id", array(':status' => array($status, PDO::PARAM_BOOL), ':id' => array($id, PDO::PARAM_INT)));
    }

    public function modifierTache(int $id, string $nom, string $desc, bool $status, string $user)
    {
        $this->con->executeQuery("update tachep set nom = :nom, description = :description, status = :status, user = :user where id = :id", array(
            ':id' => array($id, PDO::PARAM_INT),
            ':nom' => array($nom, PDO::PARAM_STR),
            ':description' => array($desc, PDO::PARAM_STR),
            ':status' => array($status, PDO::PARAM_INT),
            ':user' => array($user, PDO::PARAM_STR)
        ));
    }

    public function afficherTaches(): array
    {
        $this->con->executeQuery('select * from tache');
        return $this->con->getResults();
    }

    public function afficherTachesUser(string $login): array
    {
        $this->con->executeQuery("select * from tachep where user = :user", array(':user' => array($login, PDO::PARAM_STR)));
        return $this->con->getResults();
    }

    public function getNbTachesTotal(): int
    {
        $this->con->executeQuery('select COUNT(id) from tache');
        return $this->con->getFirst()['COUNT(id)'];
    }

    public function getNbTachesPriveesTotal(): int
    {
        $this->con->executeQuery('select COUNT(id) from tachep');
        return $this->con->getFirst()['COUNT(id)'];
    }

    function get_tasks_public_avec_pages(int $premiereTache, int $derniereTache): array
    {
        $this->con->executeQuery('select * from tache ORDER BY id LIMIT :premiereTache, :derniereTache', array(':premiereTache' => array($premiereTache, PDO::PARAM_INT), ':derniereTache' => array($derniereTache, PDO::PARAM_INT)));
        return $this->con->getResults();
    }

    function get_tasks_user_avec_pages(string $login, int $premiereTachePrivee, int $derniereTachePrivee): array
    {
        $this->con->executeQuery('select * from tachep where user = :user ORDER BY id LIMIT :premiereTache, :derniereTache', array(':user' => array($login, PDO::PARAM_STR), ':premiereTache' => array($premiereTachePrivee, PDO::PARAM_INT), ':derniereTache' => array($derniereTachePrivee, PDO::PARAM_INT)));
        return $this->con->getResults();
    }
}
