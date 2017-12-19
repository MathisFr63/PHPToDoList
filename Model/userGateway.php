<?php

/**
 * Created by PhpStorm.
 * User: bepereiraa
 * Date: 29/11/17
 * Time: 15:07
 */
class userGateway
{
    private $con;

    public function __construct(Connection $con)
    {
        $this->con = $con;
    }

    static function getPass(string $login, string $mdp): bool
    {
        try {
            global $host, $base, $identifiant, $pass;
            $con = new Connection('mysql:host=' . $host . ';dbname=' . $base, $identifiant, $pass);

            $con->executeQuery('select identifiant from user where identifiant = :login and mdp = :mdp',
                array(
                    ':login' => array($login, PDO::PARAM_STR),
                    ':mdp' => array($mdp, PDO::PARAM_STR)
                )
            );
            $tmp = $con->getResults();
            if (isset($tmp) and count($tmp) == 1) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            throw new Exception($e);
        }
    }
}