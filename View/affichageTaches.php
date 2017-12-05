<html>
<head><title>Tâches</title>

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
<div>
    <h2 style="display: inline-block;" align="center">Les tâches</h2>
    <form style="float: right;" method="post" name="myform" id="myform">
        <?php
        if (isset($tachesCo)) {
            ?>
            <input type="submit" value="Deconnexion">
            <input type="hidden" name="action" value="ValidationDeconnection">
            <?php
        } else {
            ?>
            <input type="submit" value="Connexion">
            <input type="hidden" name="action" value="ValidationConnection">
        <?php }
        ?>
    </form>
</div>
<hr>
<!-- affichage de donn�es provenant du mod�le -->
<?= $dVue['data'] ?>

<?php
if (isset($taches) && count($taches) > 0) {
foreach ($taches as $row) {
?>
<form>
    <!-- engadget -->
    <input name="checkFait" <?php if ($row['status'] == 1) echo 'checked'; ?> type="checkbox">
    <?php
    print $row['nom'] . ' : ' . $row['description'];
    print "<BR>";
    ?>
</form>
<?php
}
}

if (isset($tachesCo) && count($tachesCo) > 0) {
?>
<br><br>
<h2 align="center">Tâches personnelles</h2>
<hr/><?php
foreach ($tachesCo as $row) {
?>
<form>
    <!-- engadget -->
    <input name="checkFait" <?php if ($row['status'] == 1) echo 'checked'; ?> type="checkbox">
    <?php
    print $row['nom'] . ' : ' . $row['description'];
    print "<BR>";
    ?>
</form>
<?php
}
}
?>
<?php } else {
    print ("erreur !!<br>");
    print ("utilisation anormale de la vuephp");
} ?>
</body>
</html>