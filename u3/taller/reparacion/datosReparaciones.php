<div class="container p-2 my-2 border">
    <!-- Mostrar usuarios y dar opción a modificar y borrar -->
    <?php
    if (isset($_SESSION['vehiculo'])) {
        $reparaciones = $bd->obtenerReparaciones($_SESSION['vehiculo']);
        //Mostramos los vehículos en una tabla
    ?>
        <form action="" method="post">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Coche</th>
                        <th>Fecha</th>
                        <th>HorasTaller</th>
                        <th>Pagado</th>
                        <th>Usuario</th>
                        <th>PrecioHora</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($reparaciones as $r) {
                        echo '<tr>';
                        if (isset($_POST['modif']) and $_POST['modif'] == $r->getId()) {
                            //Pintar campos para poder modificar
                            echo '<td> <input type="text" name="id" disabled="disabled" value="' . $r->getId() . '"/></td>';
                            echo '<td> <input type="text" name="matricula" value="' . $r->getMatricula() . '"/></td>';
                            echo '<td> <input type="color" name="color" value="' . $r->getColor() . '"/></td>';
                            echo '<td>';
                            echo '<button type="submit" class="btn btn-outline-dark" name="update" value="' . $r->getId() . '">Guardar</button>';
                            echo '<button type="submit" class="btn btn-outline-dark" name="cancelar">Cancelar</button>';
                            echo '</td>';
                        } else {
                            echo '<td>' . $r->getId() . '</td>';
                            echo '<td>' . $r->getCoche() . '</td>';
                            echo '<td>' . $r->getFecha() . '</td>';
                            echo '<td>' . $r->getTiempo() . '</td>';
                            echo '<td>' . $r->getPagado() . '</td>';
                            echo '<td>' . $r->getUsuario() . '</td>';
                            echo '<td>' . $r->getPrecioH() . '</td>';
                            echo '<td>';
                            echo '<button type="submit" class="btn btn-outline-dark" name="modif" value="' . $r->getId()  . '"><img src="../icon/modif25.png"/></button>';
                            echo '<button type="button" class="btn btn-outline-dark"  data-bs-toggle="modal"  data-bs-target="#a' . $r->getId() . '" name="avisar" value="' . $r->getId() . '"><img src="../icon/delete25.png"/></button>';
                            echo '<button type="submit" class="btn btn-outline-dark" name="mostrarR" value="' . $r->getId()  . '">Ver</button>';
                            echo '</td>';
                        }
                        echo '</tr>';

                        //Definir ventana modal
                    ?>
                        <!-- The Modal -->
                        <div class="modal" id="a<?php echo $r->getId(); ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Borrar Reparación</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        ¿Está seguro que desea borrar la reparación nº
                                        <?php
                                        echo $r->getId();
                                        ?> del coche 
                                        <?php 
                                        $bd->obtenerVehiculoId($r->getCoche())->getMatricula()?>?
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="submit" name="borrar" value="<?php echo $r->getId(); ?>" class="btn btn-danger" data-bs-dismiss="modal">Borrar</button>
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