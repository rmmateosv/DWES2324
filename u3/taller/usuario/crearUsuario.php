<div class="container p-2 my-2 border">
    <!-- Crear Pieza -->
    <form action="#" method="post">
        <div class="row">
            <div class="col">
                <label>DNI</label>
            </div>
            <div class="col">
                <label>Nombre</label>
            </div>
            <div class="col">
                <label>Perfil</label>
            </div>
            <div class="col">
            </div>
        </div>
        <div class="row">
            <div class="col">
                <input type="text" name="dni" placeholder="012345678A" maxlength="9" />
            </div>
            <div class="col">
                <input type="text" name="nombre" placeholder="Nombre Usuario" />
            </div>
            <div class="col">
                <select name="perfil" class="form-select form-select-sm">
                    <option value="A">Administrador</option>
                    <option value="M">Mecánico</option>
                </select>
            </div>
            <div class="col">
                <input type="submit" name="crear" value="Crear" class="btn btn-outline-dark" />
                <input type="reset" name="limpiar" value="Cancelar" class="btn btn-outline-dark" />
            </div>
        </div>
    </form>
</div>