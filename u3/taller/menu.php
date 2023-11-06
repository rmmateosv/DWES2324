<?php
//Ver si hay usuario logueado
session_start();
$us = null;
if (isset($_SESSION['usuario'])) {
  $us = $_SESSION['usuario'];
} else {
  //Redirigir a login
  header('location:..usuario/login.php');
}
?>
<!-- Grey with black text -->
<nav class="navbar navbar-expand-sm bg-light navbar-light">
  <div class="container-fluid">
    <ul class="navbar-nav">
      <?php
      if ($us->getPerfil() == 'A') {
        echo '<li class="nav-item">
                <a class="nav-link active" href="#">Usuarios</a>
              </li>';
      }
      ?>
      <li class="nav-item">
        <a class="nav-link active" href="controllerPieza.php">Piezas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="#">Clientes</a>
      </li>
      <?php
      if ($us->getPerfil() == 'M') {
        echo '<li class="nav-item">
                <a class="nav-link active" href="#">Reparaciones</a>
              </li>';
      }
      ?>
      <li class="nav-item">
        <?php echo $us->getNombre() ?>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="../usuario/login.php?accion=cerrar">Salir</a>
      </li>


    </ul>
  </div>
</nav>