<?php

class Validation
{

    static function val_action($action)
    {

        if (!isset($action)) {
            throw new Exception('pas d\'action');
            //on pourrait aussi utiliser
//$action = $_GET['action'] ?? 'no';
            // This is equivalent to:
            //$action =  if (isset($_GET['action'])) $action=$_GET['action']  else $action='no';
        }
    }

    static function val_form(string &$id, string &$mdp, array &$dVueEreur)
    {
        if (!isset($id) || $id == "") {
            $dVueEreur[] = "Pas d'identifiant";
            $id = "";
        }

        if (!isset($mdp) || $mdp == "") {
            $dVueEreur[] = "Pas de mot de passe";
            $mdp = "";
        }

        // Ici mettre le code pour vérifier l'identifiant et le mot de passe.

        if ($id != filter_var($id, FILTER_SANITIZE_STRING)) {
            $dVueEreur[] = "testative d'injection de code (attaque sécurité)";
            $id = "";

        }

        // Je comprends pas trop à quoi ça sert.
        if ($mdp != filter_var($mdp, FILTER_SANITIZE_STRING)) {
            $dVueEreur[] = "testative d'injection de code (attaque sécurité)";
            $mdp = "";

        }
    }
}

?>

        