<?php
/**
 * Created by PhpStorm.
 * User: Mathis
 * Date: 12/5/2017
 * Time: 7:50 PM
 */

class MdlUser
{
    private $tPg;
    // Identifiant de la personne connectée.
    private $id;

    public function __construct()
    {
//        $this->tPg = new tacheGateway(new Connection('mysql:host=localhost;dbname=dbmafrizot1', 'root', ''));
        $this->tPg = new tacheGateway(new Connection('mysql:host=hina;dbname=dbmafrizot1', 'mafrizot1', 'mafrizot1'));
    }

    function get_tasks_public() : array
    {
        return $this->tPg->afficherTaches();
    }

    function get_tasks_user($login) : array
    {
        return $this->tPg->afficherTachesUser($login);
    }
}