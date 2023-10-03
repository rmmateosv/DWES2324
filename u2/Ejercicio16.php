<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>
    form {
        margin-left: 4%;

    }

    /* table {
        border: 1 solid;
    } */
</style>

<body>
    <br />
    <form action="" method="post"> <!-- action="#" -->
        <h1>ALUMNOS</h1>
        <div>
            <label>Nº de alumnos</label>
            <input type="number" name="numero" value="<?php
                                                        if (isset($_POST['numero'])) {
                                                            echo $_POST['numero'];
                                                        } else {
                                                            echo '';
                                                        }
                                                        ?>" />
        </div>
        <br />
        <div>
            <input type="submit" name="crear" value="Crear" />
        </div>

        <br />
        <h1>Datos de los alumnos</h1>
        <br />
        <?php
        //Pintar formulario de nombres de acompañantes si se ha pulsado en rellenar

        if (isset($_POST['crear']) or isset($_POST['mostrar'])) {

            for ($i = 1; $i <= $_POST['numero']; $i++) {
                echo '<div>';
                echo '<label>Alumno ' . $i . '</label>';
                //Rellenar una variable con el nombre si se a escrito
                if (isset($_POST['nombres'][$i - 1])) {
                    $texto = $_POST['nombres'][$i - 1];
                } else {
                    $texto = '';
                }
                echo ' <br/><input name="nombres[]" value="' . $texto . '"/>';
                echo '</div>';
                echo '<br/>';
            }

        ?>
            <input type="submit" name="mostrar" value="Mostrar" />

        <?php
        }
        ?>
    </form>

    <?php
    if (isset($_POST['mostrar'])) {
    ?>

        <br />
        <table border="1" align="center">
            <tr>
                <?php
                for ($i = 1; $i <= $_POST['numero']; $i++) {
                    echo '<th>Alumno ' . $i . '</th>';
                }
                ?>
            </tr>
            <tr>

                <?php
                for ($i = 1; $i <= $_POST['numero']; $i++) {
                    if (isset($_POST['nombres'][$i - 1])) {
                        echo '<td>' . $_POST['nombres'][$i - 1] . '</td>';
                    } else {
                        echo '<td></td>';
                    }
                    // echo '<td>' . $_POST['nombres'][$i - 1] . '</td>';
                }
                ?>

            </tr>

        </table>
        <ul>
            <p>Alumnos: </p>

            <?php
            for ($i = 1; $i <= $_POST['numero']; $i++) {
                if (isset($_POST['nombres'][$i - 1])) {
                    echo '<li>' . $_POST['nombres'][$i - 1] . '</li>';
                } else {
                    echo '<li></li>';
                }
            }
            ?>

        </ul>
    <?php
    }
    ?>
</body>

</html>