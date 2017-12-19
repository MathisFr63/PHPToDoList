<?php
/**
 * Created by PhpStorm.
 * User: mafrizot1
 * Date: 15/11/17
 * Time: 15:17
 */

//Sert a rien pour le moment.
class Taches
{
    private $nom;
    private $description;
    private $fait;
    private $user;

    public function __construct(string $nom, string $desc, string $fait, string $user)
    {
        $this->nom = $nom;
        $this->description = $desc;
        $this->fait = $fait;
        $this->user = $user;
    }
}