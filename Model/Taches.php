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
    private $id;
    private $nom;
    private $description;
    private $status;
    private $user;

    public function __construct(int $id, string $nom, string $desc, bool $status, string $user)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->description = $desc;
        $this->status = $status;
        $this->user = $user;
    }

    function  getId(): int
    {
        return $this->id;
    }
    function getStatus(): bool
    {
        return $this->status;
    }

    function getNom(): string
    {
        return $this->nom;
    }

    function getDescription(): string{
        return $this->description;
    }
}