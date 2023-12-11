<?php
    if(isset($_POST['acceder'])){
        if(empty($_POST['usuario']) or empty($_POST['ps'])){
            //Mostrar error
            $mensaje = 'Error, rellena us y ps';
        }
        else{
            //Hacer login
        }
    }
?>
<!doctype html>
<html>
      <head>
        <meta charset="utf-8">
        <title>Examen 22_23</title>
       </head>
     <body>     	
 			<div> 
                <h1 style='color:red;'>
                <?php echo isset($mensaje)?$mensaje:'';?>
            </h1> 
            </div>    
        	<form action="login.php" method="post">              	
            		<h1>Login</h1>    
            		<div> 
                		<label for="usuario">Id de Empleado</label><br/>           		
                        <input type="text" id="usuario" name="usuario"/>  
                    </div>
                    <div> 
                        <label for="ps">Contraseña</label><br/>                           
                        <input type="password" id="ps"   name="ps"/>      
                    </div>                               
                    <br/><button type="submit" name="acceder">Acceder</button>                        
      		</form>           
	</body>
</html>