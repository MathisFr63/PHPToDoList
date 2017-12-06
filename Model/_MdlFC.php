<?php
/**
 * Created by PhpStorm.
 * User: Mathis
 * Date: 06/12/2017
 * Time: 11:29
 */

class MdlFC
{
    private $bd;
    private $tg;
    // Identifiant de la personne connectée.
    private $id;

    public function __construct()
    {
        $this->bd = new Connection('mysql:host=localhost;dbname=dbmafrizot1', 'root', '');
        $this->tg = new tacheGateway($this->bd);
    }

    public function isAdmin($login): bool
    {
        $this->bd->executeQuery('select admin from user where login = :login', array(":login" => array($login, PDO::PARAM_STR)));
        $isAdmin = $this->bd->getResults();
        return $isAdmin;
    }

    function get_data(): array
    {
        return $this->tg->afficherTache();
    }
}