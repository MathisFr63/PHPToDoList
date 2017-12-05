<?php

class Simplemodel
{
    private $tg;
    // A mettre dans un autre model
    private $tPg;

    public function __construct()
    {
        $this->tg = new tacheGateway(new Connection('mysql:host=localhost;dbname=dbmafrizot1', 'root', ''));
    }

    function get_data() : array
    {
        return $this->tg->afficherTache();
    }

    // A mettre dans un autre model
    function get_data_co() : array
    {
        // À modifier quand l'on aura une vraie connexion.
        $this->tPg = new tachePGateway(new Connection('mysql:host=localhost;dbname=dbmafrizot1', 'root', ''));
        return $this->tPg->afficherTache("mafrizot1");
//        return $this->tPg->afficherTache();
    }
}

?>