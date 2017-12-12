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

            switch ($action) {

//pas d'action, on r�initialise 1er appel
                case NULL:
                    $this->Reinit();
                    break;


                case "ValidationConnection":
                    $this->ValidationConnection($dVueEreur);
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


    function Reinit()
    {
        global $rep, $view; // nécessaire pour utiliser variables globales
        $dVue = array(
            'id' => "",
            'mdp' => "",
            'taches' => ""
        );
        require($rep . $view['vuephp1']);
    }

    function ValidationConnection(array $dVueEreur)
    {
        global $rep, $view;

//si exception, ca remonte !!!
        $id = $_POST['txtId']; // txtId = nom du champ texte dans le formulaire contenant l'id
        $mdp = $_POST['txtMdp'];
        Validation::val_form($id, $mdp, $dVueEreur);

        $model = new MdlTask();
        $taches = $model->get_tasks_public();

        // test pour afficher l'identifiant et le mot de passe.
        $dVue = array(
            'id' => $id,
            'mdp' => $mdp,
            'taches' => $taches
        );

        // Il faudra appeler cette page que lorsque la connection aura échouée
        // require($rep . $view['vuephp1']);
        require($rep . $view['accueil']);
    }

    function AddPublicTask()
    {
        $dVueEreur = array();
        global $rep, $view;

        $nom = $_POST['txtNom'];
        $desc = $_POST['txtDesc'];
        Validation::val_ajout($nom, $desc, $dVueEreur);

        $model = new MdlTask();
        $model->ajouterTachePublique($nom, $desc);

        $this->Reinit();
    }

    function SupprimerTachePublique()
    {
        $dVueEreur = array();
        global $rep, $view;

        $idTache = $_POST['idTache'];

        $model = new MdlTask();
        $model->supprimerTachePublique($idTache);

        $this->Reinit();
    }

}//fin class

?>
