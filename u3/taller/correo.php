<?php

//Incluir liebrería PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function enviarCorreo($r,$detalle){
    $resultado = false;
    try{
        $correo = new PHPMailer(true);   
        //Confirgurar datos del servidor saliente
        $correo->isSMTP();
        $correo->Host = 'smtp.gmail.com';
        $correo->SMTPAuth = true;
        $correo->Username= 'rmmateosv@gmail.com';
        $correo->Password = '';

    }
    catch(Exception $e){
        echo $e->getMessage();
    }
    
    return $resultado;
}
?>