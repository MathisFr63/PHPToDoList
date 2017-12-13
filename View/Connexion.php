<html>
<head><title>Connexion</title>

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

// on v�rifie les donn�es provenant du mod�le
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

        <h1>Connexion</h1>
        <hr>
        <!-- affichage de donn�es provenant du mod�le -->
        <?= $dVue['data'] ?>

        <form style="border: black 1px solid; border-radius: 10px; background: #717670; display: inline-block; padding: 20" method="post" name="myform" id="myform" action="index.php?action=SeConnecter">
            <table>
                <tr>
                    <td>Identifiant</td>
                    <td><input name="txtId" value="<?= $dVue['id'] ?>" type="text" size="20" required></td>
                </tr>
                <tr>
                    <td>Mot de passe</td>
                    <td><input name="txtMdp" value="<?= $dVue['mdp'] ?>" type="password" size="20" required></td>
                </tr>
            </table>
            <table>
                <tr>
                    <td><input type="submit" value="Connexion"></td>
                    </td>
                </tr>
            </table>

            <?php if(isset($dvue['erreurConnexion']) && $dvue['erreurConnexion']) echo '<div class="alert alert-danger">Mauvais identifiant ou mot de passe !</div>'; ?>

            <!-- action !!!!!!!!!! -->
<!--            <input type="hidden" name="action" value="index.php?action=ValidationConnection">-->
        </form>
    </div>

<?php } else {
    print ("Attention, erreur !!<br>");
    print ("utilisation anormale de la vuephp");
} ?>
</body>
</html>