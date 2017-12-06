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
    private $admin;

    public function __construct($id, $mdp, $nom, $prenom, $admin)
    {
        $this->identifiant = $id;
        $this->mdp = $mdp;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->admin = $admin;

    }
}