<?php

class Controleur
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


                case "validationFormulaire":
                    $this->ValidationFormulaire($dVueEreur);
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
            'nom' => "",
            'age' => 0,
        );
        require($rep . $view['vuephp1']);
    }

    function ValidationFormulaire(array $dVueEreur)
    {
        global $rep, $view;


//si exception, ca remonte !!!
        $nom = $_POST['txtNom']; // txtNom = nom du champ texte dans le formulaire
        $age = $_POST['txtAge'];
        Validation::val_form($nom, $age, $dVueEreur);

        $model = new Simplemodel();
        $data = $model->get_data();

        $dVue = array(
            'nom' => $nom,
            'age' => $age,
            'data' => $data,
        );
        require($rep . $view['vuephp1']);
    }

}//fin class

?>
