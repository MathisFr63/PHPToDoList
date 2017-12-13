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
                    $this->AffichageTaches($dVueEreur);
                    break;

                case "AffichageTaches":
                    $this->AffichageTaches($dVueEreur);
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


                default:
                    $dVueEreur[] = "Erreur d'appel php";
                    require($rep . $view['erreur']);
                    break;
            }

        } catch (PDOException $e) {
            //si erreur BD, pas le cas ici
            $dVueEreur[] = "Erreur inattendue!!! PDO";
            require($rep . $view['erreur']);

        } catch (Exception $e2) {
            $dVueEreur[] = "Erreur inattendue!!! ";
            require($rep . $view['erreur']);
        }


//fin
        exit(0);
    }//fin constructeur


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
        if (isset($_POST['txtId']) && isset($_POST['txtMdp'])) {
            $user = AdminModel::seConnecter($_POST['txtId'], $_POST['txtMdp']);
            if ($user == NULL) {
//            if (AdminModel::seConnecter($_POST['txtId'], $_POST['txtMdp']) == false) {
                $erreurConnexion = true;
                $this->Connexion();
            } else {
                header('Location: index.php?action=AffichageTaches');
            }
        }
    }

    function Reinit()
    {
        header('Location: index.php?action=AffichageTaches');
    }

    function AffichageTaches(array $dVueEreur)
    {
        global $rep, $view;

        $model = new TacheModel();
        $taches = $model->get_tasks_public();
        $dVue = array(
            'taches' => $taches
        );

        // Il faudra appeler cette page que lorsque la connection aura échouée
        // require($rep . $view['Connexion']);
        require($rep . $view['accueil']);
    }

    function AddPublicTask()
    {
        $dVueEreur = array();
        global $rep, $view;

        $nom = $_POST['txtNom'];
        $desc = $_POST['txtDesc'];
        Validation::val_ajout($nom, $desc, $dVueEreur);

        $model = new TacheModel();
        $model->ajouterTachePublique($nom, $desc);

        $this->Reinit();
    }

    function SupprimerTachePublique()
    {
        $dVueEreur = array();
        global $rep, $view;

        $idTache = $_POST['idTache'];

        $model = new TacheModel();
        $model->supprimerTachePublique($idTache);

        $this->Reinit();
    }

}//fin class

?>
