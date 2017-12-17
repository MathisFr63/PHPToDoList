<?php

/**
 * Created by PhpStorm.
 * User: Mathis
 * Date: 12/5/2017
 * Time: 7:50 PM
 */
class AdminModel
{
    private $tPg;
//    private $userG;
    // Identifiant de la personne connectée.
    private $id;
    private $admin = false;

    public function __construct()
    {
        global $host, $base, $identifiant, $pass;
        $this->tPg = new tacheGateway(new Connection('mysql:host='. $host . ';dbname='.$base, $identifiant, $pass));
    }


    public static function seConnecter($login, $mdp)
    {
        $login = Nettoyer::nettoyer_string($login);
        $mdp = Nettoyer::nettoyer_string($mdp);
//        Pour récupérer le mot de passe et le mettre a l'iut :
//        10e151b0e07706239a9888cfe81218f3
        if (userGateway::getPass($login, hash("ripemd128", $mdp))) {
            $_SESSION['login'] = $login;
            $_SESSION['role'] = 'admin';
            return new User($login);
        }
        return NULL;
    }

    public static function deconnexion()
    {
        session_unset();
        session_destroy();
        $_SESSION = array();
    }


    public static function isAdmin() {
        if(isset($_SESSION['login']) && isset($_SESSION['role']))
            return new User(Nettoyer::nettoyer_string($_SESSION['login']));
        else
            return null;
    }

    function get_tasks_public(): array
    {
        return $this->tPg->afficherTaches();
    }

    function get_tasks_user($login): array
    {
        if ($_SESSION['role'] == 'admin') {
            return $this->tPg->afficherTachesUser($login);
        }
    }
}