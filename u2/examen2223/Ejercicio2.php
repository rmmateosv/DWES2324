<?php
function rellenarSelected($campo, $item, $opcionPorDefecto){
    //Si el item viene en $_POST, hay que marcarlo como seleccionado
    if(isset($_POST[$campo])){
        if($_POST[$campo]==$item){
            echo 'selected = "selected"';
        }
    }
    elseif($opcionPorDefecto){
        echo 'selected = "selected"';
    }
}
function rellenarRadio($campo, $item, $opcionPorDefecto){
    //Si el item viene en $_POST, hay que marcarlo como seleccionado
    if(isset($_POST[$campo])){
        if($_POST[$campo]==$item){
            echo 'checked = "checked"';
        }
    }
    elseif($opcionPorDefecto){
        echo 'checked = "checked"';
    }
}
function rellenarCheckBox($item){
    if(isset($_POST['opciones'])){
        foreach($_POST['opciones'] as $o){
        if($o==$item){            
            echo 'checked = "checked"';
        }
    }
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
            <label>DNI</label><br/>
            <input type="text" name="dni" placeholder="12345678L" 
            value="<?php
                        if(isset($_POST['dni'])){
                            echo $_POST['dni'];
                        }
                ?>"/>
        </div>
        <div>
            <label>Nombre Cliente</label><br/>
            <input type="text" name="nombre" placeholder="Nombre del Cliente" 
            value="<?php
                        echo (isset($_POST['nombre'])?$_POST['nombre']:'');
                ?>"/>
        </div>
        <br/>
        <div>
            <label>Tipo de habitación</label><br/>
            <select name="tipoH">
                <option <?php rellenarSelected('tipoH','Doble',true);?>>Doble</option>
                <option <?php rellenarSelected('tipoH','Individual',false);?>>Individual</option>
                <option <?php rellenarSelected('tipoH','Suite',false);?>>Suite</option>
            </select>
        </div>
        <br/>
        <div>
            <label>Número de noches</label><br/>
            <input type="number" name="numero"
            value="<?php
                        echo (isset($_POST['numero'])?$_POST['numero']:'');
                ?>"/>/>
        </div>
        <div>
            <label>Estancia</label><br/>
            <select name="estancia">
                <option <?php rellenarSelected('estancia','1',true);?> value="1">Diario</option>
                <option <?php rellenarSelected('estancia','2',false);?> value="2">Fin de semana</option>
                <option <?php rellenarSelected('estancia','3',false);?> value="3">Promocionado</option>
            </select>
        </div>
        <br/>
        <div>
            <label>Pago</label><br/>
            <input type="radio" name="pago" value="Efectivo" <?php rellenarRadio('pago','Efectivo',false);?>/>Efectivo
            <input type="radio" name="pago" value="Tarjeta" <?php rellenarRadio('pago','Tarjeta',true);?>/>Tarjeta
        </div>
        <br/>
        <div>
            <label>Opciones</label><br/>
            <input type="checkbox" name="opciones[]" value="1" <?php rellenarCheckBox('1');?>/>Cuna
            <input type="checkbox" name="opciones[]" value="2" <?php rellenarCheckBox('2');?>/>Cama Supletoria
            <input type="checkbox" name="opciones[]" value="3" <?php rellenarCheckBox('3');?>/>Lavandería            
        </div>
        <br/>
        <div>
            <input type="submit" name="crear" value="Crear Estancia"/>
            <input type="submit" name="ver" value="Ver Estancias"/>
        </div>
    </form>
    <?php
        //Chequeos
        if(isset($_POST['crear'])){
            //Campos vacíos
            if(empty($_POST['nombre']) or empty($_POST['dni'])  or empty($_POST['numero'])){
                echo '<h3 style="color:red;">Error:Dni, nombre y nº de noches no pueden estar vacíos</h3>';
            }
            else{
                //Pago en efectivo y nº noches
                if(isset($_POST['pago']) and $_POST['pago']=='Efectivo' and $_POST['numero']>2){
                    echo '<h3 style="color:red;">Error:Pago en efectivo solamente para menos de 2 noches</h3>';
                }
                else{
                    //Chequeo de cuna y cama
                    //Por posición
                    if(isset($_POST['opciones']) and isset($_POST['opciones'][1])){
                        if($_POST['opciones'][0]==1 and $_POST['opciones'][1]==2){
                            echo '<h3 style="color:red;">Error:No se puede marcar cuna y cama supletoria</h3>';
                            $error=true;
                        }
                    }
                    if(!isset($error)){
                        //Precio por noche
                        switch($_POST['tipoH']){
                            case 'Individual':
                                $importe= $_POST['numero']*45;
                                break;
                            case 'Doble':
                                $importe= $_POST['numero']*55;
                                break;
                            case 'Suite':
                                $importe= $_POST['numero']*75;
                                break;
                        }
                        //Subo 10%
                        if(isset($_POST['estancia']) and $_POST['estancia']==2){
                            $importe*=1.10;
                        }
                        //BAjo un 10%
                        if(isset($_POST['estancia']) and $_POST['estancia']==3){
                            $importe*=0.90;
                        }

                        echo '<h3 style="color:blue;">Error:Entrada correcta. El importe de la estancia 
                        es de '.$importe.'</h3>';
                    }
                    //Comprobando los valores del array sin usar funciones de array
                    /*if(isset($_POST['opciones'])){
                        $hayCuna = false;
                        foreach($_POST['opciones'] as $o){
                            if($o==1 or $o==2){
                                if(!$hayCuna){
                                    $hayCuna=true;
                                }
                                else{
                                    echo '<h3 style="color:red;">Error:No se puede marcar cuna y cama supletoria</h3>';
                                }
                                
                            }
                        }
                    }*/
             
            }
            
        }
    }   
    ?>
</body>
</html>