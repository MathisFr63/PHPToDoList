<?php
/**
 * Created by PhpStorm.
 * User: Mathis
 * Date: 12/5/2017
 * Time: 7:50 PM
 */

class ModelConnecte
{
    private $tPg;

    public function __construct()
    {
        $this->tPg = new tacheGateway(new Connection('mysql:host=localhost;dbname=dbmafrizot1', 'root', ''));
    }

    function get_data() : array
    {
        return $this->tPg->afficherTache("mafrizot1");
    }
}