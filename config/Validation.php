<?php

class Validation
{
    static function val_form(string $id, string $mdp, array $dVueEreur): void
    {
        if (!isset($id) || $id == "") {
            $dVueEreur[] = "Pas d'identifiant";
            $id = "";
        }

        if (!isset($mdp) || $mdp == "") {
            $dVueEreur[] = "Pas de mot de passe";
            $mdp = "";
        }

        // Ici mettre le code pour vérifier l'identifiant et le mot de passe.

        if ($id != filter_var($id, FILTER_SANITIZE_STRING)) {
            $dVueEreur[] = "testative d'injection de code (attaque sécurité)";
            $id = "";
        }

        // Je comprends pas trop à quoi ça sert.
        if ($mdp != filter_var($mdp, FILTER_SANITIZE_STRING)) {
            $dVueEreur[] = "testative d'injection de code (attaque sécurité)";
            $mdp = "";
        }
    }

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
            $dVueEreur[] = "testative d'injection de code (attaque sécurité)";
            $nom = "";
        }

        // Je comprends pas trop à quoi ça sert.
        if ($desc != filter_var($desc, FILTER_SANITIZE_STRING)) {
            $dVueEreur[] = "testative d'injection de code (attaque sécurité)";
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
            $dVueEreur[] = "testative d'injection de code (attaque sécurité)";
            $id = "";
        }

        // Je comprends pas trop à quoi ça sert.
        if ($desc != filter_var($desc, FILTER_SANITIZE_STRING)) {
            $dVueEreur[] = "testative d'injection de code (attaque sécurité)";
            $desc = "";
        }

        if ($user != filter_var($user, FILTER_SANITIZE_STRING)) {
            $dVueEreur[] = "testative d'injection de code (attaque sécurité)";
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