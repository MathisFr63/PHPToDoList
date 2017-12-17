<?php
/**
 * Created by PhpStorm.
 * User: Mathis
 * Date: 12/17/2017
 * Time: 5:26 PM
 */

// Sert a rien pour le moment.
class TachesFactory
{
    public static function makeEmpty()
    {
        return new Taches(null, null, null, null);
    }

    public static function make(array $elements) : Taches
    {
        if (isset($elements))
            return new Taches($elements['nom'], $elements['descritpion'], $elements['fait'], $elements['user']);
        return null;
    }

    public static function makeAll(array $elements): array
    {
        $tachesArray = array();
        foreach ($elements as $value)
            $tachesArray [] = new Taches($elements['nom'], $elements['descritpion'], $elements['fait'], $elements['user']);
        return $tachesArray;
    }
}