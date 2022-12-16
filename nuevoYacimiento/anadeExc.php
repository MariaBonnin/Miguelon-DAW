<?php
  session_start();
  if (empty($_SESSION['mail'])) {
      # Lo redireccionamos al formulario de inicio de sesión
      header("Location: ../login.php");
      # Y salimos del script
      exit();
  }
  
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <title>Nuevo Yacimiento</title>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap');
    </style>

    <script src="https://kit.fontawesome.com/258fd2d625.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../styles/comunesStyles.css">
    <link rel="stylesheet" href="../styles/anadeExcStyles.css">
</head>
<body>


    <header>
        <div class="logo2-contenedor">
            <img src="../images/logo2.png" alt="logo" class="logo2-img">
        </div>

        <div class="contenedor-usuario">
            <a href="../cierraSesion.php">Cerrar sesión <i class="fa-solid fa-right-from-bracket"></i></a>
        </div>
    </header>
 <div id="cuerpo">
        <h2 class="titulo-princip margen-titulo">Nuevo yacimiento</h2>
        <hr class="hr-principal">
        <h2 class="titulo-secundario margen-titulo">Datos</h2>
        <hr class="hr-secundario margen-inf-hr">
        <form action="gestionaNuevoYac.php" id="cuadrInt" method="POST">
            <div class="form-contenedor">
                <div class="input-contenedor">
                    <label class="yacim-label">Nombre</label>
                    <input type='text' id='nombreY' name='nombreY' class="yacim-input">
                </div>
                <div class="input-contenedor">
                    <label class="yacim-label">Emplazamiento</label>
                    <input type='text' name='empY' class="yacim-input">
                </div>
                <div class="input-contenedor">
                    <label class="yacim-label">Fecha inicio</label>
                    <input type='date' name='fechaI' class="yacim-input cursor-mano">
                </div>
                <div class="input-contenedor">
                    <label class="yacim-label">Fecha fin</label>
                    <input type='date' name='fechaF' class="yacim-input cursor-mano">
                </div>
                <div class="input-contenedor">
                    <input name='enviaY' type='button' id='enviaY' value='Enviar' class='btn btn-morado btn-margen-der'>
                    <input name='cancelY' type='button' id='cancelY' onclick="window.location='../menu.php'" value='Volver a menú' class='btn btn-naranja'>
                </div>
            </div>
        </form>
</div>
        <script src="gestionaNuevoYac.js"></script>
        <?php
        if(isset($_GET['MessageNY'])){
            
                echo '<script>Swal.fire({
                    title:"Ha ocurrido un error y no se ha podido crear el yacimiento",
                    text:"Contacte con los administradores",
                    icon:"warning",
                    button:"OK",
                    }).then((result) => {
                        window.location="../menu.php";
                    })</script>';
            }
        
          
            
        ?>
    <footer>
        <div class="footer-contenedor">
            <div><a href="#" class="footer-link">Política de privacidad</a></div>
            <div><a href="#" class="footer-link">Contacto</a></div>
            <div><a href="#" class="footer-link">Política de cookies</a></div>
        </div>
    </footer>
</body>
</html>