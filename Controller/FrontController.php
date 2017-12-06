<?php
/**
 * Created by PhpStorm.
 * User: Mathis
 * Date: 06/12/2017
 * Time: 10:21
 */

class FrontController
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
                //mauvaise action
                default:
                    $dVueEreur[] = "Erreur d'appel php";
                    require($rep . $view['vuephp1']);
                    break;
            }

        } catch (PDOException $e) {
            //si erreur BD, pas le cas ici
            $dVueEreur[] = "Erreur inattendue!!! ";
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

        // FAIRE LE NETTOYAGE !

        //si exception, ca remonte !!!
        $id = $_POST['txtId']; // txtId = nom du champ texte dans le formulaire contenant l'id
        $mdp = $_POST['txtMdp'];
        Validation::val_form($id, $mdp, $dVueEreur);

//        if ($dVueEreur == null){
        $model = new MdlFC();
        $taches = $model->get_data();
//        Ne marche pas, je sais pas pourquoi !
        //        $_SESSION['role'] = $model->isAdmin();
        print "Test";
        $_SESSION['login'] = $id;
//        }

        // test pour afficher l'identifiant et le mot de passe.
        $dVue = array(
            'id' => $id,
            'mdp' => $mdp,
            'taches' => $taches
        );

        // Il faudra appeler cette page que lorsque la connection aura échouée
        // require($rep . $view['vuephp1']);
        require($rep . $view['affichageTaches']);
    }
}