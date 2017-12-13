<?php

/**
 * Created by PhpStorm.
 * User: bepereiraa
 * Date: 29/11/17
 * Time: 15:07
 */
class User
{

    private $identifiant;

    public function __construct($id)
    {
        $this->identifiant = $id;
    }
}