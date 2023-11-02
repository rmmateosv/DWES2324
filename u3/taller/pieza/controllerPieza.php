<?php
require_once '../Modelo.php';
$bd = new Modelo();
if($bd->getConexion()==null){
    $mensaje = array('e','Error, no hay conexión con la bd');
}
else{
    //Botón crear
    if(isset($_POST['crear'])){
        //Comprobar que todos los campos están rellenos
        if(empty($_POST['codigo']) or empty($_POST['clase']) or empty($_POST['desc'])
        or empty($_POST['precio']) or empty($_POST['stock'])){
            $mensaje=array('e','Debes relleanar todos los campos');
        }
        else{
            //Comprobar que no existe una pieza con el mismo código
            $p = $bd->obtenerPieza($_POST['codigo']);
            if($p==null){
                //La pieza no existe, se puede crear
                //Insertar en la BD la pieza
                $p = new Pieza();
                $p->setCodigo($_POST['codigo']);
                $p->setClase($_POST['clase']);
                $p->setDescripcion($_POST['desc']);
                $p->setPrecio($_POST['precio']);
                $p->setStock($_POST['stock']);
                if($bd->insertarPieza($p)){
                    $mensaje=array('i','Pieza creada');
                }
                else{
                    $mensaje=array('e','Error al crear la pieza');
                }
            }
            else{
                $mensaje=array('e','Pieza ya existe:'.$p->getCodigo().' '.$p->getDescripcion());
            }
        }
        
    }
    elseif(isset($_POST['borrar'])){
        //Chequear que la pieza exista
        $p = $bd->obtenerPieza($_POST['borrar']);
        if($p!=null){
            //Comprobar que se puede borrar (si no se ha usado en ninguna reparación)
            if($bd->existenReparaciones($p->getCodigo())){
                $mensaje=array('e','No se puede borrar la pieza porque ya se ha usado en reparaciones');
            }
            else{
                //Borrar la pieza
                if($bd->borrarPieza($p->getCodigo())){
                    $mensaje=array('i','Pieza Borrada');
                }
                else{
                    $mensaje=array('e','Se ha producido un error al borrar la pieza');
                }
            }
            
        }
        else{
            $mensaje=array('e','Error, la pieza no existe');
        }
    }
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
    <div class="container p-2 my-2 border">
        <!-- Crear Pieza -->
        <form action="#" method="post">
            <div class="row">
                <div class="col">
                    <label>Código</label>
                </div>
                <div class="col">
                    <label>Clase</label>
                </div>
                <div class="col">
                    <label>Descripción</label>
                </div>
                <div class="col">
                    <label>Precio</label>
                   
                </div>
                <div class="col">
                    <label>Stock</label>
                </div>
                <div class="col">
                </div>
            </div>  
            <div class="row">
                <div class="col">
                    <input type="text" name="codigo" placeholder="F01" maxlength="3"/>
                </div>
                <div class="col">
                    <select name="clase" class="form-select form-select-sm">
                        <option>Refrigeración</option>
                        <option>Filtro</option>
                        <option>Motor</option>
                        <option>Otros</option>
                    </select>
                </div>
                <div class="col">
                    <input type="text" name="desc" placeholder="Nombre pieza"/>
                </div>
                <div class="col">
                    
                    <input type="number" name="precio" step="0.01"/>
                </div>
                <div class="col">
                   
                    <input type="number" name="stock"/>
                </div>
                <div class="col">
                    <input type="submit" name="crear" value="Crear" class="btn btn-outline-dark"/>
                    <input type="reset" name="limpiar" value="Cancelar" class="btn btn-outline-dark"/>
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
        <div class="container p-2 my-2 border">
            <!-- Mostrar piezas y dar opción a modificar y borrar -->
        <?php
            if($bd->getConexion()!=null){
                //Obtener piezas
                $piezas = $bd->obtenerPiezas();
                //Mostramos las piezas en una tabla
                ?>
                <form action="#" method="post">
                    <table  class="table table-striped">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Clase</th>
                                <th>Descrición</th>
                                <th>Precio</th>
                                <th>Stock</th>
                                <th>Acciones</th>
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
                                echo '<td>';
                                echo '<button type="submit" class="btn btn-outline-dark" name="modif" value="'.$p->getCodigo().'"><img src="../icon/modif25.png"/></button>';
                                echo '<button type="button" class="btn btn-outline-dark"  data-bs-toggle="modal"  data-bs-target="#a'.$p->getCodigo().'" name="avisar" value="'.$p->getCodigo().'"><img src="../icon/delete25.png"/></button>';
                                echo'</td>';
                                echo '</tr>';
                                
                                //Definir ventana modal
                                ?>
                                <!-- The Modal -->
                                    <div class="modal" id="a<?php echo $p->getCodigo();?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Borrar Pieza</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            ¿Está seguro que desea borrar la pieza?
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="submit" name="borrar" value="<?php echo $p->getCodigo();?>" class="btn btn-danger" data-bs-dismiss="modal">Borrar</button>
                                        </div>

                                        </div>
                                    </div>
                                    </div>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </form>
                <?php
            }
        ?>   
        </div>
        
    </section>
    <footer>

    </footer>
</body>
</html>