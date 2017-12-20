<html>
<head><title>Tâches</title>
    <link type="text/css" rel="stylesheet" href="css/bootstrap.css">
    <link type="text/css" rel="stylesheet" href="css/bootstrap-grid.css">
    <link type="text/css" rel="stylesheet" href="css/bootstrap-reboot.css">
</head>

</head>

<body>
<?php

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
                    <div class="d-flex align-items-center">
                        <form style="margin-left: 10px; margin-right: 10px" id='status' name="status" method='post'
                              action="index.php?action=UpdateStatusPublic">
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
                    </div>
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

        if (isset($page) && isset($pageMin) && isset($pageMax) && $pageMin != $pageMax) {
            echo '<div class="col-md-6 offset-md-3 d-flex justify-content-center">
                <p>Page : </p>';
            for ($i = $pageMin; $i < $page; $i++)
                echo '<a href="index.php?' . $request . 'p=' . $i . '&&p2=' . $pagePrivee . '" style="padding-left: 10px"><p>' . $i . '</p></a> ';
            for ($i = $page; $i <= $pageMax; $i++) {
                if ($i == $page)
                    echo '<a href="index.php?' . $request . 'p=' . $i . '&&p2=' . $pagePrivee . '" style="padding-left: 10px"><p><strong>' . $i . '</strong></p></a> ';
                else
                    echo '<a href="index.php?' . $request . 'p=' . $i . '&&p2=' . $pagePrivee . '" style="padding-left: 10px"><p>' . $i . '</p></a> ';
            }
            echo "</div>";
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
                    <div class="d-flex align-items-center">
                        <form style="margin-left: 10px; margin-right: 10px" id='status' name="status" method='post' action="index.php?action=UpdateStatusPrivee">
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
                    </div>
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
        if (isset($pagePrivee) && isset($pageMinPrivee) && isset($pageMaxPrivee) && $pageMinPrivee != $pageMaxPrivee) {
            echo '<div class="col-md-6 offset-md-3 d-flex justify-content-center">
                <p>Page : </p>';
            for ($i = $pageMinPrivee; $i < $pagePrivee; $i++)
                echo '<a href="index.php?' . $request . 'p=' . $page . '&&p2=' . $i . '" style="padding-left: 10px"><p>' . $i . '</p></a> ';
            for ($i = $pagePrivee; $i <= $pageMaxPrivee; $i++) {
                if ($i == $page)
                    echo '<a href="index.php?' . $request . 'p=' . $page . '&&p2=' . $i . '" style="padding-left: 10px"><p><strong>' . $i . '</strong></p></a> ';
                else
                    echo '<a href="index.php?' . $request . 'p=' . $page . '&&p2=' . $i . '" style="padding-left: 10px"><p>' . $i . '</p></a> ';
            }
            echo "</div>";
        }

        ?>
    <?php }
} else {
    print ("erreur !!<br>");
    print ("utilisation anormale de la vuephp");
} ?>
</body>
</html>