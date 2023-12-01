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
        $correo->Username= 'rmmateosv@gmail.com';
        $correo->Password = '';
        $correo->SMTPSecure=PHPMailer::ENCRYPTION_SMTPS;
        $correo->Port=465;

        //Configuración del correo que vamos a escribir
        $correo->setFrom('rmmateosv@gmail.com','Rosa');
        $correo->addAddress($propietario->getEmail(),$propietario->getNombre());
        //Configuración del contenido del mensaje
        $correo->isHTML(true);
        $correo->Subject='Factura Reparación Nº '.$r->getId();
        $correo->Body="<h1>hola mundo</h1>";
        $correo->AltBody="<h1>hola mundo</h1>";
        $correo->addAttachment('../icon/delete25.png');
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
?>