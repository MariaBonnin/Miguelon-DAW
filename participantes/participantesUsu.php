<?php
session_start();
if (empty($_SESSION['mail'])) {
    # Lo redireccionamos al formulario de inicio de sesión
    header("Location: ../login.php");
    # Y salimos del script
    exit();
}
  global $conn;
  $contador=0;
  $conn= new PDO("mysql:host=localhost; dbname=miguelon", "root" , "");
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <title>Participantes</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap');
    </style>

    <script src="https://kit.fontawesome.com/258fd2d625.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../styles/comunesStyles.css">
    <link rel="stylesheet" href="../styles/participantesStyles.css">
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
    <!-- yacipart.ID_Yaci=:idYaci -->
    <div id="cuerpo">
        <div>
            <h2 class="titulo-princip margen-titulo">Participantes en <?php print_r($_GET['nombreY'])?></h2>
        </div>
        <hr class="hr-principal margen-inf-hr">
        <div class="tabla">
            <div class='cabeceras'>
                <h3 class="cabecera ancho">NOMBRE</h3>
                <h3 class="cabecera ancho">CONTACTO</h3>
                <h3 class="cabecera ancho">ENTIDAD</h3>
                <h3 class="cabecera ancho-peque">ROL</h3>
                
            </div>
            <hr class="hr-principal margen-hr">
        <?php
        try{
           $sql= "SELECT * from  participant AS P 
           inner JOIN yacipart AS YP
            on YP.ID_Parti=P.ID
            INNER JOIN yacimient AS Y
            on YP.ID_Yaci=Y.ID
            where Y.nombre= :nombreYaci";
            $resultado = $conn->prepare($sql);
            $resultado->bindValue(":nombreYaci", $_GET['nombreY']);
            $resultado->execute();
            $rolRes;
            while($busqueda= $resultado->fetch(PDO::FETCH_ASSOC)){
                if($busqueda['contacto']==$_SESSION['mail']){
                    $rolRes=$busqueda['rol'];
                }
            }
            //echo $_SESSION['mail'];
            if(strcmp($rolRes,'admin')===0){
                header('Location:participantesAdmin.php?nombreY='.$_GET['nombreY']);
            }else{
            $resultad = $conn->prepare($sql);
            $resultad->bindValue(":nombreYaci", $_GET['nombreY']);
            $resultad->execute();
            while($busqueda= $resultad->fetch(PDO::FETCH_ASSOC)){
                print_r('<div class="fila-datos">'.
                '<div class="dato ancho">'.
                    '<p class="dato-text">'. $busqueda['nombre_ap'] .'</p>'.
                '</div>'.
                '<div class="dato ancho">'.
                    '<p class="dato-text">'. $busqueda['contacto'] .'</p>'.
                '</div>'.
                '<div class="dato ancho">'.
                    '<p class="dato-text">'.$busqueda['entidad'].'</p>'.
                '</div>'.
                '<div class="dato ancho-peque">'.
                    '<p class="dato-text">'.$busqueda['rol'].'</p>'.
                '</div>'.
                '</div>'.
                '<hr class="hr-secundario margen-sup-hr">');

                //Código sin formato (REVISAR)

            //    echo '<div><div>'. $busqueda['nombre_ap'] .'</div>'.
            //    '<div>'. $busqueda['contacto'] .'</div>'.
            //    '<div>'. $busqueda['entidad'] .'</div>'.
            //    '<div>'. $busqueda['rol'] .'</div></div>';
               
            }
            
        }

        }catch(Exception $e){
            die("Error: ". $e->getMessage());
        }
        ?>
        </div>
        <div>
            <button class="btn btn-morado btn-margen-izq btn-margen-der btn-margen-sup ">Abandonar Yacimiento</button>
            <button onclick="window.location='../menu.php'" class="btn btn-naranja btn-margen-der btn-margen-sup ">Volver a menú</button>
        </div>
    </div>
    </div>
    <footer>
        <div class="footer-contenedor">
            <div><a href="#" class="footer-link">Política de privacidad</a></div>
            <div><a href="#" class="footer-link">Contacto</a></div>
            <div><a href="#" class="footer-link">Política de cookies</a></div>
        </div>
    </footer>
    
</body>
</html>