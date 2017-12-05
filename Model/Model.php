<?php

class Model
{
    private $tg;

    public function __construct()
    {
        $this->tg = new tacheGateway(new Connection('mysql:host=localhost;dbname=dbmafrizot1', 'root', ''));
    }

    function get_data() : array
    {
        return $this->tg->afficherTache();
    }

    function get_data_co() : array
    {
        return $this->tPg->afficherTache("mafrizot1");
    }
}

?>