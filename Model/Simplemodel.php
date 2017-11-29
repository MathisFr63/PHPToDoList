<?php

class Simplemodel
{
    private $tg;

    public function __construct()
    {
        $this->tg = new tacheGateway(new Connection('mysql:host=hina;dbname=dbmafrizot1', 'mafrizot1', 'mafrizot1'));
    }

    function get_data() : array
    {
        return $this->tg->afficherTache();
    }
}

?>