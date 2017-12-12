<?php
/**
 * Created by PhpStorm.
 * User: Mathis
 * Date: 06/12/2017
 * Time: 10:21
 */

class FrontController
{
    private $userAction = array("deconnecter", "SupprimerTachePrivee", "AddPrivateTask", "modifierPrive", "ValidationConnection", "DemandeConnection");
    private $unknownAction = array("connecter", "supprimerPublic", "ajouterPublic", "modifierPublic");

    function __construct()
    {
        global $rep, $view; // nécessaire pour utiliser variables globales
        try {
//            $action = Nettoyer($_GET['Action']);
            $action = $_GET['action'];
//            if (!isset($action))
//                $action = "ValidationConnection";
            if (in_array($action, $this->userAction)) {
                print "UserAction";
                if (!MdlUser::isAdmin()) {
//                    $_REQUEST['action'] = "ValidationConnection";
                    new Controller();
                } else
                    new CtrlAdmin();
            } else {
                if (in_array($action, $this->unknownAction)) {
                    new Controller();
                } else {
                    $dVueEreur[] = "Action Inconnue";
                    require($rep . $view['erreur']);
                }
            }
        } Catch (Exception $e) {
            $dVueEreur[] = $e->getMessage;
            require($rep . $view['erreur']);
        }
    }
}