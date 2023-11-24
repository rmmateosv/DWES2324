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
        $piezas = $bd->obtenerPiezas();
        //Mostramos las piezas en una tabla
    ?>
        <form action="#" method="post">
            <table class="table table-striped">
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
                    foreach ($piezas as $p) {
                        echo '<tr>';
                        if (isset($_POST['modif']) and $_POST['modif'] == $p->getCodigo()) {
                            //Pintar campos para poder modificar
                            echo '<td> <input type="text" name="codigo" maxlenght="3" value="' . $p->getCodigo() . '"/></td>';
                            echo '<td><select name="clase">';
                            echo '<option ' . marcarClaseSeleccionada('Refrigeración', $p->getClase()) . '>Refrigeración</option>';
                            echo '<option ' . marcarClaseSeleccionada('Filtro', $p->getClase()) . '>Filtro</option>';
                            echo '<option ' . marcarClaseSeleccionada('Motor', $p->getClase()) . '>Motor</option>';
                            echo '<option ' . marcarClaseSeleccionada('Otros', $p->getClase()) . '>Otros</option>';
                            echo '</select></td>';
                            echo '<td> <input type="text" name="desc" value="' . $p->getDescripcion() . '"/></td>';
                            echo '<td> <input type="number" name="precio" step="0.01" value="' . $p->getPrecio() . '"/></td>';
                            echo '<td> <input type="number" name="stock" value="' . $p->getStock() . '"/></td>';
                            echo '<td>';
                            echo '<button type="submit" class="btn btn-outline-dark" name="update" value="' . $p->getCodigo() . '">Guardar</button>';
                            echo '<button type="submit" class="btn btn-outline-dark" name="cancelar">Cancelar</button>';
                            echo '</td>';
                        } else {
                            echo '<td>' . $p->getCodigo() . '</td>';
                            echo '<td>' . $p->getClase() . '</td>';
                            echo '<td>' . $p->getDescripcion() . '</td>';
                            echo '<td>' . $p->getPrecio() . '</td>';
                            echo '<td>' . $p->getStock() . '</td>';
                            echo '<td>';
                            echo '<button type="submit" class="btn btn-outline-dark" name="modif" value="' . $p->getCodigo() . '"><img src="../icon/modif25.png"/></button>';
                            echo '<button type="button" class="btn btn-outline-dark"  data-bs-toggle="modal"  data-bs-target="#a' . $p->getCodigo() . '" name="avisar" value="' . $p->getCodigo() . '"><img src="../icon/delete25.png"/></button>';
                            echo '</td>';
                        }
                        echo '</tr>';

                        //Definir ventana modal
                    ?>
                        <!-- The Modal -->
                        <div class="modal" id="a<?php echo $p->getCodigo(); ?>">
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
                                        <button type="submit" name="borrar" value="<?php echo $p->getCodigo(); ?>" class="btn btn-danger" data-bs-dismiss="modal">Borrar</button>
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