<?php
function marcarOptionSeleccionado($option, $optionSeleccionado)
{
    if ($option == $optionSeleccionado) {
        return 'selected="selected"';
    }
}
?>
<div class="container p-2 my-2 border">
    <!-- Crear Pieza Reparaci'on-->
    <form action="#" method="post">
        <div class="row">
            <div class="col">
                <label>Pieza</label>
            </div>
            <div class="col">
                <label>Cantidad</label>
            </div>
            <div class="col">
            </div>
        </div>
        <div class="row">
            <div class="col">
                <?php $piezas = $bd->obtenerPiezas() ?>
                <select name="pieza">
                    <?php                   
                    foreach ($piezas as $p) {
                        echo '<option value="' . $p->getCodigo() . '">' . $p->getClase() .
                            '-' . $p->getDescripcion() . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="col">
                <input type="number" name="cantidad" value="1" />
            </div>
            <div class="col">
                <input type="submit" name="crearPR" value="Crear" class="btn btn-outline-dark" />
                <input type="reset" name="limpiar" value="Cancelar" class="btn btn-outline-dark" />
            </div>
        </div>
    </form>
</div>
<!-- The Modal -->
<div class="modal" id="crearPropietario">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Nuevo Propietario</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="#" method="post">
                <!-- Modal body -->
                <div class="modal-body">
                    <label for="dni">Dni</label><br />
                    <input id="dni" type="text" name="dni" placeholder="11111111A" />
                    <br />
                    <label for="nombre">Nombre</label><br />
                    <input id="nombre" type="text" name="nombre" placeholder="nombre" />
                    <br />
                    <label>Teléfono</label><br />
                    <input type="text" name="telefono" placeholder="612345432" />
                    <br />
                    <label>Email</label><br />
                    <input type="email" name="email" placeholder="aa@aa.com" />
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" name="insertP" value="insertP" class="btn btn-success" data-bs-dismiss="modal">Crear</button>
                    <button type="button" name="cancelar" value="cancelar" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>