<?php
require_once '../Modelo.php';
$bd = new Modelo();
if($bd->getConexion()==null){
    $mensaje = array('e','Error, no hay conexión con la bd');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <title>Taller - Gestión de Piezas</title>
</head>
<body>
    <header>
        <?php
            require_once '../menu.php';
        ?>
        <h3 style="text-align: center;">GESTIÓN DE PIEZAS</h3>
    </header>
    <section>
    <div class="container p-5 my-5 border">
        <!-- Crear Pieza -->
        <form action="#" method="post">
            <div class="row">
                <div class="col">
                    <label>Código</label>
                    <input type="text" name="codigo" placeholder="F01"/>
                </div>
                <div class="col">
                    <label>Clase</label>
                    <select name="clase">
                        <option>Refrigeración</option>
                        <option>Filtro</option>
                        <option>Motor</option>
                        <option>Otros</option>
                    </select>
                </div>
                <div class="col">
                    <label>Descripción</label>
                    <input type="text" name="desc" placeholder="Nombre pieza"/>
                </div>
                <div class="col">
                    <label>Precio</label>
                    <input type="number" name="precio" step="0.01"/>
                </div>
                <div class="col">
                    <label>Stock</label>
                    <input type="number" name="stock"/>
                </div>
                <div class="col">
                    <input type="submit" name="crear" value="Crear" />
                    <input type="reset" name="limpiar" value="Cancelar" />
                </div>
            </div>    
        </form>
        </div>
    </section>
    <section>
        
        <!-- Comunicar mensajes -->
        <?php
        if(isset($mensaje)){
            echo '<div class="container p-5 my-5 border">';            
            if($mensaje[0]=='e')
                echo '<h4 class="text-danger">'.$mensaje[1].'</h4>';
            else
                echo '<h4 class="text-success">'.$mensaje[1].'</h4>';
            echo '</div>';
        }
        ?>
    </section>
    <section>
        <div class="container p-5 my-5 border">
            <!-- Mostrar piezas y dar opción a modificar y borrar -->
        <?php
            if($bd->getConexion()!=null){
                //Obtener piezas
                $piezas = $bd->obtenerPiezas();
                //Mostramos las piezas en una tabla
                ?>
                <table  class="table table-striped">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Clase</th>
                            <th>Descrición</th>
                            <th>Precio</th>
                            <th>Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach($piezas as $p){
                            echo '<tr>';
                            echo '<td>'.$p->getCodigo().'</td>';
                            echo '<td>'.$p->getClase().'</td>';
                            echo '<td>'.$p->getDescripcion().'</td>';
                            echo '<td>'.$p->getPrecio().'</td>';
                            echo '<td>'.$p->getStock().'</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
                <?php
            }
        ?>   
        </div>
        
    </section>
    <footer>

    </footer>
</body>
</html>