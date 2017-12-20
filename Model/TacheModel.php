<?php

class TacheModel
{
    private $tPg;

    public function __construct()
    {
        global $host, $base, $identifiant, $pass;
        $this->tPg = new tacheGateway(new Connection('mysql:host=' . $host . ';dbname=' . $base, $identifiant, $pass));
    }

    function get_tasks_public_avec_pages(int $premiereTache, int $derniereTache)
    {
        return $this->tPg->get_tasks_public_avec_pages($premiereTache, $derniereTache);
    }

    function get_tasks_user_avec_pages(string $login, int $premiereTachePrivee, int $derniereTachePrivee): array
    {
        return $this->tPg->get_tasks_user_avec_pages($login, $premiereTachePrivee, $derniereTachePrivee);
    }

    public function getNbTaches(): int
    {
        return $this->tPg->getNbTachesTotal();
    }

    function getNbTachesPrivees(): int
    {
        return $this->tPg->getNbTachesPriveesTotal();

    }

    function ajouterTachePublique(string $nom, string $desc)
    {
        $this->tPg->ajouterTachePublique($nom, $desc);
    }

    function ajouterTachePrivee(string $nom, string $desc, string $user)
    {
        if ($_SESSION['role'] == 'admin') {
            $this->tPg->ajouterTachePrivee($nom, $desc, $user);
        }
    }

    function supprimerTachePublique(int $idTache)
    {
        $this->tPg->supprimerTachePublique($idTache);
    }

    function SupprimerTachePrivee(int $idTache, string $user)
    {
        if ($_SESSION['role'] == 'admin') {
            $this->tPg->SupprimerTachePrivee($idTache, $user);
        }
    }

    function UpdateStatusPublic(int $idTache, bool $status)
    {
        $this->tPg->UpdateStatusPublic($idTache, $status);
    }

    function UpdateStatusPrivee(int $idTache, bool $status)
    {
        if ($_SESSION['role'] == 'admin') {
            $this->tPg->UpdateStatusPrivee($idTache, $status);
        }
    }
}