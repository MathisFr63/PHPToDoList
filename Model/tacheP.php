<?php

/**
 * Created by PhpStorm.
 * User: bepereiraa
 * Date: 29/11/17
 * Time: 15:00
 */
class tacheP
{
    private $id;
    private $nom;
    private $description;
    private $fait;
    private $user;

    public function __construct($id, $nom, $desc, $fait, $user)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->description = $desc;
        $this->fait = $fait;
        $this->user = $user;
    }
}