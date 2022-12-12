<!-- <?php
session_start();
if (empty($_SESSION['mail'])) {
    # Lo redireccionamos al formulario de inicio de sesión
    header("Location: ../login.php");
    # Y salimos del script
    exit();
}
?> -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <title>Nuevo Enterramiento</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap');
    </style>

    <script src="https://kit.fontawesome.com/258fd2d625.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../styles/comunesStyles.css">
    <link rel="stylesheet" href="../styles/enterraStyles.css">
</head>

<body>
    <!-- <?php

    global $conn;
    $conn = new PDO("mysql:host=localhost; dbname=miguelon", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    ?> -->


    <header>
        <div class="logo2-contenedor">
            <img src="../images/logo2.png" alt="logo" class="logo2-img">
        </div>

        <div class="contenedor-usuario">
            <a href="../cierraSesion.php">Cerrar sesión <i class="fa-solid fa-right-from-bracket"></i></a>
        </div>
    </header>

    <div id="enterramiento">
        <h2 class="titulo-princip margen-titulo">Nuevo Yacimiento</h2>
        <hr class="hr-principal">
        <form action="gestionaAnadeEnt.php" id="cuadrInt" method="POST">
            <h3 class="titulo-secundario margen-titulo">Datos generales</h3>
            <hr class="hr-secundario margen-inf-hr">
            <div id="datosGen" class="contenedor-datos-generales">

                <div class="contenedor-dato-gen">
                    <label class="texto-input-general">Alias</label>
                    <input class="input-general" type='text' id='nombreE' name='nombreE'>
                </div>
                <div class="contenedor-dato-gen contenedor-select">
                    <label class="texto-input-general">Posición</label>
                    <select class="input-general" name="posicion" id="posicion">
                        <option value="dSupino">Decúbito supino</option>
                        <option value="dProno">Decúbito prono</option>
                        <option value="dLatD">Decúbito lateral derecho</option>
                        <option value="dLatI">Decúbito lateral izquierdo</option>
                    </select>
                </div>
                <div class="contenedor-dato-gen contenedor-select">
                    <label class="texto-input-general">Orientación</label>
                    <select class="input-general" name="orientacion" id="orientacion">
                        <option value="norte">Norte</option>
                        <option value="sur">Sur</option>
                        <option value="este">Este</option>
                        <option value="oeste">Oeste</option>
                    </select>
                </div>
                <div class="contenedor-dato-gen">
                    <label class="texto-input-general">Tamaño Enterramiento</label>
                    <input class="input-general" type='number' step="any" name='tamanoEnt'>
                </div>
                <div class="contenedor-dato-gen">
                    <label class="texto-input-general">Tamaño Individuo</label>
                    <input class="input-general" type='number' step="any" name='tamanoInd'>
                </div>
                <div class="contenedor-dato-gen">
                    <label class="texto-input-general">Edad aproximada</label>
                    <select class="input-general" name='edad' id="edad">
                        <option value="infantil">Infantil</option>
                        <option value="joven">Joven</option>
                        <option value="adulto">Adulto</option>
                    </select>
                </div>
                <div class="contenedor-dato-gen contenedor-select">
                    <label class="texto-input-general">Sexo estimado</label>
                    <select class="input-general" name="sexo" id="sexo">
                        <option value="fem">Femenino</option>
                        <option value="masc">Masculino</option>
                        <option value="des">Desconocido</option>
                    </select>
                </div>
                <div class="contenedor-dato-gen contenedor-select">
                    <label class="texto-input-general">Tipo de descomposición</label>
                    <select class="input-general" name="tipoDesc" id="tipoDesc">
                        <option value="vacio">Vacío</option>
                        <option value="colmatado">Colmatado</option>
                    </select>
                </div>
                <div class="contenedor-dato-gen">
                    <label class="texto-input-general">Causa de la muerte a priori</label>
                    <input class="input-general" type='textarea' id='nombreE' name='nombreE'>
                </div>
                <div class="contenedor-dato-gen contenedor-select">
                    <label class="texto-input-general">Tipo de enterramiento</label>
                    <select class="input-general" name="tipoEnt" id="tipoEnt">
                        <option value="primario">Primario</option>
                        <option value="secundario">Secundario</option>
                    </select>
                </div>
                <div class="contenedor-dato-gen">
                    <label class="texto-input-general">Restos indirectos</label>
                    <div class="cont-doble">
                        <input class="input-general" type="checkbox" id="restosInd" value="restosInd" name="restosInd">
                        <input class="input-general" type='textarea' name='comentariosRestosInd'
                            id='comentariosRestosInd' disabled>
                    </div>
                </div>
            </div>
            
            <h3 class="titulo-secundario margen-titulo">Esqueleto</h3>
            <hr class="hr-secundario margen-inf-hr">
            <div id="huesos" class="contenedor-dat-huesos">


                <!-- -----------CABEZA--------- -->

                <h4 class="titulo-tercero  margen-titulo-tercero">Cabeza</h4>
                <hr class="hr-secundario margen-inf-hr">

                <div class="contenedor-sec-esqueleto">
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="craneo">Cráneo</label>
                        <input class="input-hueso" type="checkbox" name="craneo" id="craneo" value="craneo">
                    </div>
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="mandibula">Mandíbula</label>
                        <input class="input-hueso" type="checkbox" name="mandibula" id="mandibula" value="mandibula">
                    </div>
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="atlas">Atlas</label>
                        <input class="input-hueso" type="checkbox" name="atlas" id="atlas" value="atlas">
                    </div>
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="vCervic">Vértebras Cervicales</label>
                        <input class="input-hueso" type="number" name="vCervic" id="vCervic" value="vCervic">
                    </div>
                </div>

                <!-- ------------TORSO------------- -->

                <h4 class="titulo-tercero  margen-titulo-tercero">Torso</h4>
                <hr class="hr-secundario margen-inf-hr">

                <div class="contenedor-sec-esqueleto">
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="vTorac">Vértebras Torácicas</label>
                        <input class="input-hueso" type="number" name="vTorac" id="vTorac" value="vTorac">
                    </div>
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="claviculaDrch">Clavícula Derecha</label>
                        <input class="input-hueso" type="checkbox" name="claviculaDrch" id="claviculaDrch"
                            value="claviculaDrch">
                    </div>
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="claviculaIzqda">Clavícula Izquierda</label>
                        <input class="input-hueso" type="checkbox" name="claviculaIzqda" id="claviculaIzqda"
                            value="claviculaIzqda">
                    </div>
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="manubrio">Manubrio</label>
                        <input class="input-hueso" type="checkbox" name="manubrio" id="manubrio" value="manubrio">
                    </div>
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="escapulaIzqda">Escápula Izquierda</label>
                        <input class="input-hueso" type="checkbox" name="escapulaIzqda" id="escapulaIzqda"
                            value="escapulaIzqda">
                    </div>
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="escapulaDrcha">Escápula Derecha</label>
                        <input class="input-hueso" type="checkbox" name="escapulaDrcha" id="escapulaDrcha"
                            value="escapulaDrcha">
                    </div>
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="esternon">Esternón</label>
                        <input class="input-hueso" type="checkbox" name="esternon" id="esternon" value="esternon">
                    </div>
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="costillas">Costillas</label>
                        <input class="input-hueso" type="number" name="costillas" id="costillas" value="costillas">
                    </div>
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="vLumbar">Vértebras Lumbares</label>
                        <input class="input-hueso" type="number" name="vLumbar" id="vLumbar" value="vLumbar">
                    </div>
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="pelvis">Pelvis</label>
                        <input class="input-hueso" type="checkbox" name="pelvis" id="pelvis" value="pelvis">
                    </div>
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="sacro">Sacro</label>
                        <input class="input-hueso" type="checkbox" name="sacro" id="sacro" value="sacro">
                    </div>
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="coccix">Cóccix</label>
                        <input class="input-hueso" type="checkbox" name="coccix" id="coccix" value="coccix">
                    </div>
                </div>
                <!-- --------------EXTREMIDADES SUPERIORES------------ -->

                <h4 class="titulo-tercero  margen-titulo-tercero">Extremedidades superiores</h4>
                <hr class="hr-secundario margen-inf-hr">
                <div class="contenedor-sec-esqueleto">
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="humeroDrcha">Húmero Derecha</label>
                        <input class="input-hueso" type="checkbox" name="humeroDrcha" id="humeroDrcha"
                            value="humeroDrcha">
                    </div>
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="humeroIzqda">Húmero Izquierda</label>
                        <input class="input-hueso" type="checkbox" name="humeroIzqda" id="humeroIzqda"
                            value="humeroIzqda">
                    </div>
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="cubitoDrcha">Cúbito Derecha</label>
                        <input class="input-hueso" type="checkbox" name="cubitoDrcha" id="cubitoDrcha"
                            value="cubitoDrcha">
                    </div>
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="cubitoIzqda">Cúbito Izquierda</label>
                        <input class="input-hueso" type="checkbox" name="cubitoIzqda" id="cubitoIzqda"
                            value="cubitoIzqda">
                    </div>
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="radioDrcha">Radio Derecha</label>
                        <input class="input-hueso" type="checkbox" name="radioDrcha" id="radioDrcha" value="radioDrcha">
                    </div>
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="radioIzqda">Radio Izquierda</label>
                        <input class="input-hueso" type="checkbox" name="radioIzqda" id="radioIzqda" value="radioIzqda">
                    </div>

                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="falMD">Falanges Mano Derecha</label>
                        <input class="input-hueso" type="number" name="falMD" id="falMD" value="falMD">
                    </div>
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="falMI">Falanges Mano Izquierda</label>
                        <input class="input-hueso" type="number" name="falMI" id="falMI" value="falMI">
                    </div>

                </div>
                <!-- ----------------EXTREMIDADES INFERIORES-------------- -->

                <h4 class="titulo-tercero  margen-titulo-tercero">Extremidades inferiores</h4>
                <hr class="hr-secundario margen-inf-hr">
                <div class="contenedor-sec-esqueleto">
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="femurDrcha">Fémur Derecha</label>
                        <input class="input-hueso" type="checkbox" name="femurDrcha" id="femurDrcha" value="femurDrcha">
                    </div>
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="femurIzqda">Fémur Izquierda</label>
                        <input class="input-hueso" type="checkbox" name="femurIzqda" id="femurIzqda" value="femurIzqda">
                    </div>
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="rotulaDrcha">Rótula Derecha</label>
                        <input class="input-hueso" type="checkbox" name="rotulaDrcha" id="rotulaDrcha"
                            value="rotulaDrcha">
                    </div>
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="rotulaIzqda">Rótula Izquierda</label>
                        <input class="input-hueso" type="checkbox" name="rotulaIzqda" id="rotulaIzqda"
                            value="rotulaIzqda">
                    </div>
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="tibiaDrcha">Tibia Derecha</label>
                        <input class="input-hueso" type="checkbox" name="tibiaDrcha" id="tibiaDrcha" value="tibiaDrcha">
                    </div>
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="tibiaIzqda">Tibia Izquierda</label>
                        <input class="input-hueso" type="checkbox" name="tibiaIzqda" id="tibiaIzqda" value="tibiaIzqda">
                    </div>
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="peroneDrcha">Peroné Derecha</label>
                        <input class="input-hueso" type="checkbox" name="peroneDrcha" id="peroneDrcha"
                            value="peroneDrcha">
                    </div>
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="peroneIzqda">Peroné Izquierda</label>
                        <input class="input-hueso" type="checkbox" name="peroneIzqda" id="peroneIzqda"
                            value="peroneIzqda">
                    </div>
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="falPD">Falanges Pie Derecho</label>
                        <input class="input-hueso" type="checkbox" name="falPD" id="falPD" value="falPD">
                    </div>
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="falPI">Falanges Pie Izquierdo</label>
                        <input class="input-hueso" type="checkbox" name="falPI" id="falPI" value="falPI">
                    </div>
                </div>
                <h4 class="titulo-tercero  margen-titulo-tercero">Otros</h4>
                <hr class="hr-secundario margen-inf-hr">
                <div class="contenedor-sec-esqueleto">
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="indeter">Indeterminado</label>
                        <input class="input-hueso" type="number" name="indeter" id="indeter" value="indeter">
                    </div>
                    <div class="contenedor-comentarios">
                        <label class="texto-input-hueso" for="comentarios">Comentarios</label>
                        <textarea class="input-hueso" id="comentarios" rows="4"></textarea>
                    </div>
                </div>
            </div>
            <div id="nombreYaci">
            <input type="hidden" name="nombreYacimiento" value=<?php $_GET['nombreY']?> >
            </div>
            <input class="btn btn-morado btn-margenes" name='enviaE' type='submit' id='enviaE' value='Enviar' >
            <input class="btn btn-morado-claro" name='cancelE' type='button' id='cancelE' onclick="window.location='../menu.php'"
                value='Volver a menú'>
        </form>


    </div>

    <footer>
        <div class="footer-contenedor">
            <div><a href="#" class="footer-link">Política de privacidad</a></div>
            <div><a href="#" class="footer-link">Contacto</a></div>
            <div><a href="#" class="footer-link">Política de cookies</a></div>
        </div>
    </footer>
</body>
