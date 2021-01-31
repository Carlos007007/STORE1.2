<?php 
    session_start(); 
    error_reporting(E_PARSE);
?>
<nav id="navbar-auto-hidden">
        <div class="row hidden-xs">
            <div class="col-xs-4">
                <p class="text-navbar tittles-pages-logo">STORE</p>
            </div>
            <div class="col-xs-8">
              <div class="contenedor-tabla pull-right">
                <div class="contenedor-tr">
                  <a href="index.php" class="table-cell-td">Inicio</a>
                  <a href="product.php" class="table-cell-td">Productos</a>
                  <?php
                      if(!$_SESSION['nombreAdmin']==""){
                          echo ' 
                              <a href="carrito.php" class="table-cell-td">Carrito</a>
                              <a href="configAdmin.php" class="table-cell-td">Administración</a>
                              <a href="#!" class="table-cell-td exit-system">
                                  <i class="fa fa-user"></i>&nbsp;&nbsp;'.$_SESSION['nombreAdmin'].'
                              </a>
                           ';
                      }else if(!$_SESSION['nombreUser']==""){
                          echo ' 

                              <a href="pedido.php" class="table-cell-td">Pedido</a>
                              <a href="carrito.php" class="table-cell-td">Carrito</a>
                              <a href="#!" class="table-cell-td exit-system">
                              <i class="fa fa-user"></i>&nbsp;&nbsp;'.$_SESSION['nombreUser'].'
                              </a>
                              <a href="#!" class="table-cell-td userConBtn" data-code="'.$_SESSION['UserNIT'].'">
                                <i class="glyphicon glyphicon-cog"></i>
                              </a>
                           ';
                      }else{
                          echo ' 

                          <a href="registration.php" class="table-cell-td">Registro</a>
                              <a href="#" class="table-cell-td" data-toggle="modal" data-target=".modal-login">
                                  <i class="fa fa-user"></i>&nbsp;&nbsp;Login
                              </a>
                           ';
                      }
                  ?>
                </div>
              </div>
            </div>
        </div>

        <div class="row visible-xs"><!-- Mobile menu navbar -->
            <div class="col-xs-12">
                <button class="btn btn-default pull-left button-mobile-menu" id="btn-mobile-menu">
                    <i class="fa fa-th-list"></i>&nbsp;&nbsp;Menú
                </button>
               
                <?php
                if(!$_SESSION['nombreAdmin']==""){echo '
                    <a href="#"  id="button-login-xs" class="elements-nav-xs exit-system">
                        <i class="fa fa-user"></i>&nbsp; '.$_SESSION['nombreAdmin'].' 
                    </a>';
                }else if(!$_SESSION['nombreUser']==""){
                    echo '
                    <a href="#"  id="button-login-xs" class="elements-nav-xs exit-system">
                        <i class="fa fa-user"></i>&nbsp; '.$_SESSION['nombreUser'].' 
                    </a>';
                }else{
                    echo '
                       <a href="#" data-toggle="modal" data-target=".modal-login" id="button-login-xs" class="elements-nav-xs">
                        <i class="fa fa-user"></i>&nbsp; Iniciar Sesión
                        </a> 
                   ';
                }
                ?>
            </div>
        </div>
    </nav>
   
    <div class="modal fade modal-login" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm">
          <div class="modal-content" id="modal-form-login" style="padding: 15px;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <p class="text-center text-primary">
                <i class="fa fa-user-circle-o fa-3x" aria-hidden="true"></i>
              </p>
              <h4 class="modal-title text-center text-primary" id="myModalLabel">Iniciar sesión</h4>
            </div>
            <form action="process/login.php" method="post" role="form" class="FormCatElec" data-form="login">
                <div class="form-group label-floating">
                    <label class="control-label"><span class="glyphicon glyphicon-user"></span>&nbsp;Nombre</label>
                    <input type="text" class="form-control" name="nombre-login" required="">
                </div>
                <div class="form-group label-floating">
                    <label class="control-label"><span class="glyphicon glyphicon-lock"></span>&nbsp;Contraseña</label>
                    <input type="password" class="form-control" name="clave-login" required="">
                </div>

                <p>¿Cómo iniciaras sesión?</p>
               
                <div class="radio">
                  <label>
                      <input type="radio" name="optionsRadios" value="option1" checked="">
                      Usuario
                  </label>
               </div>

               <div class="radio">
                  <label>
                      <input type="radio" name="optionsRadios" value="option2">
                       Administrador
                  </label>
               </div>
               
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary btn-raised btn-sm">Iniciar sesión</button>
                  <button type="button" class="btn btn-danger btn-raised btn-sm" data-dismiss="modal">Cancelar</button>
                </div>
                <div class="ResFormL" style="width: 100%; text-align: center; margin: 0;"></div>
            </form>
          </div>
      </div>
    </div>
    <!-- Fin Modal login -->
    
    <div id="mobile-menu-list" class="hidden-sm hidden-md hidden-lg">
        <br>
        <h3 class="text-center tittles-pages-logo">STORE</h3>
        <button class="btn btn-default button-mobile-menu" id="button-close-mobile-menu">
        <i class="fa fa-times"></i>
        </button>
        <br><br>
        <ul class="list-unstyled text-center">
            <li><a href="index.php">Inicio</a></li>
            <li><a href="product.php">Productos</a></li>
            <li><a href="carrito.php">Carrito</a></li>
            <?php 
                if(!$_SESSION['nombreAdmin']==""){
                    echo '<li><a href="configAdmin.php">Administración</a></li>';
                }elseif(!$_SESSION['nombreUser']==""){
                    echo '
                    <li><a href="pedido.php">Pedido</a></li>
                    <li><a href="#" class="glyphicon glyphicon-cog userConBtn" data-code="'.$_SESSION['UserNIT'].'"> Configuraciones</a></li>
                    ';
                }else{
                    echo '<li><a href="registration.php">Registro</a></li>';
                }
            ?>
        </ul>
    </div>
    <?php if(isset($_SESSION['nombreUser'])): ?>
    <div class="modal fade" id="ModalUpUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <form class="modal-content FormCatElec" action="process/updateClient.php" method="POST" data-form="save" autocomplete="off">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Configuraciones</h4>
          </div>
          <div class="modal-body" id="UserConData">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-info">Guardar cambios</button>
          </div>
        </form>
      </div>
    </div>
    <?php  endif;?>