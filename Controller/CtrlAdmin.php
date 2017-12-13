<?php

class CtrlAdmin
{

    function __construct()
    {
        global $rep, $view; // nécessaire pour utiliser variables globales


        $dVueEreur = array();

        try {
            $action = $_REQUEST['action'];
            switch ($action) {
                case NULL:
                    $this->AffichageTachesPrivees();
                    break;

                case "AffichageTaches":
                    $this->AffichageTachesPrivees();
                    break;

                case "Deconnexion":
                    $this->Deconnexion();
                    break;

                case "ValidationConnection":
                    $this->ValidationConnection($dVueEreur);
                    break;

                case "AddPrivateTask":
                    $this->AddPrivateTask();
                    break;

                case "SupprimerTachePrivee" :
                    $this->SupprimerTachePrivee();
                    break;

                default:
                    $dVueEreur[] = "Erreur d'appel php";
                    require($rep . $view['erreur']);
                    break;
            }

        } catch (PDOException $e) {
            $dVueEreur[] = "Erreur inattendue!!! PDO";
            require($rep . $view['erreur']);

        } catch (Exception $e2) {
            $dVueEreur[] = "Erreur inattendue!!! ";
            require($rep . $view['erreur']);
        }
        exit(0);
    }

    function Reinit()
    {
        header('Location: index.php?action=AffichageTaches');
    }

    function AffichageTachesPrivees()
    {
        global $rep, $view;

        $id = $_SESSION['login'];

        $model = new TacheModel();
        $taches = $model->get_tasks_public();
        $tachesCo = $model->get_tasks_user($id);

        $dVue = array(
            'id' => $id,
            'taches' => $taches,
            'tachesCo' => $tachesCo
        );

        require($rep . $view['accueil']);
    }

    function AddPrivateTask()
    {
        $dVueEreur = array();
        global $rep, $view;

        $nom = $_POST['txtNom'];
        $desc = $_POST['txtDesc'];
        $user = $_POST['user'];
        Validation::val_addPrivate($nom, $desc, $user, $dVueEreur);

        $model = new TacheModel();
        $model->ajouterTachePrivee($nom, $desc, $user);

        $this->Reinit();
    }

    function SupprimerTachePrivee()
    {
        $dVueEreur = array();
        global $rep, $view;

        $idTache = $_POST['idTache'];
        $user = $_POST['user'];

        $model = new TacheModel();
        $model->SupprimerTachePrivee($idTache, $user);

        $this->Reinit();
    }

    function Deconnexion()
    {
        AdminModel::deconnexion();
        header('Location: index.php');
    }
}