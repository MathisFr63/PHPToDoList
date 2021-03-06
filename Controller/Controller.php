<?php

class Controller
{

    function __construct()
    {
        global $rep, $view;

        $dVueEreur = array();

        try {
            $action = $_REQUEST['action'];
            switch ($action) {

                case NULL:
                    $this->AffichageTaches();
                    break;

                case "AffichageTaches":
                    $this->AffichageTaches();
                    break;

                case "Connexion" :
                    $this->Connexion();
                    break;

                case "SeConnecter" :
                    $this->SeConnecter();
                    break;

                case "AddPublicTask":
                    $this->AddPublicTask();
                    break;

                case "SupprimerTachePublique" :
                    $this->SupprimerTachePublique();
                    break;

                case "UpdateStatusPublic" :
                    $this->UpdateStatusPublic();
                    break;

                default:
                    $dVueEreur[] = "Erreur d'appel php";
                    require($rep . $view['erreur']);
                    break;
            }
        } catch (Exception $e2) {
            $dVueEreur[] = "Erreur inattendue!!! ";
            require($rep . $view['erreur']);
        }
        exit(0);
    }

    protected function Connexion(): void
    {
        global $rep, $view;
        $dVue = array(
            'id' => "",
            'mdp' => "",
            'taches' => ""
        );
        require($rep . $view['connexion']);
    }

    protected function SeConnecter(): void
    {
        global $rep, $view;

        $dVueEreur = array();

        if (isset($_POST['txtId']) && isset($_POST['txtMdp'])) {
            $user = AdminModel::seConnecter($_POST['txtId'], $_POST['txtMdp']);
            if ($user == NULL) {
                $erreurConnexion = true;
                $dVue = array(
                    'id' => "",
                    'mdp' => "",
                    'taches' => ""
                );
                require($rep . $view['connexion']);
            } else {
                header('Location: index.php?action=AffichageTaches');
            }
        } else
            header('Location: index.php?action=Erreur');
    }

    function Reinit(): void
    {
        header('Location: index.php?action=AffichageTaches');
    }

    function AffichageTaches(): void
    {
        global $rep, $view, $nbTachesParPage;
        $page_decart = 5;

        $model = new TacheModel();
        $totalTaches = $model->getNbTaches();
        $nbPages = ceil($totalTaches / $nbTachesParPage);
        $page = Nettoyer::nettoyer_int($_GET['p']);
        $pageMin = $page - $page_decart <= 0 ? 1 : $page_decart;
        $pageMax = $page + $page_decart >= $nbPages ? $nbPages : $page_decart;
        $premiereTache = ($page - 1) * $nbTachesParPage;
        $derniereTache = $nbTachesParPage;
        $taches = $model->get_tasks_public_avec_pages($premiereTache, $derniereTache);

        $dVue = array(
            'taches' => $taches
        );

        require($rep . $view['accueil']);
    }

    function AddPublicTask(): void
    {
        $dVueEreur = array();

        $nom = $_POST['txtNom'];
        $desc = $_POST['txtDesc'];
        Validation::val_ajout($nom, $desc, $dVueEreur);

        $model = new TacheModel();
        $model->ajouterTachePublique($nom, $desc);

        $this->Reinit();
    }

    function SupprimerTachePublique(): void
    {
        $idTache = $_POST['idTache'];

        $model = new TacheModel();
        $model->supprimerTachePublique($idTache);

        $this->Reinit();
    }

    function UpdateStatusPublic(): void
    {
        $idTache = $_POST['idTache'];
        $status = $_POST['checkFait'] == 'on';

        $model = new TacheModel();
        $model->UpdateStatusPublic($idTache, $status);

        $this->Reinit();
    }
}