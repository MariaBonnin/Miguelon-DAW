<?php
    session_start();
    if (empty($_SESSION['mail'])) {
        # Lo redireccionamos al formulario de inicio de sesión
        header("Location: login.php");
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <title>Menu</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style> @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap'); </style>
    
    <script src="https://kit.fontawesome.com/258fd2d625.js" crossorigin="anonymous"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.2/iconify-icon.min.js"></script>


    <link rel="stylesheet" href="./styles/comunesStyles.css">
    <link rel="stylesheet" href="./styles/menuStyles.css">
</head>
<body>
    <?php
    
   global $conn;
     $conn= new PDO("mysql:host=localhost; dbname=miguelon", "root" , "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  
    if(isset($_GET['MessageNY'])){
        echo '<script>Swal.fire({
                        title:"Nuevo yacimiento creado",
                        icon:"success",
                        button:"OK",
                        }).then((result) => {
                            window.location="menu.php";
                        })</script>';
    }
       ?>
 

    <header>
        <div class="logo2-contenedor">
            <img src="./images/logo2.png" alt="logo" class="logo2-img">
        </div>

        <div class="contenedor-usuario">
            <a href="cierraSesion.php">Cerrar sesión <i class="fa-solid fa-right-from-bracket"></i></a>
        </div>
    </header>

    <div id="cuerpo">
        <div class="body-head">
            <h2 class="titulo-princip">Excavaciones actuales</h2>
            <button name="nuevaExc" id="nuevaExc" class="btn btn-morado-claro btn-excavation">Nueva excavación</button>
        </div>
        <hr class="hr-principal margen-hr">
        <div name='excAct'>
            <?php
            //TODO: AND usuario=x
            $sql="SELECT nombre from  yacimient AS Y 
           inner JOIN yacipart AS YP
            on  YP.ID_Yaci=Y.ID  
            INNER JOIN participant AS P
            on YP.ID_Parti=P.ID
            where Y.estado='activo'
      and P.contacto='".$_SESSION['mail']."'";
     $muestraAc = $conn->query($sql);
     foreach ($muestraAc as $val) {
            echo '<div name="registrosAct" class="contenedor-yacim">'.
            '<div class="nombre-yacim">'.
                '<p name="nombreYac">'.
                    '<iconify-icon inline icon="openmoji:bone" width="25" class="hueso-icon"></iconify-icon>'.
                    $val['nombre'].
                '</p>'.
            '</div>'.
            '<div class="btn-yacim">'.
            '<input type="hidden" name="nombreYac" value="'.$val['nombre'].'">'.
                '<button name="datos" class="btn btn-morado" onclick="" >Datos</button>'.
                '<button name="participantes" class="btn btn-morado" onclick="abrePart(this)">Participantes</button>'.
                '<button name="anadeEnt" class="btn btn-naranja" onclick="nuevoEnt(this)">Añadir enterramiento</button>'.
            '</div>'.
        '</div>'.
        '<hr class="hr-secundario margen-hr">';



        //     echo '<div name="registrosAct">
        //     <p name="nombreYac">'.$val['nombre'].'</p>'.
            
        // '<input type="hidden" name="nombreYac" value="'.$val['nombre'].'">'.
        //     '<button name="datos" onclick="" >Datos</button>'.
        //     '<button name="participantes" onclick="abrePart(this)">Participantes</button>'.
        //     '<button name="anadeEnt">Añadir enterramiento</button></div>';
         }
    ?>
        </div>
        <div class="margen-titulo">
            <h2 class="titulo-princip">Excavaciones finalizadas</h2>
        </div>
        <hr class="hr-principal margen-hr">
        <div name='excFin'>
        <?php
     $muestra = $conn->query("SELECT nombre from yacimient where estado='finalizado'");
     foreach ($muestra as $val) {

            echo '<div name="registrosFin" class="contenedor-yacim">'.
                '<div class="nombre-yacim">'.
                    '<p name="nombreYac">'.
                        '<iconify-icon inline icon="openmoji:bone" width="25" class="hueso-icon"></iconify-icon>'.$val['nombre'].
                    '</p>'.
                '</div>'.
                '<div class="btn-yacim">'.
                    '<input type="hidden" name="nombreYac" value="'.$val['nombre'].'">'.
                    '<button name="datos" class="btn btn-morado">Datos</button>'.
                    '<button name="participantes" class="btn btn-morado">Participantes</button>'.
                '</div>'.
            '</div>'.
            '<hr class="hr-secundario margen-hr">';   


        // echo '<div name="registrosFin">
        // <p name="nombreYac">'.$val['nombre'].'</p>'.
        // '<input type="hidden" name="nombreYac" value="'.$val['nombre'].'">'.
        // '<button name="datos">Datos</button>'.
        // '<button name="participantes">Participantes</button>';
     }
    ?>
        </div>
    </div>
    <script type="text/javascript">
    document.getElementById("nuevaExc").onclick = function () {
        location.href = "./nuevoYacimiento/anadeExc.php";
    }
    function abrePart(e){
        let nomYac=$($($(e).parent()).children()[0]).val();
        location.href = "./participantes/participantesUsu.php?nombreY="+nomYac;
    }
    function nuevoEnt(e){
        let nomYac=$($($(e).parent()).children()[0]).val();
        location.href = "./anadeEnterramiento/formAnadeEnt.php?nombreY="+nomYac;
    }

    
   
</script>
    <footer>
        <div class="footer-contenedor">
            <div><a href="#" class="footer-link">Política de privacidad</a></div>
            <div><a href="#" class="footer-link">Contacto</a></div>
            <div><a href="#" class="footer-link">Política de cookies</a></div>
        </div>
    </footer>
</body>
</html>