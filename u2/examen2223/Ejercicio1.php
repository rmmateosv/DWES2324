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
            <input type="text" name="dni" placeholder="12345678L"/>
        </div>
        <div>
            <label>Nombre Cliente</label><br/>
            <input type="text" name="nombre" placeholder="Nombre del Cliente"/>
        </div>
        <br/>
        <div>
            <label>Tipo de habitación</label><br/>
            <select name="tipoH">
                <option selected="selected">Doble</option>
                <option>Individual</option>
                <option>Suite</option>
            </select>
        </div>
        <br/>
        <div>
            <label>Número de noches</label><br/>
            <input type="number" name="numero"/>
        </div>
        <div>
            <label>Estancia</label><br/>
            <select name="estancia">
                <option>Diario</option>
                <option>Fin de semana</option>
                <option>Promocionado</option>
            </select>
        </div>
        <br/>
        <div>
            <label>Pago</label><br/>
            <input type="radio" name="pago" value="Efectivo"/>Efectivo
            <input type="radio" name="pago" value="Tarjeta" checked="checked"/>Tarjeta
        </div>
        <br/>
        <div>
            <label>Opciones</label><br/>
            <input type="checkbox" name="opciones[]" value="1"/>Cuna
            <input type="checkbox" name="opciones[]" value="2"/>Cama Supletoria
            <input type="checkbox" name="opciones[]" value="3"/>Lavandería            
        </div>
        <br/>
        <div>
            <input type="submit" name="crear" value="Crear Estancia"/>
            <input type="submit" name="ver" value="Ver Estancias"/>
        </div>
    </form>
    <?php
    ?>
</body>
</html>