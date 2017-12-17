<?php

class TacheModel
{
    private $tPg;

    public function __construct()
    {
        global $host, $base, $identifiant, $pass;
        $this->tPg = new tacheGateway(new Connection('mysql:host=' . $host . ';dbname=' . $base, $identifiant, $pass));
    }

    function get_tasks_public(): array
    {
        return $this->tPg->afficherTaches();
    }

    public function getNbTaches(): int
    {
        return $this->tPg->getNbTaches();
    }


    function get_tasks_user($login): array
    {
        if ($_SESSION['role'] == 'admin') {
            return $this->tPg->afficherTachesUser($login);
        }
    }

    function ajouterTachePublique($nom, $desc)
    {
        $this->tPg->ajouterTachePublique($nom, $desc);
    }

    function ajouterTachePrivee($nom, $desc, $user)
    {
        if ($_SESSION['role'] == 'admin') {
            $this->tPg->ajouterTachePrivee($nom, $desc, $user);
        }
    }

    function supprimerTachePublique($idTache)
    {
        $this->tPg->supprimerTachePublique($idTache);
    }

    function SupprimerTachePrivee($idTache, $user)
    {
        if ($_SESSION['role'] == 'admin') {
            $this->tPg->SupprimerTachePrivee($idTache, $user);
        }
    }

    function UpdateStatusPublic($idTache, $status)
    {
        $this->tPg->UpdateStatusPublic($idTache, $status);
    }

    function UpdateStatusPrivee($idTache, $status)
    {
        if ($_SESSION['role'] == 'admin') {
            $this->tPg->UpdateStatusPrivee($idTache, $status);
        }
    }
}

?>