<?php
function rellenarCategoria($cat,$defecto){
    if((isset($_POST['cat']) and $_POST['cat']==$cat) or $defecto){
        echo 'selected="selected"';
    }
    
}
function rellenarTipoC($tipo,$defecto){
    if((isset($_POST['tipoC']) and $_POST['tipoC']==$tipo) or $defecto){
        echo 'checked="checked"';
    }
    
}
function rellenarCompeticiones($compe){
    if(isset($_POST['competiciones'])){
        foreach($_POST['competiciones'] as $c){
            if($c==$compe){
                echo 'selected="selected"';
                break;                
            }
        }
    
    }
    
}
function rellenarEquipaciones($equip,$defecto){
    if(isset($_POST['equip'])){
        foreach($_POST['equip'] as $e){
            if($e==$equip){
                echo 'checked="checked"';
                break;                
            }
        }
    
    }
    if($defecto){
        echo 'checked="checked"';                
    }
}
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
            <label>Nº de jugador</label>
            <br/>
            <input type="number" name="numJ" value="<?php echo (isset($_POST['numJ'])?$_POST['numJ']:''); ?>"/>

        </div>
        <div>
            <label>Nombre y apellidos</label>
            <br/>
            <input type="text" name="nombre" value="<?php echo (isset($_POST['nombre'])?$_POST['nombre']:'');?>" 
            placeholder="Nombre y apellidos del jugador"/>            
        </div>
        <div>
            <label>FEcha Nacimiento</label>
            <br/>
            <input type="date" name="fechaN" value="<?php echo (isset($_POST['fechaN'])?$_POST['fechaN']:'');?>"/>            
        </div>
        <div>
            <label>Selecciona la categoría</label>
            <br/>
            <select name="cat">
                <option <?php rellenarCategoria('Benjamín',true)?>>Benjamín</option>
                <option <?php rellenarCategoria('Alevín',false)?>>Alevín</option>
                <option <?php rellenarCategoria('Infantil',false)?>>Infantil</option>
                <option <?php rellenarCategoria('Cadete',false)?>>Cadete</option>
                <option <?php rellenarCategoria('Juntior',false)?>>Juntior</option>
                <option <?php rellenarCategoria('Senior',false)?>>Senior</option>
            </select>            
        </div>
        <div>
            <label>Tipo categoría</label>
            <br/>
            <input type="radio" name="tipoC" value="Masculina" <?php rellenarTipoC('Masculina',true);?>/>Masculina
            <input type="radio" name="tipoC" value="Femenina" <?php rellenarTipoC('Femenina',false);?>/>Femenina
            <input type="radio" name="tipoC" value="Mixta" <?php rellenarTipoC('Mixta',false);?>/>Mixta
        </div>
        <div>
            <label>Competiciones</label>
            <br/>
            <select name="competiciones[]" multiple="multiple">
                <option <?php rellenarCompeticiones('Primera');?>>Primera</option>
                <option <?php rellenarCompeticiones('Segunda A');?>>Segunda A</option>
                <option <?php rellenarCompeticiones('Segunda B');?>>Segunda B</option>
                <option <?php rellenarCompeticiones('Tercera');?>>Tercera</option>
            </select>            
        </div>
        <div>
            <label>Equipaciones</label>
            <br/>
            <input type="checkbox" name="equip[]" value="Entrenamientos" 
            <?php rellenarEquipaciones('Entrenamientos',true);?>/>Entrenamientos
            <input type="checkbox" name="equip[]" value="Partidos" <?php rellenarEquipaciones('Partidos',false);?>/>Partidos
            <input type="checkbox" name="equip[]" value="Chandal" <?php rellenarEquipaciones('Chandal',false);?>/>Chandal
            <input type="checkbox" name="equip[]" value="Bolso" <?php rellenarEquipaciones('Bolso',false);?>/>Bolso
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