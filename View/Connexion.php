<html>
<head><title>Connexion</title>
    <link type="text/css" rel="stylesheet" href="css/bootstrap.css">
    <link type="text/css" rel="stylesheet" href="css/bootstrap-grid.css">
    <link type="text/css" rel="stylesheet" href="css/bootstrap-reboot.css">

    <script type="text/javascript">
        function clearForm(oForm) {

            var elements = oForm.elements;

            oForm.reset();

            for (i = 0; i < elements.length; i++) {

                field_type = elements[i].type.toLowerCase();

                switch (field_type) {

                    case "text":
                    case "password":
                    case "textarea":
                    case "hidden":

                        elements[i].value = "";
                        break;

                    case "radio":
                    case "checkbox":
                        if (elements[i].checked) {
                            elements[i].checked = false;
                        }
                        break;

                    case "select-one":
                    case "select-multi":
                        elements[i].selectedIndex = -1;
                        break;

                    default:
                        break;
                }
            }
        }

    </script>
</head>

<body>
<?php

if (isset($dVue)) {
?>
<div align="center">

    <?php
    if (isset($dVueEreur) && count($dVueEreur) > 0) {
        echo "<h2>ERREUR</h2>";
        foreach ($dVueEreur as $value) {
            echo $value;
        }
    }
    ?>
    <nav class="navbar navbar-expand-md bg-primary">
        <div class="container">
            <div class="collapse navbar-collapse justify-content-center">
                <h1 class="text-info">Connexion</h1>
            </div>
        </div>
    </nav>

    <!-- affichage de donn�es provenant du mod�le -->
    <?= $dVue['data'] ?>

    <div class="container">
        <div class="row h-75 align-items-center">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card p-5 bg-secondary">
                    <div class="card-body">
                        <h1 class="mb-4 text-info">Connexion</h1>
                        <form method="post" name="myform" id="myform" action="index.php?action=SeConnecter">
                            <div class="form-group">
                                <label class="text-info lead">Identifiant</label>
                                <input name="txtId" value="<?= $dVue['id'] ?>" type="text" class="form-control bg-light"
                                       size="20" required>
                            </div>
                            <div class="form-group">
                                <label class="text-info lead">Mot de Passe</label>
                                <input name="txtMdp" value="<?= $dVue['mdp'] ?>" type="password"
                                       class="form-control bg-light" size="20" required>
                                <p class="text-center m-2">
                                    <input type="submit" class="btn btn-light" value="Connexion">
                                </p>

                                <?php
                                if (isset($erreurConnexion) && $erreurConnexion) {
                                    ?>
                                    <p style="color: white">Mauvais identifiant ou mot de passe !</p>
                                    <?php
                                }
                                ?>

                                <!-- action !!!!!!!!!! -->
                                <!--            <input type="hidden" name="action" value="index.php?action=ValidationConnection">-->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php } else {
        print ("Attention, erreur !!<br>");
        print ("utilisation anormale de la vuephp");
    } ?>
</body>
</html>