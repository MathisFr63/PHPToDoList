<?php
/**
 * Created by PhpStorm.
 * User: Mathis
 * Date: 13/12/2017
 * Time: 10:18
 */

class Nettoyer
{
    public static function nettoyer_string($input): string
    {
        return filter_var($input, FILTER_SANITIZE_STRING);
    }

    public static function nettoyer_int($input): int
    {
        return Validation::isNumber($input) ? $input : 1;
    }
}