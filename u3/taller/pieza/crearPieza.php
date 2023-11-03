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