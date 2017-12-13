<?php

require_once(__DIR__ . '/config/config.php');

require_once(__DIR__ . '/config/Autoload.php');

print "Je suis la page index";

Autoload::charger();

$cont = new FrontController();