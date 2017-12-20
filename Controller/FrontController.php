<?php

/**
 * Created by PhpStorm.
 * User: Mathis
 * Date: 06/12/2017
 * Time: 10:21
 */
class FrontController
{
    private $userAction = array(NULL, "Deconnexion", "SupprimerTachePrivee", "AddPrivateTask", "AffichageTaches", "UpdateStatusPrivee");
    private $unknownAction = array(NULL, "AddPublicTask", "SupprimerTachePublique", "Connexion", "SeConnecter", "AffichageTaches", "UpdateStatusPublic");

    function __construct()
    {
        global $rep, $view;
        try {
            $action = Nettoyer::nettoyer_string($_REQUEST['action']);
            if (in_array($action, $this->userAction)) {
                $admin = AdminModel::isAdmin();
                if ($admin == NULL) {
                    new Controller();
                } else
                    new CtrlAdmin();
            } else if (in_array($action, $this->unknownAction)) {
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