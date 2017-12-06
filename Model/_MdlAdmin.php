<?php
/**
 * Created by PhpStorm.
 * User: Mathis
 * Date: 12/5/2017
 * Time: 7:50 PM
 */

class MdlAdmin
{
    private $tPg;
    // Identifiant de la personne connectée.
    private $id;

    public function __construct()
    {
        $this->tPg = new tacheGateway(new Connection('mysql:host=localhost;dbname=dbmafrizot1', 'root', ''));
    }
//
//    function get_data() : array
//    {
//        return $this->tPg->afficherTache("mafrizot1");
//    }
//
//    function get_data_co() : array
//    {
//        return $this->tPg->afficherTache("mafrizot1");
//    }
}