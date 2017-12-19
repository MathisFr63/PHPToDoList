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

                case "UpdateStatusPrivee" :
                    $this->UpdateStatusPrivee();
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

    function Reinit(): void
    {
        header('Location: index.php?action=AffichageTaches');
    }

    function AffichageTachesPrivees(): void
    {
        global $rep, $view, $nbTachesParPage;
        $page_decart = 5;

        $model = new TacheModel();
        $totalTaches = $model->getNbTaches();
        $nbPages = ceil($totalTaches / $nbTachesParPage);
        $page=Nettoyer::nettoyer_int($_GET['p']);
        $pageMin= $page-$page_decart < 0 ? 1 : $page_decart;
        $pageMax= $page+$page_decart >= $nbPages ? $nbPages : $page_decart;
        $premiereTache = ($page - 1) * $nbTachesParPage;
        $derniereTache = $nbTachesParPage;
        $taches = $model->get_tasks_public_avec_pages($premiereTache, $derniereTache);

        $id = $_SESSION['login'];

        $totalTachesPrivees = $model->getNbTachesPrivees();
        $nbPagesPrivees = ceil($totalTachesPrivees / $nbTachesParPage);
        $pagePrivee=Nettoyer::nettoyer_int($_GET['p2']);
        $pageMinPrivee= $pagePrivee-$page_decart <= 0 ? 1 : $page_decart;
        $pageMaxPrivee= $pagePrivee+$page_decart >= $nbPagesPrivees ? $nbPagesPrivees : $page_decart;
        $premiereTachePrivee = ($pagePrivee - 1) * $nbTachesParPage;
        $derniereTachePrivee = $nbTachesParPage;
        $tachesCo = $model->get_tasks_user_avec_pages($id, $premiereTachePrivee, $derniereTachePrivee);

        $dVue = array(
            'id' => $id,
            'taches' => $taches,
            'tachesCo' => $tachesCo
        );

        require($rep . $view['accueil']);
    }

    function AddPrivateTask(): void
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

    function SupprimerTachePrivee(): void
    {
        $dVueEreur = array();
        global $rep, $view;

        $idTache = $_POST['idTache'];
        $user = $_POST['user'];

        $model = new TacheModel();
        $model->SupprimerTachePrivee($idTache, $user);

        $this->Reinit();
    }

    function Deconnexion(): void
    {
        AdminModel::deconnexion();
        header('Location: index.php');
    }

    function UpdateStatusPrivee(): void
    {
        $dVueEreur = array();
        global $rep, $view;

        $idTache = $_POST['idTache'];
        $status = $_POST['checkFait']=='on';

        $model = new TacheModel();
        $model->UpdateStatusPrivee($idTache, $status);

        $this->Reinit();
    }
}