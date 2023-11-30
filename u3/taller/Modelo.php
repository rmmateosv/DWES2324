<?php
require_once 'pieza/Pieza.php';
require_once 'usuario/Usuario.php';
require_once 'vehiculo/Propietario.php';
require_once 'vehiculo/Vehiculo.php';
require_once 'reparacion/Reparacion.php';
require_once 'reparacion/PiezaReparacion.php';
class Modelo
{

    private $conexion;

    const URL = 'mysql:host=localhost;port=3306;dbname=taller';
    const USUARIO = 'root';
    const PS = '';

    function __construct()
    {
        try {
            //Establecer conexión con la BD
            $this->conexion = new PDO(Modelo::URL, Modelo::USUARIO, Modelo::PS);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    function obtenerDetalleReparacion($idR){
        $resultado = array();
        try {
            $consulta = $this->conexion->prepare('call generarFactura(?)');
            $params=array($idR);
            if($consulta->execute($params)){
                //REcuperar el resultado del select de reparación
                if($fila=$consulta->fetch()){
                    $resultado[]=array('Concepto'=>$fila['descripcion'], 'Cantidad'=>$fila['cantidad'],
                    'Importe'=>$fila['importe'], 'Total'=>$fila['total']);
                }
                //REcuperar el resultado del select de piezareparacion
                $consulta->nextRowset();
                while($fila=$consulta->fetch()){
                    $resultado[]=array('Concepto'=>$fila['descripcion'], 'Cantidad'=>$fila['cantidad'],
                    'Importe'=>$fila['importe'], 'Total'=>$fila['total']);
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }
    function pagarR($idR)
    {
        $resultado = false;
        try {
            //Ejecución de función
            $consulta = $this->conexion->prepare('SELECT pagarReparacion(?) as total' );
            $params=array($idR);
            if($consulta->execute($params)){
                if($fila=$consulta->fetch()){
                    $resultado = true;
                    //En no usamos el total que devuelve la función pero
                    //esta es la forma de recuperar lo que devuelve la función
                    $total = $fila['total']; 
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }    
    function borrarPiezaRep($pr){
        $resultado = false;
        try {
            //Hay que hacer dos operaciones en la BD
            //Un delete en piezareparacion
            //Un update en pieza para actualizar el stock
            //=>HAY QUE HACER UNA TRANSACCIÓN PARA GARANTIZAR
            //QUE SIEMPRE SE HACEN LAS DOS OPERACIONES O NINGUNA SI HAY ERROR
            //Iniciar transacción
            $this->conexion->beginTransaction();
            $consulta=$this->conexion->prepare('delete from piezareparacion
                            where reparacion = ? and pieza = ? ');
            $params=array($pr->getR()->getId(),$pr->getP()->getCodigo());
            if($consulta->execute($params)){
                if($consulta->rowCount()==1){
                    //Actualziar el stock
                    $consulta=$this->conexion->prepare('update pieza set 
                                    stock = stock + ? 
                                    where codigo = ?');
                    $params=array($pr->getCantidad(),$pr->getP()->getCodigo());
                    if($consulta->execute($params)){
                        if($consulta->rowCount()==1){
                            $resultado = true;
                            $this->conexion->commit();
                        }
                        else{
                            $this->conexion->rollBack();
                        }
                    }
                    else{
                        $this->conexion->rollBack();
                    }
                }
            }

        } catch (PDOException $e) {
            $this->conexion->rollBack();
            echo $e->getMessage();
        } 
        return $resultado;
    }
    function modificarCantidad($pr,$nuevaCantidad){
        $resultado = false;
        try {
            //Hay que hacer dos operaciones en la BD
            //Un update en piezareparacion
            //Un update en pieza para actualizar el stock
            //=>HAY QUE HACER UNA TRANSACCIÓN PARA GARANTIZAR
            //QUE SIEMPRE SE HACEN LAS DOS OPERACIONES O NINGUNA SI HAY ERROR
            //Iniciar transacción
            $this->conexion->beginTransaction();
            $consulta=$this->conexion->prepare('update piezareparacion set 
                            cantidad = ? 
                            where reparacion = ? and pieza = ? ');
            $params=array($nuevaCantidad,$pr->getR()->getId(),$pr->getP()->getCodigo());
            if($consulta->execute($params)){
                if($consulta->rowCount()==1){
                    //Actualziar el stock
                    $consulta=$this->conexion->prepare('update pieza set 
                                    stock = stock + ?-? 
                                    where codigo = ?');
                    $params=array($pr->getCantidad(),$nuevaCantidad,$pr->getP()->getCodigo());
                    if($consulta->execute($params)){
                        if($consulta->rowCount()==1){
                            $resultado = true;
                            $this->conexion->commit();
                        }
                        else{
                            $this->conexion->rollBack();
                        }
                    }
                    else{
                        $this->conexion->rollBack();
                    }
                }
            }

        } catch (PDOException $e) {
            $this->conexion->rollBack();
            echo $e->getMessage();
        } 
        return $resultado;
    }
    function modificarPR($idR, $pieza, $cantidad){
        $resultado = false;
        try {
            //Hay que hacer dos operaciones en la BD
            //Un insert en piezareparacion
            //Un update en pieza para actualizar el stock
            //=>HAY QUE HACER UNA TRANSACCIÓN PARA GARANTIZAR
            //QUE SIEMPRE SE HACEN LAS DOS OPERACIONES O NINGUNA SI HAY ERROR
            //Iniciar transacción
            $this->conexion->beginTransaction();
            $consulta=$this->conexion->prepare('update piezareparacion set 
                            cantidad = cantidad + ? 
                            where reparacion = ? and pieza = ? ');
            $params=array($cantidad,$idR,$pieza->getCodigo());
            if($consulta->execute($params)){
                if($consulta->rowCount()==1){
                    //Actualziar el stock
                    $consulta=$this->conexion->prepare('update pieza set 
                                    stock = stock - ? 
                                    where codigo = ?');
                    $params=array($cantidad,$pieza->getCodigo());
                    if($consulta->execute($params)){
                        if($consulta->rowCount()==1){
                            $resultado = true;
                            $this->conexion->commit();
                        }
                        else{
                            $this->conexion->rollBack();
                        }
                    }
                    else{
                        $this->conexion->rollBack();
                    }
                }
            }

        } catch (PDOException $e) {
            $this->conexion->rollBack();
            echo $e->getMessage();
        } 
        return $resultado;
    }
    function insertarPR($idR, $pieza, $cantidad){
        $resultado = false;
        try {
            //Hay que hacer dos operaciones en la BD
            //Un insert en piezareparacion
            //Un update en pieza para actualizar el stock
            //=>HAY QUE HACER UNA TRANSACCIÓN PARA GARANTIZAR
            //QUE SIEMPRE SE HACEN LAS DOS OPERACIONES O NINGUNA SI HAY ERROR
            //Iniciar transacción
            $this->conexion->beginTransaction();
            $consulta=$this->conexion->prepare('insert into piezareparacion values 
                        (?,?,?,?)');
            $params=array($idR,$pieza->getCodigo(),$pieza->getPrecio(),$cantidad);
            if($consulta->execute($params)){
                if($consulta->rowCount()==1){
                    //Actualziar el stock
                    $consulta=$this->conexion->prepare('update pieza set 
                                    stock = stock - ? 
                                    where codigo = ?');
                    $params=array($cantidad,$pieza->getCodigo());
                    if($consulta->execute($params)){
                        if($consulta->rowCount()==1){
                            $resultado = true;
                            $this->conexion->commit();
                        }
                        else{
                            $this->conexion->rollBack();
                        }
                    }
                    else{
                        $this->conexion->rollBack();
                    }
                }
            }

        } catch (PDOException $e) {
            $this->conexion->rollBack();
            echo $e->getMessage();
        } 
        return $resultado;
    }
    function obtenerPiezasReparacion($idRep){
        $resultado = array();
        try {
            $consulta = $this->conexion->prepare(
                'select * from piezareparacion as pr 
                inner join pieza p on pr.pieza = p.codigo 
                inner join reparacion r on pr.reparacion = r.id 
                where pr.reparacion = ?');
            $params = array($idRep);
            if($consulta->execute($params)){
                while($fila=$consulta->fetch()){                    
                    //Crear objeto pieza
                    $pieza = new Pieza();  
                    $pieza->rellenar($fila['codigo'],$fila['clase'],$fila['descripcion'],
                    $fila['precio'],$fila['stock']);          
                    //Crear objeto pieza reparación
                    $pr = new PiezaReparacion(
                        new Reparacion($fila['id'],$fila['coche'],$fila['fechaHora'],
                                       $fila['tiempo'],$fila['pagado'],$fila['usuario'],
                                       $fila['precioH'],$fila['importeTotal']),
                        $pieza,
                        $fila['cantidad'],
                        $fila['precio']
                    );
                    $resultado[]=$pr;
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }
    function obtenerPiezaReparacion($idRep,$codigoP){
        $resultado = null;
        try {
            $consulta = $this->conexion->prepare(
                'select * from piezareparacion as pr 
                inner join pieza p on pr.pieza = p.codigo 
                inner join reparacion r on pr.reparacion = r.id 
                where pr.reparacion = ? and pr.pieza = ?');
            $params = array($idRep, $codigoP);
            if($consulta->execute($params)){
                if($consulta->rowCount()==1){
                    $fila=$consulta->fetch();
                    //Crear objeto pieza
                    $pieza = new Pieza();  
                    $pieza->rellenar($fila['codigo'],$fila['clase'],$fila['descripcion'],
                    $fila['precio'],$fila['stock']);          
                    //Crear objeto pieza reparación
                    $resultado = new PiezaReparacion(
                        new Reparacion($fila['id'],$fila['coche'],$fila['fechaHora'],
                                       $fila['tiempo'],$fila['pagado'],$fila['usuario'],
                                       $fila['precioH'],$fila['importeTotal']),
                        $pieza,
                        $fila['cantidad'],
                        $fila['precio']
                    );
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }
    function modificarReparacion(int $id, float $horas,bool $pagado,float $precioH)
    {
        try {
            $consulta = $this->conexion->prepare('update reparacion set tiempo=?,
            pagado=?, precioH=? where id = ?');
            $params = array($horas,$pagado,$precioH,$id);
            if($consulta->execute($params)){
                if($consulta->rowCount()==1){
                    return true;
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return false;
    }
    function crearReparacion(Reparacion $r)
    {
        $resultado = false;
        try {
            $consulta = $this->conexion->prepare("insert into reparacion values 
            (default,?,now(),0,false,?,0,0)");
            $params = array($r->getCoche(), $r->getUsuario());
            if ($consulta->execute($params)) {
                if ($consulta->rowCount() == 1) {
                    $resultado = true;
                    $r->setId($this->conexion->lastInsertId());
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }
    function obtenerReparacion($id)
    {
        $resultado = null;
        try {
            $consulta = $this->conexion->prepare(
                "select * from reparacion where id = ?"
            );
            $params = array($id);
            if ($consulta->execute($params)) {
                if ($fila = $consulta->fetch()) {
                    $resultado = new Reparacion(
                        $fila["id"],
                        $fila["coche"],
                        $fila["fechaHora"],
                        $fila["tiempo"],
                        $fila["pagado"],
                        $fila["usuario"],
                        $fila["precioH"],
                        $fila['importeTotal']
                    );
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }
    function borrarReparacion(int $id)
    {
        $resultado = false;
        try {
            $consulta = $this->conexion->prepare("delete from reparacion where id = ?");
            $params = array($id);
            if ($consulta->execute($params)) {
                if ($consulta->rowCount() == 1) {
                    $resultado = true;
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }
    function obtenerReparaciones($idV)
    {
        $resultado = array();
        try {
            $consulta = $this->conexion->prepare(
                "select * from reparacion where coche = ? order by fechaHora desc"
            );
            $params = array($idV);
            if ($consulta->execute($params)) {
                while ($fila = $consulta->fetch()) {
                    $r = new Reparacion(
                        $fila["id"],
                        $fila["coche"],
                        $fila["fechaHora"],
                        $fila["tiempo"],
                        $fila["pagado"],
                        $fila["usuario"],
                        $fila["precioH"],
                        $fila['importeTotal']
                    );
                    //Añadir reparación a array resultado
                    $resultado[] = $r;
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }
    function obtenerVehiculos($codigoP)
    {
        $resultado = array();
        try {
            $consulta = $this->conexion->prepare('SELECT * from vehiculo 
            where propietario = ?');
            $params = array($codigoP);
            if ($consulta->execute($params)) {
                while ($fila = $consulta->fetch()) {
                    $v = new Vehiculo(
                        $fila['codigo'],
                        $fila['propietario'],
                        $fila['matricula'],
                        $fila['color']
                    );
                    //Añadir el vehículo al array resultado
                    $resultado[] = $v;
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }
    function modificarVehiculo(Vehiculo $v)
    {
        try {
            $consulta = $this->conexion->prepare('update vehiculo set matricula=?,
            color=? where codigo = ?');
            $params = array($v->getMatricula(),$v->getColor(),$v->getCodigo());
            if($consulta->execute($params)){
                if($consulta->rowCount()==1){
                    return true;
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return false;
    }
    function crearVehiculo(Vehiculo $v)
    {
        $resultado = false;
        try {
            $consulta = $this->conexion->prepare('INSERT into vehiculo 
            values(default,?,?,?)');
            $params = array($v->getPropietario(), $v->getMatricula(), $v->getColor());
            if ($consulta->execute($params)) {
                if ($consulta->rowCount() == 1) {
                    $resultado = true;
                    $v->setCodigo($this->conexion->lastInsertId());
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }

    function obtenerVehiculo($m)
    {
        $resultado = null;
        try {
            $consulta = $this->conexion->prepare('SELECT * from vehiculo 
            where matricula = ?');
            $params = array($m);
            if ($consulta->execute($params)) {
                if ($fila = $consulta->fetch()) {
                    $resultado = new Vehiculo(
                        $fila['codigo'],
                        $fila['propietario'],
                        $fila['matricula'],
                        $fila['color']
                    );
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }
    function obtenerVehiculoId($id)
    {
        $resultado = null;
        try {
            $consulta = $this->conexion->prepare('SELECT * from vehiculo 
            where codigo = ?');
            $params = array($id);
            if ($consulta->execute($params)) {
                if ($fila = $consulta->fetch()) {
                    $resultado = new Vehiculo(
                        $fila['codigo'],
                        $fila['propietario'],
                        $fila['matricula'],
                        $fila['color']
                    );
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }
    function crearPropietario(Propietario $p)
    {
        $resultado = false;
        try {
            $consulta = $this->conexion->prepare('INSERT into propietario 
            values(default,?,?,?,?)');
            $params = array($p->getDni(), $p->getNombre(), $p->getTelefono(), $p->getEmail());
            if ($consulta->execute($params)) {
                if ($consulta->rowCount() == 1) {
                    $resultado = true;
                    $p->setId($this->conexion->lastInsertId());
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }

    function obtenerPropietario($dni)
    {
        $resultado = null;
        try {
            $consulta = $this->conexion->prepare('SELECT * from propietario 
            where dni = ?');
            $params = array($dni);
            if ($consulta->execute($params)) {
                if ($fila = $consulta->fetch()) {
                    $resultado = new Propietario(
                        $fila['codigo'],
                        $fila['dni'],
                        $fila['nombre'],
                        $fila['telefono'],
                        $fila['email']
                    );
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }
    function obtenerPropietarios()
    {
        $resultado = array();
        try {
            $datos = $this->conexion->query('select * from propietario 
                                                order by nombre');
            while ($fila = $datos->fetch()) {
                $p = new Propietario(
                    $fila[0],
                    $fila[1],
                    $fila[2],
                    $fila[3],
                    $fila[4]
                );
                $resultado[] = $p;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }

    function modificarUsuario(Usuario $u)
    {
        $resultado = false;
        try {
            $consulta = $this->conexion->prepare(
                'UPDATE usuarios 
                    set dni=?, nombre=?, perfil=? where id=?'
            );
            $params = array($u->getDni(), $u->getNombre(), $u->getPerfil(), $u->getId());
            if ($consulta->execute($params)) {
                if ($consulta->rowCount() == 1) {
                    $resultado = true;
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }
    function borrarVehiculo(int $codigo)
    {
        $resultado = false;
        try {
            $consulta = $this->conexion->prepare("delete from vehiculo where codigo = ?");
            $params = array($codigo);
            if ($consulta->execute($params)) {
                if ($consulta->rowCount() == 1) {
                    $resultado = true;
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }
    function borrarUsuario(int $id)
    {
        $resultado = false;
        try {
            $consulta = $this->conexion->prepare("delete from usuarios where id = ?");
            $params = array($id);
            if ($consulta->execute($params)) {
                if ($consulta->rowCount() == 1) {
                    $resultado = true;
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }
    function crearUsuario(Usuario $u)
    {
        $resultado = false;
        try {
            $consulta = $this->conexion->prepare('insert into 
                usuarios values(default,?,?,sha2(?,512),?)');
            $params = array($u->getDni(), $u->getNombre(), $u->getDni(), $u->getPerfil());
            if ($consulta->execute($params)) {
                if ($consulta->rowCount() == 1) {
                    //REcuperar el autonúmerico asignado en insert
                    $u->setId($this->conexion->lastInsertId());
                    $resultado = true;
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }
    function obtenerUsuarios()
    {
        $resultado = array();
        try {
            $datos = $this->conexion->query("select * from usuarios order by perfil, nombre");
            while ($fila = $datos->fetch()) {
                $u = new Usuario(
                    $fila['id'],
                    $fila['dni'],
                    $fila['nombre'],
                    $fila['perfil']
                );
                //Añadir a resultado
                $resultado[] = $u;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }
    function obtenerUsuarioId(int $id)
    {
        $resultado = null;
        try {
            $consulta = $this->conexion->prepare('select * from usuarios 
                            where id = ?');
            $params = array($id);
            if ($consulta->execute($params)) {
                //Ver si se ha devuelto 1 registro con el usuario
                if ($fila = $consulta->fetch()) {
                    //Se ha encontrado el usuario
                    $resultado = new Usuario(
                        $fila['id'],
                        $fila['dni'],
                        $fila['nombre'],
                        $fila['perfil']
                    );
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }
    function obtenerUsuarioDni(string $dni)
    {
        $resultado = null;
        try {
            $consulta = $this->conexion->prepare('select * from usuarios 
                            where dni = ?');
            $params = array($dni);
            if ($consulta->execute($params)) {
                //Ver si se ha devuelto 1 registro con el usuario
                if ($fila = $consulta->fetch()) {
                    //Se ha encontrado el usuario
                    $resultado = new Usuario(
                        $fila['id'],
                        $fila['dni'],
                        $fila['nombre'],
                        $fila['perfil']
                    );
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }
    function obtenerUsuario(string $us, string $ps)
    {
        $resultado = null;
        try {
            $consulta = $this->conexion->prepare('select * from usuarios 
                            where dni = ? and ps = sha2(?,512)');
            $params = array($us, $ps);
            if ($consulta->execute($params)) {
                //Ver si se ha devuelto 1 registro con el usuario
                if ($fila = $consulta->fetch()) {
                    //Se ha encontrado el usuario
                    $resultado = new Usuario(
                        $fila['id'],
                        $fila['dni'],
                        $fila['nombre'],
                        $fila['perfil']
                    );
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }

    function modificarPieza(Pieza $p, string $codigoAntiguo)
    {
        $resultado = false;
        try {
            $consulta = $this->conexion->prepare("update pieza set codigo=?,
            clase = ?, descripcion = ?, precio = ?, stock = ? where codigo = ?");
            $params = array(
                $p->getCodigo(), $p->getClase(), $p->getDescripcion(),
                $p->getPrecio(), $p->getStock(), $codigoAntiguo
            );
            if ($consulta->execute($params)) {
                if ($consulta->rowCount() == 1) {
                    $resultado = true;
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }
    function existenReparacionesUsuario(int $id)
    {
        $resultado = false;
        try {
            $consulta = $this->conexion->prepare("select * from reparacion 
                            where usuario = ?");
            $parametros =  array($id);
            if ($consulta->execute($parametros)) {
                if ($consulta->fetch()) {
                    $resultado = true;
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }
    function existenReparacionesPieza(string $codigo)
    {
        $resultado = false;
        try {
            $consulta = $this->conexion->prepare("select * from piezareparacion 
                            where pieza = ?");
            $parametros =  array($codigo);
            if ($consulta->execute($parametros)) {
                if ($consulta->fetch()) {
                    $resultado = true;
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }
    function borrarPieza(string $codigo)
    {
        $resultado = false;
        try {
            $consulta = $this->conexion->prepare("delete from pieza where codigo = ?");
            $parametros =  array($codigo);
            if ($consulta->execute($parametros)) {
                //Comprobar si se ha borrado al menos 1 registro
                //En ese caso, ponemos resultado = true
                //rowcount devuelve el nº de registros borrados
                if ($consulta->rowCount() == 1) {
                    $resultado = true;
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }
    function insertarPieza(Pieza $p)
    {
        $resultado = false;
        try {
            $consulta = $this->conexion->prepare(
                'insert into pieza values (?,?,?,?,?)'
            );
            $parms = array(
                $p->getCodigo(), $p->getClase(), $p->getDescripcion(),
                $p->getPrecio(), $p->getStock()
            );

            // Esta opción equivale al if 
            //return $consulta->execute($parms);
            if ($consulta->execute($parms)) {
                $resultado = true;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }
    function obtenerPieza($codigo)
    {
        $resultado = null;
        try {
            $consulta = $this->conexion->prepare('select * from pieza where codigo = ?');
            $parms = array($codigo);
            if ($consulta->execute($parms)) {
                //REcuperar el registro y crear un objeto Pieza en resultado
                if ($fila = $consulta->fetch()) {
                    $resultado = new Pieza();
                    $resultado->setCodigo($fila['codigo']);
                    $resultado->setClase($fila['clase']);
                    $resultado->setDescripcion($fila['descripcion']);
                    $resultado->setPrecio($fila['precio']);
                    $resultado->setStock($fila['stock']);
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }
    function obtenerPiezas()
    {
        //Devuelve un array de objetos Pieza
        $resultado = array();
        try {
            //Ejecutamos consulta
            $datos = $this->conexion->query('select * from pieza order by codigo');
            if ($datos !== false) {
                //Recorrer los datos para crear objetos Pieza
                while ($fila = $datos->fetch()) {
                    //Creamos Pieza
                    $p = new Pieza();
                    $p->setCodigo($fila['codigo']);
                    $p->setClase($fila['clase']);
                    $p->setDescripcion($fila['descripcion']);
                    $p->setPrecio($fila['precio']);
                    $p->setStock($fila['stock']);
                    //Añadir pieza al arrry resultado
                    $resultado[] = $p;
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }


    /**
     * Get the value of conexion
     */
    public function getConexion()
    {
        return $this->conexion;
    }

    /**
     * Set the value of conexion
     *
     * @return  self
     */
    public function setConexion($conexion)
    {
        $this->conexion = $conexion;

        return $this;
    }
}
