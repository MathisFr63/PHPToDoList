<html>
<head><title>Les tâches</title>

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
    <?php
    if (isset($dVueEreur) && count($dVueEreur) > 0) {
        echo "<h2>ERREUR</h2>";
        foreach ($dVueEreur as $value) {
            echo $value;
        }
    }
    ?>

    <h2 align="center">Les tâches</h2>
    <hr>
    <!-- affichage de donn�es provenant du mod�le -->
    <?= $dVue['data'] ?>

    <?php
    foreach ($taches as $row) {
        ?>
        <form>
            <!-- engadget -->
            <input name="checkFait" <?php if($row['status'] == 1) echo 'checked';?> type="checkbox">
            <?php
            print $row['nom'] . ' : ' . $row['description'];
            print "<BR>";
            ?>
        </form>
        <?php
    }
    ?>
<?php } else {
    print ("erreur !!<br>");
    print ("utilisation anormale de la vuephp");
} ?>
</body>
</html>