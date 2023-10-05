<?php
include_once 'claseAlumno.php';
include_once 'accesoDatos.php'
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <div>
            <label for="numExp">Nº Expediente</label><br/>
            <input name="numExp" type="number" value="1"/>
        </div>
        <div>
            <label for="nombre">Nombre</label><br/>
            <input name="nombre" type="text" required="required" 
            placeholder="Introduce nombre Alumno"/>
        </div>
        <div>
            <label for="fechaN">Fecha Nacimiento</label><br/>
            <input name="fechaN" type="date" value="<?php echo date('Y-m-d') ?>"/>
        </div>
        <input type="submit" name="crear" value="Crear Alumno">
    </form>
    <?php
        //Si pulsamos en Crear Alumno se crea el objeto y se muestra
        if(isset($_POST['crear'])){
            $a = new Alumno($_POST['numExp'],$_POST['nombre'],strtotime($_POST['fechaN']));

            //Chequear si el nº de expediente no existe en el fichero
            //Si existe, se debe mostrar un error
            $alTmp = obtenerAlumno($a->getNumExp());
            if($alTmp==null){
                //Guardar el alumno en el fichero
                if(crearAlumno($a)){
                    echo '<p style="color:blue;">Alumno creado:'.$a->mostrar().'</p>';
                }
                else{
                    echo '<p style="color:red;">Error al crear el alumno</p>';
                }
            }
            else{
                echo '<p style="color:red;">Error: el alumno'.
                     $a->getNumExp().' ya existe</p>';
            }
        }
    ?>

</body>
</html>