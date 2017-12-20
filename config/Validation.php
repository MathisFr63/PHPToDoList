<?php

class Validation
{
    static function val_ajout(string $nom, string $desc, array $dVueEreur)
    {
        if (!isset($nom) || $nom == "") {
            $dVueEreur[] = "Pas de nom";
            $nom = "";
        }

        if (!isset($desc) || $desc == "") {
            $dVueEreur[] = "Pas de description";
            $desc = "";
        }

        // Ici mettre le code pour vérifier l'identifiant et le mot de passe.

        if ($nom != filter_var($nom, FILTER_SANITIZE_STRING)) {
            $dVueEreur[] = "tentative d'injection de code (attaque sécurité)";
            $nom = "";
        }

        // Je comprends pas trop à quoi ça sert.
        if ($desc != filter_var($desc, FILTER_SANITIZE_STRING)) {
            $dVueEreur[] = "tentative d'injection de code (attaque sécurité)";
            $desc = "";
        }
    }

    static function val_addPrivate(string $nom, string $desc, string $user, array $dVueEreur)
    {
        if (!isset($nom) || $nom == "") {
            $dVueEreur[] = "Pas de nom";
            $id = "";
        }

        if (!isset($desc) || $desc == "") {
            $dVueEreur[] = "Pas de description";
            $mdp = "";
        }

        if (!isset($user) || $user == "") {
            $dVueEreur[] = "Pas d'utilisateur";
            $user = "";
        }

        // Ici mettre le code pour vérifier l'identifiant et le mot de passe.

        if ($nom != filter_var($nom, FILTER_SANITIZE_STRING)) {
            $dVueEreur[] = "tentative d'injection de code (attaque sécurité)";
            $id = "";
        }

        // Je comprends pas trop à quoi ça sert.
        if ($desc != filter_var($desc, FILTER_SANITIZE_STRING)) {
            $dVueEreur[] = "tentative d'injection de code (attaque sécurité)";
            $desc = "";
        }

        if ($user != filter_var($user, FILTER_SANITIZE_STRING)) {
            $dVueEreur[] = "tentative d'injection de code (attaque sécurité)";
            $user = "";
        }
    }

    public static function isNumber($input): bool
    {
        if (filter_var($input, FILTER_VALIDATE_INT))
            return true;
        return false;
    }
}