<?php

//Incluir liebrería PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once '../../vendor/autoload.php';

function enviarCorreo(Modelo $bd,Reparacion $r,$detalle, Propietario $propietario){
    $resultado = false;
    try{
        $correo = new PHPMailer(true);   
        //Confirgurar datos del servidor saliente
        $correo->isSMTP();
        $correo->Host = 'smtp.gmail.com';
        $correo->SMTPAuth = true;
        //$correo->Username= 'rmmateosv@gmail.com';
        $correo->Password = '';
        $correo->SMTPSecure=PHPMailer::ENCRYPTION_SMTPS;
        $correo->Port=465;

        //Configuración del correo que vamos a escribir
        $correo->setFrom('rmmateosv@gmail.com','Rosa');
        $correo->addAddress($propietario->getEmail(),$propietario->getNombre());
        //Configuración del contenido del mensaje
        $correo->isHTML(true);
        $correo->CharSet='UTF-8';
        $correo->Subject='Factura Reparación Nº '.$r->getId();
        $texto = textoReparacion($r,$detalle,$propietario);
        $correo->Body=$texto;
        $correo->AltBody="<h1>hola mundo</h1>";
        $correo->addAttachment('../icon/info.png');
        //Enviar correo
        if($correo->send()){
            $resultado=true;
        }
    }
    catch(Exception $e){
        echo $e->getMessage();
    }
    
    return $resultado;
}
function textoReparacion(Reparacion $r,$detalle,Propietario $propietario){
    $texto = "<div style='font-weight:bold;'>Nombre:".$propietario->getNombre()."<br/>";
    $texto .= "DNI:".$propietario->getDni()."</div>";
    $texto .= "<div  style='font-weight:bold;'>Nº Reparación:".$r->getId()."<br/>";
    $texto .= "Fecha".date("d/m/Y",strtotime($r->getFecha()))."</div>";
    $texto .= "<table border='1' rules='all' width='50%'>".
                "<tr><th>Concepto</th><th>Cantidad</th>".
              "<th>Precio Udad</th><th>Total</th></tr>";
    foreach($detalle as $d){
        $texto .= "<tr><td>".$d['Concepto']."</td><td>".$d['Cantidad']."</td>".
              "<td>".$d['Importe']."</td><td>".$d['Total']."</td></tr>";
    }
    $texto .= "<tr><td colspan='3'>Total Reparación</td><td>".
                $r->getImporteTotal()."</td></tr>";
    $texto .= "</table>";
    return $texto;
}
?>