<?php
//Ver si hay usuario logueado
session_start();
$us = null;
if (isset($_SESSION['usuario'])) {
  $us = $_SESSION['usuario'];
} else {
  //Redirigir a login
  header('location:../usuario/login.php');
}
?>
<!-- Grey with black text -->
<nav class="navbar navbar-expand-sm bg-light navbar-light">
  <div class="container-fluid">
    <ul class="navbar-nav">
      <?php
      if ($us->getPerfil() == 'A') {
        echo '<li class="nav-item">
                <a class="nav-link active" href="../usuario/controllerUsuario.php">Usuarios</a>
              </li>';
      }
      ?>
      <li class="nav-item">
        <a class="nav-link active" href="../pieza/controllerPieza.php">Piezas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="../vehiculo/controllerVehiculo.php">Vehículos</a>
      </li>
      <?php
      if ($us->getPerfil() == 'M') {
        echo '<li class="nav-item">
                <a class="nav-link active" href="../reparacion/conotrollerReparacion.php">Reparaciones</a>
              </li>';
      }
      ?>
    </ul>
    <ul class="navbar-nav ms-auto">
      <li class="nav-item">
        <span class="nav-link"><?php echo $us->getNombre() ?></span>

      </li>
      <li class="nav-item">
        <a class="nav-link active" href="../usuario/login.php?accion=cerrar">Salir</a>
      </li>
    </ul>
  </div>
</nav>