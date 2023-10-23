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
            <label>Nº de jugador</label>
            <br/>
            <input type="number" name="numJ"/>

        </div>
        <div>
            <label>Nombre y apellidos</label>
            <br/>
            <input type="text" name="nombre" placeholder="Nombre y apellidos del jugador"/>            
        </div>
        <div>
            <label>FEcha Nacimiento</label>
            <br/>
            <input type="date" name="fechaN"/>            
        </div>
        <div>
            <label>Selecciona la categoría</label>
            <br/>
            <select name="cat">
                <option>Benjamín</option>
                <option>Alevín</option>
                <option>Infantil</option>
                <option>Cadete</option>
                <option>Juntior</option>
                <option>Senior</option>
            </select>            
        </div>
        <div>
            <label>Tipo categoría</label>
            <br/>
            <input type="radio" name="tipoC" value="Masculina" checked="checked"/>Masculina
            <input type="radio" name="tipoC" value="Femenina" />Femenina
            <input type="radio" name="tipoC" value="Mixta" />Mixta
        </div>
        <div>
            <label>Competiciones</label>
            <br/>
            <select name="competiciones[]" multiple="multiple">
                <option>Primera</option>
                <option>Segunda A</option>
                <option>Segunda B</option>
                <option>Tercera</option>
            </select>            
        </div>
        <div>
            <label>Equipaciones</label>
            <br/>
            <input type="checkbox" name="equip[]" value="Entrenamientos" checked="checked"/>Entrenamientos
            <input type="checkbox" name="equip[]" value="Partidos" />Partidos
            <input type="checkbox" name="equip[]" value="Chandal" />Chandal
            <input type="checkbox" name="equip[]" value="Bolso" />Bolso
        </div>

        <input type="submit" name="enviar" value="Enviar" />
        <input type="reset" name="limpiar" value="Limpiar" />
    </form>

    <?php
    if(isset($_POST['enviar'])){
        if(empty($_POST['numJ']) or empty($_POST['nombre']) or empty($_POST['fechaN']) or empty($_POST['cat']) or
        !isset($_POST['tipoC']) or !isset($_POST['competiciones']) or !isset($_POST['equip'])){
            echo "<h3 style='color:red;'>Error, hay que rellenar todos los campos</h3>";
        }
        elseif($_POST['tipoC']=='Mixta' and $_POST['cat']!='Alevín' and $_POST['cat']!='Benjamín'){
            echo "<h3 style='color:red;'>Error, no se permite tipo categoría mixta </h3>";
        }
        else{
            if($_POST['equip'][0]!='Entrenamientos' and $_POST['equip'][0]!='Partidos'){
                echo "<h3 style='color:red;'>Error, hay que marcar al menos una equipación </h3>";
            }
            $error = true;
            foreach($_POST['equip'] as $e){
                if($e=='Entrenamientos' or $e=='Partidos'){
                    $error=false;
                    break;
                }
            }
            if($error){
                echo "<h3 style='color:red;'>Error, hay que marcar al menos una equipación </h3>";
            }
            else{
                $precio=0;
                foreach($_POST['equip'] as $e){
                    switch($e){
                        case 'Entrenamientos':
                            $precio+=25;
                            break;
                        case 'Partidos':
                            $precio+=25;
                            break;
                        case 'Chandal':
                            $precio+=40;
                            break;
                        case 'Bolso':
                            $precio+=15;
                            break;
                    }
                }
                echo '<h3 style="color:green;">DAtos correctos. El importe a pagar es de'.$precio.'</h3>';
            }

        }
    }
    ?>
</body>
</html>