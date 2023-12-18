<?php
function marcarClaseSeleccionada($clase, $clasePieza)
{
    if ($clase == $clasePieza) {
        return 'selected="selected"';
    }
}
?>
<div class="container p-2 my-2 border">
    <!-- Mostrar piezas y dar opción a modificar y borrar -->
    <?php
    if ($bd->getConexion() != null) {
        //Obtener piezas
        $piezas = $bd->obtenerPiezasReparacion($_SESSION['reparacion']);
        //Mostramos las piezas en una tabla
    ?>
        <form action="#" method="post">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Código Pieza</th>
                        <th>Clase</th>
                        <th>Descripción</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Importe</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($piezas as $pr) {
                        //$pr = new PiezaReparacion();
                        echo '<tr>';
                        if (isset($_POST['modif']) and $_POST['modif'] == $pr->getP()->getCodigo()) {
                            //Pintar campos para poder modificar
                            echo '<td> <input type="text" name="codigo" disabled="disabled" value="' . $pr->getP()->getCodigo() . '"/></td>';
                            echo '<td> <input type="text" name="clase"  disabled="disabled" value="' . $pr->getP()->getClase() . '"/></td>';
                            echo '<td> <input type="text" name="descripcion"  disabled="disabled" value="' . $pr->getP()->getDescripcion() . '"/></td>';
                            echo '<td> <input type="number" name="cantidad" value="' . $pr->getCantidad() . '"/></td>';
                            echo '<td> <input type="number" name="precio" step="0.01" value="' . $pr->getPrecio() . '" disabled="disabled" /></td>';
                            echo '<td></td>';
                            echo '<td>';
                            echo '<button type="submit" class="btn btn-outline-dark" name="update" value="' . $pr->getP()->getCodigo() . '">Guardar</button>';
                            echo '<button type="submit" class="btn btn-outline-dark" name="cancelar">Cancelar</button>';
                            echo '</td>';
                        } else {
                            echo '<td>' . $pr->getP()->getCodigo() . '</td>';
                            echo '<td>' . $pr->getP()->getClase() . '</td>';
                            echo '<td>' . $pr->getP()->getDescripcion() . '</td>';
                            echo '<td>' . $pr->getCantidad() . '</td>';
                            echo '<td>' . $pr->getPrecio() . '</td>';
                            echo '<td>' . $pr->getCantidad()*$pr->getPrecio() . '</td>';
                            echo '<td>';
                            echo '<button type="submit" class="btn btn-outline-dark" name="modif" value="' . 
                                   $pr->getP()->getCodigo() . '"><img src="../icon/modif25.png"/></button>';
                            echo '<button type="button" class="btn btn-outline-dark"  data-bs-toggle="modal"  
                                 data-bs-target="#a' . $pr->getP()->getCodigo() . '" name="avisar" 
                                 value="' . $pr->getP()->getCodigo() . '"><img src="../icon/delete25.png"/></button>';
                            echo '</td>';
                        }
                        echo '</tr>';

                        //Definir ventana modal
                    ?>
                        <!-- The Modal -->
                        <div class="modal" id="a<?php echo $pr->getP()->getCodigo(); ?>">
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
                                        <button type="submit" name="borrar" 
                                        value="<?php echo $pr->getP()->getCodigo(); ?>" 
                                        class="btn btn-danger" data-bs-dismiss="modal">Borrar</button>
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