<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="Ejercicio14_tratamiento.php" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>Datos Personales</legend>
            <div>
                <label>Nombre</label>
                <br/>
                <input type="text" name="nombre" placeholder="Escribe tu  nombre"/>
            </div>
            <div>
                <label>Apellidos</label>
                <br/>
                <input type="text" name="apellidos"/>
            </div>
            <div>
                <label>Contraseña</label>
                <br/>
                <input type="password" name="ps"/>
            </div>
            <div>
                <label>Sexo</label>
                <br/>
                <input type="radio" name="sexo" checked="checked" value="Hombre"/>Hombre
                <input type="radio" name="sexo" value="Mujer"/>Mujer
            </div>
            <div>
                <label>Fecha Nacimiento</label>
                <input type="date" name="fechaN"/>
            </div>
            <div>
                <label>Pais</label>
                <select name="pais[]" multiple="multiple">
                    <option>Francia</option>
                    <option selected="selected">España</option>
                    <option>EEUU</option>
                </select>
            </div>
        </fieldset>
        <fieldset>
            <legend>Información adicional</legend>
            <div>
                <label>Nº de hijos</label>
                <br/>
                <select name="nHijos">
                    <option>1</option>
                    <option selected="selected">2</option>
                    <option>3</option>
                    <option>4 o más</option>
                </select>
            </div>
            <div>
                <label>Sube tu foto</label>
                <input type="file" name="foto"/>
            </div>
            <div>
                <label>Aficciones</label>
                <input type="checkbox" name="aficc[]" value="Cine"/>Cine
                <input type="checkbox" name="aficc[]" value="Deporte"/>Deporte
                <input type="checkbox" name="aficc[]" value="Literatura"/>Literatura
            </div>
            <div>
                <label>Comentario</label>
                <textarea name="comentario" placeholder="Escribe más sobre ti"></textarea>
            </div>
        </fieldset>
        <input type="submit" name="validar" value="Validar">
        <input type="submit" name="enviar" value="Enviar">
    </form>
</body>
</html>