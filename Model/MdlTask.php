<?php

class MdlTask
{
    private $tPg;

    public function __construct()
    {
        $this->tPg = new tachePGateway(new Connection('mysql:host=localhost;dbname=dbmafrizot1', 'root', ''));
//        $this->tPg = new tachePGateway(new Connection('mysql:host=hina;dbname=dbmafrizot1', 'mafrizot1', 'mafrizot1'));
    }

    function get_tasks_public(): array
    {
        return $this->tPg->afficherTaches();
    }

    function get_tasks_user($login): array
    {
        return $this->tPg->afficherTachesUser($login);
    }

    function ajouterTachePublique($nom, $desc)
    {
        $this->tPg->ajouterTachePublique($nom, $desc);
    }

    function ajouterTachePrivee($nom, $desc, $user)
    {
        $this->tPg->ajouterTachePrivee($nom, $desc, $user);
    }

    function supprimerTachePublique($idTache)
    {
        $this->tPg->supprimerTachePublique($idTache);
    }

    function SupprimerTachePrivee($idTache, $user)
    {
        $this->tPg->SupprimerTachePrivee($idTache, $user);
    }
}

?>