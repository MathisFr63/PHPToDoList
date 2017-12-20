<?php
/**
 * Created by PhpStorm.
 * User: Mathis
 * Date: 20/12/2017
 * Time: 11:18
 */

class TacheFactory
{
//    public static function makeEmpty(): ?Taches
    public static function createNul()
    {
        return new Taches(NULL, NULL, NULL, NULL);
    }

//    public static function make(array $element): ?Taches
    public static function create(array $element)
    {
        if (isset($element))
            return new Taches($element['id'], $element['nom'], $element['description'], $element['status'], element['user']);
        return null;
    }

    public static function createAll(array $elements): array
    {
        $newsArray = array();
        foreach ($elements as $element)
            $newsArray [] = new Taches($element['id'], $element['nom'], $element['description'], $element['status'], element['user']);
        return $newsArray;
    }
}