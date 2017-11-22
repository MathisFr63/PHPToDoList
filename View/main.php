<?php
/**
 * Created by PhpStorm.
 * User: mafrizot1
 * Date: 15/11/17
 * Time: 14:55
 */

require_once('../Model/Connection.php');

$db = new Connection('mysql:host=hina;dbname=dbmafrizot1', "mafrizot1", "mafrizot1");

try{
    $db->afficherTache();
    // $db->ajouterTache(3, "Doucher", "Bien se doucher tous les soirs", 0);
    print "------------------------------------------------------------------------------------------------------------------<BR>";
    $db->afficherTache();
    print "------------------------------------------------------------------------------------------------------------------<BR>";
}catch(PDOException $e){
    echo 'erreur';
}