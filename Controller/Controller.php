<?php

class Controller
{

    function __construct()
    {
        global $rep, $view; // nécessaire pour utiliser variables globales
// on démarre ou reprend la session si necessaire (préférez utiliser un modèle pour gérer vos session ou cookies)
        session_start();


//debut

//on initialise un tableau d'erreur
        $dVueEreur = array();

        try {
            $action = $_REQUEST['action'];
            print "<BR>Action : " . $action;
            switch ($action) {

//pas d'action, on r�initialise 1er appel
                case NULL:
                    $this->Connexion();
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


//mauvaise action
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


    protected function Connexion() : void {
        global $rep,$view;
        print "<BR>Je suis dans la connexion";
        $dVue = array(
            'id' => "",
            'mdp' => "",
            'taches' => ""
        );
        require($rep . $view['connexion']);
    }

    protected function SeConnecter() : void {
        global $rep,$view;
        if(isset($_POST['txtId']) && isset($_POST['txtMdp'])){
            if(AdminModel::seConnecter($_POST['txtId'], $_POST['txtMdp']) == false) {
                $erreurConnexion=true;
                require($rep . $view['connexion']);
            }
            else
                // À modifier
                header('Location: index.php?action=AffichageTaches');
        }
    }

    function Reinit()
    {
        global $rep, $view; // nécessaire pour utiliser variables globales

        $model = new TacheModel();
        $taches = $model->get_tasks_public();

        $dVue = array(
            'id' => "",
            'mdp' => "",
            'taches' => $taches
        );
        require($rep . $view['accueil']);
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
