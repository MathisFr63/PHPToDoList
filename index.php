<?php
//si controller pas objet
//  header('Location: controller/controller.php');

//si controller objet

//chargement config
require_once(__DIR__ . '/config/config.php');

//chargement autoloader pour autochargement des classes
require_once(__DIR__ . '/config/Autoload.php');
print "Je suis la page index";
Autoload::charger();
//Maintenant :
$_GET['action'] = "ValidationConnection";
$cont = new FrontController();
//$cont = new CtrlAdmin();
?>