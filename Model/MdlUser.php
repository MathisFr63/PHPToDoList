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

<<<<<<< HEAD
    function get_tasks_public() : array
    {
        return $this->tPg->afficherTaches();
    }
=======
//    function get_data() : array
//    {
//        return $this->tPg->afficherTache("mafrizot1");
//    }
>>>>>>> 7907d0f0fed660d4eb50d8a897871996a2930d71

    function get_tasks_user($login) : array
    {
        return $this->tPg->afficherTachesUser($login);
    }
}