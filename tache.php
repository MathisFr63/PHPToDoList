<?php

/**
 * Created by PhpStorm.
 * User: mafrizot1
 * Date: 15/11/17
 * Time: 15:17
 */
class tache
{
    private $id;
    private $nom;
    private $description;
    private $fait;

    public function __construct($id, $nom, $desc, $fait)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->description = $desc;
        $this->fait = $fait;
    }
}