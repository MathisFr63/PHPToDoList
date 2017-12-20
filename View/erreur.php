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
<div align="center">
    <nav class="navbar navbar-expand-md bg-primary">
        <div class="container">
            <div class="collapse navbar-collapse justify-content-center">
                <h1 class="text-info">Erreur</h1>
            </div>
        </div>
    </nav
    <div>
        <?php
        if (isset($dVueEreur) && count($dVueEreur) > 0) {
            foreach ($dVueEreur as $value) {
                ?>
                <p class="alert alert-danger"><?php echo $value ?></p>
                <?php
            }
        }
        ?>
    </div>
</body>
</html>