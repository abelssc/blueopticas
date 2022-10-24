<?php
  $errores=[];

  if($_SERVER["REQUEST_METHOD"]=='POST'){
    #obtengo los datos de la superglobal post
    $datosForm=$_POST;
    #creo $user, $password y asigno valores
    extract($datosForm);
    $user??=null;
    $password??=null;
    #NEW
    $usuarioControlador=new ControladorUsuarios();
    $usuarioControlador->ctrIngresoUsuario($user,$password);
    $errores=$usuarioControlador->errores();
  }

?>

<div class="login-background"></div>
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Blue</b>OPTICA</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Ingrese sus datos</p>

      <form action="#" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Usuario" name="user" required  pattern="^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ]+$">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Contraseña" name="password" required pattern="^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ]+$">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <?php foreach ($errores as $error)
        echo "<div class='alert alert-danger'>$error</div>"
        ?>
        <div class="row">
          <div class="col-6">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Recuerdame
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-6">
            <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mb-0 mt-3 text-center">
        <a href="forgot-password.html">Olvide Mi Contraseña</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
