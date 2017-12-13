<?php

class CtrlAdmin
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

                case "Déconnexion":
                    $this->Deconnexion();
                    break;

                case "AffichageTachesPrivees":
                    $this->AffichageTachesPrivees($dVueEreur);
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
            'nom' => "",
            'age' => 0,
        );
        require($rep . $view['connexion']);
    }

    function AffichageTachesPrivees(array $dVueEreur)
    {
        global $rep, $view;

        print "Test";
        $id = $_SESSION['login'];

        $model = new TacheModel();
        $taches = $model->get_tasks_public();
        print "Test connexion";
        $tachesCo = $model->get_tasks_user($id);

        print count($tachesCo);

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

    function ValidationConnection(array $dVueEreur)
    {
        global $rep, $view;

        print "Test";
//si exception, ca remonte !!!
        $id = $_POST['txtId']; // txtId = nom du champ texte dans le formulaire contenant l'id
        $mdp = $_POST['txtMdp'];
        Validation::val_form($id, $mdp, $dVueEreur);

        $model = new TacheModel();
        $taches = $model->get_tasks_public();

        $tachesCo = $model->get_tasks_user($id);

        // Affiche le nombre de tâches privées.
        print count($tachesCo);

        // test pour afficher l'identifiant et le mot de passe.
        $dVue = array(
            'id' => $id,
            'mdp' => $mdp,
            'taches' => $taches,
            'tachesCo' => $tachesCo
        );

        // Il faudra appeler cette page que lorsque la connection aura échouée
        // require($rep . $view['connexion']);
        require($rep . $view['accueil']);
    }

    function Deconnexion()
    {
        AdminModel::deconnexion();
        header('Location: index.php');
    }
}