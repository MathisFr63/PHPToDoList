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
    } else {
        ?>
        <div>
            <h1 align="center">Les tâches</h1>
            <form style="float: right;" method="post" name="myform" id="myform">
                <?php
                if (isset($tachesCo)) {
                    ?>
                    <input type="submit" value="Deconnexion">
                    <input type="hidden" name="action" value="Deconnexion">
                    <?php
                } else {
                    ?>
                    <input type="submit" value="Connexion">
                    <input type="hidden" name="action" value="Connexion">
                <?php }
                ?>
            </form>
        </div>
        <?= $dVue['data'] ?>

        <?php
        if (isset($taches)) {
            ?>
            <br><br>
            <h2 align="center"> Tâches publiques </h2>
            <hr>
            <?php
            if (count($taches) > 0) {

                foreach ($taches as $row) {
                    ?>
                    <form id='status' name="status" method='post' action="index.php?action=UpdateStatusPublic">
                        <input type="hidden" name="idTache" value="<?php print $row['id'] ?>">
                        <input name="checkFait" <?php if ($row['status'] == 1) echo 'checked'; ?> type="checkbox"
                               onclick="this.form.submit();">
                    </form>

                    <form method="post" name="myform" id="myform" style="display: inline-block">
                        <?php
                        print $row['nom'] . ' : ' . $row['description'];
                        ?>
                        <input type="submit" value="Supprimer">
                        <input type="hidden" name="idTache" value="<?php print $row['id'] ?>">
                        <input type="hidden" name="action" value="SupprimerTachePublique">
                        <?php
                        print "<BR>";
                        ?>
                    </form>
                    <?php
                }
            }
            ?>
            <form method="post" name="myform" id="myform">
                <input type="text" name="txtNom" required>
                <input type="text" name="txtDesc" required>
                <input type="submit" value="Ajouter">
                <input type="hidden" name="action" value="AddPublicTask">
            </form>
            <?php
        }

        if (isset($tachesCo)) {
            ?>
            <br><br>
            <h2 align="center"> Tâches personnelles </h2>
            <hr/>
            <?php
            if (count($tachesCo) > 0) {
                foreach ($tachesCo as $row) {
                    ?>
                    <form id='status' name="status" method='post' action="index.php?action=UpdateStatusPrivee">
                        <input type="hidden" name="idTache" value="<?php print $row['id'] ?>">
                        <input name="checkFait" <?php if ($row['status'] == 1) echo 'checked'; ?> type="checkbox"
                               onclick="this.form.submit();">
                    </form>

                    <form method="post" name="myform" id="myform">
                        <?php
                        print $row['nom'] . ' : ' . $row['description'];
                        ?>
                        <input type="submit" value="Supprimer">
                        <input type="hidden" name="idTache" value="<?php print $row['id'] ?>">
                        <input type="hidden" name="user" value="<?php print $id ?>">
                        <input type="hidden" name="action" value="SupprimerTachePrivee">
                        <?php
                        print "<BR>";
                        ?>
                    </form>
                    <?php
                }
            }
            ?>
            <form method="post" name="myform" id="myform">
                <input type="text" name="txtNom" required>
                <input type="text" name="txtDesc" required>
                <input type="hidden" name="user" value="<?php print $id ?>">
                <input type="submit" value="Ajouter">
                <input type="hidden" name="action" value="AddPrivateTask">
            </form>
            <?php
        }
        ?>
    <?php }
} else {
    print ("erreur !!<br>");
    print ("utilisation anormale de la vuephp");
} ?>
</body>
</html>