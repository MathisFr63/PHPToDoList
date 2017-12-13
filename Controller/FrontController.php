<?php

/**
 * Created by PhpStorm.
 * User: Mathis
 * Date: 06/12/2017
 * Time: 10:21
 */
class FrontController
{
//    Je sais pas dans lequel mettre ValidationConnection
<<<<<<< HEAD
    private $userAction = array(NULL, "Deconnexion", "SupprimerTachePrivee", "AddPrivateTask", "AffichageTaches");
    private $unknownAction = array(NULL, "AddPublicTask", "SupprimerTachePublique", "Connexion", "SeConnecter", "AffichageTaches");
=======
    private $userAction = array(NULL, "deconnecter", "SupprimerTachePrivee", "AddPrivateTask", "AffichageTachesPrivees");
    private $unknownAction = array(NULL, "AddPublicTask", "SupprimerTachePublique", "Connexion", "SeConnecter", "AffichageTaches", "ChangerStatusTachePublique");
>>>>>>> 23149cb94ad386568824b61be08649d2a6a142cf

//    Modifier tâche publique dans le unknownAction et modifier tâche privée dans le userAction

    function __construct()
    {
        global $rep, $view; // nécessaire pour utiliser variables globales
        try {
            $action = Nettoyer::nettoyer_string($_REQUEST['action']);
            if (in_array($action, $this->userAction)) {
                print "UserAction<BR>";
                $admin = AdminModel::isAdmin();
                print "Admin ? " . (isset($admin)?"OUI":"NON") . "<BR>";
                if ($admin == NULL) {
//                if (!AdminModel::isAdmin()) {
                    new Controller();
                } else
                    new CtrlAdmin();
            } else if (in_array($action, $this->unknownAction)) {
                print "UnknownAction<BR>";
                new Controller();
            } else {
                $dVueEreur[] = "Action Inconnue";
                require($rep . $view['erreur']);
            }
        } Catch (Exception $e) {
            $dVueEreur[] = $e->getMessage;
            require($rep . $view['erreur']);
        }
    }
}