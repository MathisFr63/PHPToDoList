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


    public static function seConnecter($login, $mdp) : bool {
        $login=Nettoyer::nettoyer_string($login);
        $mdp=Nettoyer::nettoyer_string($mdp);
        if (userGateway::getPass($login, $mdp)) {
            $_SESSION['role'] = 'admin';
            $_SESSION['login'] = $login;
            return true;
        }
        return false;
    }

    public function __construct()
    {
        global $host, $base, $login, $mdp;
//        $this->tPg = new tachePGateway(new Connection('mysql:host=localhost;dbname=dbmafrizot1', 'root', ''));
        $this->tPg = new tachePGateway(new Connection('mysql:host='.$host.';dbname='.$base, $login, $mdp));
//        $this->userG = new userGateway(new Connection('mysql:host=localhost;dbname=dbmafrizot1', 'root', ''));
        //        $this->userG = new userGateway(new Connection('mysql:host=hina;dbname=dbmafrizot1', 'mafrizot1', 'mafrizot1'));
    }

//    public function connexion($login, $mdp): bool
//    {
//        session_unset();
//        session_destroy();
//        $login = $_POST['name'];
//        $mdp = $_POST['mdp'];
//        if (userGateway::getPass($login, $mdp)) {
//            $_SESSION['role'] = 'admin';
//            $_SESSION['login'] = $login;
//        }
//    }

    public static function deconnexion()
    {
        session_unset();
        session_destroy();
        $_SESSION = array();
    }

    public function isAdmin()
    {
        if (isset($_SESSION['login']) && isset($_SESSION['role'])) {
            $login = Nettoyer::nettoyer_string($_SESSION['login']);
            $role = Nettoyer::nettoyer - string($_SESSION['role']);
            return new User($login, $role);
        } else
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