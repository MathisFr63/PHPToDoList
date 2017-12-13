<?php

class CtrlAdmin
{

    function __construct()
    {
        global $rep, $view; // nécessaire pour utiliser variables globales


        $dVueEreur = array();

        try {
            $action = $_REQUEST['action'];
            print "Action : " . $action . "<BR>";

            switch ($action) {

//pas d'action, on r�initialise 1er appel
                case NULL:
                    $this->AffichageTachesPrivees();
                    break;

                case "AffichageTaches":
                    $this->AffichageTachesPrivees();
<<<<<<< HEAD

                case "Déconnexion":
                    $this->Deconnexion();
=======
>>>>>>> parent of b63d79c... Merge branch 'master' of https://github.com/MathisFr63/PHPToDoList
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

    function ValidationConnection(array $dVueEreur)
    {
        global $rep, $view;

//si exception, ca remonte !!!
        $id = $_POST['txtId']; // txtId = nom du champ texte dans le formulaire contenant l'id
        $mdp = $_POST['txtMdp'];
        Validation::val_form($id, $mdp, $dVueEreur);

        $model = new TacheModel();
        $taches = $model->get_tasks_public();

        $tachesCo = $model->get_tasks_user($id);

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