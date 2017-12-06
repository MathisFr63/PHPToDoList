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

        // Test de récupération de la personne dans la base.
        // Sûrement à mettre autre part !!! par exemple dans le model du FC.
        $bd = new Connection('mysql:host=localhost;dbname=dbmafrizot1', 'root', '');
        $bd->executeQuery('select * from user where identifiant = :id and mdp = :mdp', array(
            ':id' => array($id, PDO::PARAM_STR),
            ':mdp' => array($mdp, PDO::PARAM_STR)));
        if ($bd->getResults() == null) {
            $dVueEreur[] = "La combinaison identifiant, mot de passe n'est liée à aucun utilisateur";
            $mdp = "";
        }
    }
}

?>

        