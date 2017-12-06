<?php
//si controller pas objet
//  header('Location: controller/controller.php');

//si controller objet

//chargement config
require_once(__DIR__ . '/config/config.php');

//chargement autoloader pour autochargement des classes
require_once(__DIR__ . '/config/Autoload.php');
Autoload::charger();

print "Je suis l'index !";

//$cont = new Controller();
//$cont = new ControllerConnecte();

//Maintenant :
$cont = new FrontController();
?>