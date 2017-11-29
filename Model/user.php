<?php

/**
 * Created by PhpStorm.
 * User: bepereiraa
 * Date: 29/11/17
 * Time: 15:07
 */
class user
{

    private $identifiant;
    private $mdp;
    private $nom;
    private $prenom;

    public function __construct($id, $mdp, $nom, $prenom)
    {
        $this->identifiant = $id;
        $this->mdp = $mdp;
        $this->nom = $nom;
        $this->prenom = $prenom;

    }
}