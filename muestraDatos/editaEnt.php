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
    <title>Edita Enterramiento</title>

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
    <?php

    global $conn;
    $conn = new PDO("mysql:host=localhost; dbname=miguelon", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    ?> 


    <header>
        <div class="logo2-contenedor">
            <img src="../images/logo2.png" alt="logo" class="logo2-img">
        </div>

        <div class="contenedor-usuario">
            <a href="../cierraSesion.php">Cerrar sesión <i class="fa-solid fa-right-from-bracket"></i></a>
        </div>
    </header>

    <div id="enterramiento">
        <h2 class="titulo-princip margen-titulo">Edita Enterramiento</h2>
        <hr class="hr-principal">
        <form action="gestionaEditaEnt.php" id="cuadrInt" method="POST">
            <h3 class="titulo-secundario margen-titulo">Datos generales</h3>
            <hr class="hr-secundario margen-inf-hr">
            <div id="datosGen" class="contenedor-datos-generales">
            <?php
            if(isset($_GET['idEnt'])){
                $_SESSION['idEnt']=$_GET['idEnt'];
            }
            if(isset($_GET['idY'])){
                $_SESSION['idY']=$_GET['idY'];
            }
            $sq="SELECT estado from yacimient where ID=". $_SESSION['idY'];
            $re=$conn->prepare($sq);
            $re->execute();
            
            while($busqueda= $re->fetch(PDO::FETCH_ASSOC)){
                $_SESSION['estado']=$busqueda['estado'];
            }

            $idEnt=htmlentities(addslashes($_SESSION['idEnt']));
            $idY=htmlentities(addslashes($_SESSION['idY']));
            $s= 'SELECT * FROM esqueleto AS ES
             inner JOIN enterramiento AS EN
             ON ES.ID_Ent=EN.ID
             where ES.ID_Ent=:idEnt';
             $resultad = $conn->prepare($s);
             $resultad->bindValue(":idEnt", $idEnt);
             
             $resultad->execute();
             $pos;
             $orient;
             $edad;
             $sexo;
             $tipoDesc;
             $tipoEnt;
             $restosInd;
             $comentarios;
             while($busqueda= $resultad->fetch(PDO::FETCH_ASSOC)){
                $pos=$busqueda['posicion'];
                $orient=$busqueda['orientacion'];
                $edad=$busqueda['edadAprox'];
                $sexo=$busqueda['sexoEstimado'];
                $tipoDesc=$busqueda['tipoDescomposicion'];
                $tipoEnt=$busqueda['tipoEnterramiento'];
                $restosInd=$busqueda['restosIndirectos'];
                $comentarios=$busqueda['Comentarios'];
               
                print_r('
                <input type="hidden" name="estado" id="estado" value="'.$_SESSION['estado'].'">
                <input type="hidden" name="idY" value="'.$idY.'">
                <div class="contenedor-dato-gen">
                    <label class="texto-input-general">Alias</label>
                    <input class="a input-general" type="text" id="nombreE" value="'.$busqueda['alias'].'" name="nombreE">
                </div>'.
                '<div class="contenedor-dato-gen contenedor-select">
                <label class="texto-input-general">Posición</label>
                <select class="a input-general" name="posicion" id="posicion">
                <option  value=""></option>');
                if($pos=="dSupino"){
                    print_r('<option selected value="dSupino">Decúbito supino</option>');}else{
                    print_r('<option  value="dSupino">Decúbito supino</option>');   
                    }
               if($pos=="dProno"){
                    print_r('<option selected value="dProno">Decúbito prono</option>');}else{
                    print_r('<option  value="dProno">Decúbito prono</option>');   
                    }
               if($pos=="dSupino"){
                    print_r('<option selected value="dLatD">Decúbito lateral derecho</option>');}else{
                    print_r('<option  value="dLatD">Decúbito lateral derecho</option>');   
                    }
                if($pos=="dSupino"){
                    print_r('<option selected value="dLatI">Decúbito lateral izquierdo</option>');}else{
                    print_r('<option  value="dLatI">Decúbito lateral izquierdo</option>');   
                    }
            
               print_r('</select>
            </div>'.
            '<div class="contenedor-dato-gen contenedor-select">'.
            '<label class="texto-input-general">Orientación</label>
                    <select class="a input-general" name="orientacion" id="orientacion">
                    <option  value=""></option>');
            if($orient=="norte"){
                print_r('<option selected value="norte">Norte</option>');}else{
                print_r('<option  value="norte">Norte</option>');   
                }
            if($orient=="sur"){
                print_r('<option selected value="sur">Sur</option>');}else{
                print_r('<option  value="sur">Sur</option>');   
                }
            if($orient=="este"){
                print_r('<option selected value="este">Este</option>');}else{
                print_r('<option  value="este">Este</option>');   
                }
            if($orient=="oeste"){
                print_r('<option selected value="oeste">Oeste</option>');}else{
                print_r('<option  value="oeste">Oeste</option>');   
                }
                    
                print_r('</select>
                </div>'.
                '<div class="contenedor-dato-gen">
                <label class="texto-input-general">Tamaño Enterramiento Largo</label>
                <input class="a input-general" type="number" step="any" value="'.$busqueda['tamanoEnterramientoLargo'].'"name="tamanoEntLargo">
            </div>'.
                '<div class="contenedor-dato-gen">
                <label class="texto-input-general">Tamaño Enterramiento Ancho</label>
                <input class="a input-general" type="number" value="'.$busqueda['tamanoEnterramientoAncho'] .'" step="any" name="tamanoEntAncho">
            </div>'.

                '<div class="contenedor-dato-gen">
                <label class="texto-input-general">Tamaño Individuo</label>
                <input class="a input-general" type="number" value="'.$busqueda['tamanoIndividuo'].'" step="any" name="tamanoInd">
            </div>'.
                '<div class="contenedor-dato-gen">
                <label class="texto-input-general">Edad aproximada</label>
                <select class="a input-general" name="edad" id="edad">
                <option  value=""></option>');
                if($edad=="infantil"){
                    print_r('<option selected value="infantil">Infantil</option>');}else{
                    print_r('<option  value="infantil">Infantil</option>');   
                    }
                if($edad=="joven"){
                    print_r('<option selected value="joven">Joven</option>');}else{
                    print_r('<option  value="joven">Joven</option>');   
                    }
                if($edad=="adulto"){
                    print_r('<option selected value="adulto">Adulto</option>');}else{
                    print_r('<option  value="adulto">Adulto</option>');   
                    }
                   
                print_r('</select>
            </div>'.
            '<div class="contenedor-dato-gen contenedor-select">
            <label class="texto-input-general">Sexo estimado</label>
            <select class="a input-general" name="sexo" id="sexo">
            <option  value=""></option>');
            if($sexo=="fem"){
                print_r('<option selected value="fem">Femenino</option>');}else{
                print_r('<option  value="fem">Femenino</option>');   
                }
            if($sexo=="masc"){
                print_r('<option selected value="masc">Masculino</option>');}else{
                print_r('<option  value="masc">Masculino</option>');   
                }
               
            print_r('</select>
        </div>'.
                ' <div class="contenedor-dato-gen contenedor-select">
                <label class="texto-input-general">Tipo de descomposición</label>
                <select class="a input-general" name="tipoDesc" id="tipoDesc">
                    <option value=""></option>');
                if($tipoDesc=="vacio"){
                    print_r('<option selected value="vacio">Vacío</option>');}else{
                    print_r('<option  value="vacio">Vacío</option>');   
                    }
                if($tipoDesc=="colmatado"){
                    print_r('<option selected value="colmatado">Colmatado</option>');}else{
                    print_r('<option  value="colmatado">Colmatado</option>');   
                    }
                   
                print_r('</select>
            </div>'.
            '<div class="contenedor-dato-gen">
            <label class="texto-input-general">Causa de la muerte a priori</label>
            <input class="a input-general" type="textarea"  value="'.$busqueda['causaMuerte'].'" id= "causaMuerte" name= "causaMuerte">
        </div>'.
        '<div class="contenedor-dato-gen contenedor-select">
        <label class="texto-input-general">Tipo de enterramiento</label>
        <select class="a input-general" name="tipoEnt" id="tipoEnt">
            <option value=""></option>');
            if($tipoEnt=="primario"){
                print_r('<option selected value="primario">Primario</option>');}else{
                print_r('<option  value="primario">Primario</option>');   
                }
            if($tipoEnt=="secundario"){
                print_r('<option selected value="secundario">Secundario</option>');}else{
                print_r('<option  value="secundario">Secundario</option>');   
                }
               
            print_r('</select>
    </div>'.
    '<div class="contenedor-dato-gen">
    <label class="texto-input-general">Restos indirectos</label>
    <div class="cont-doble">');
    if($restosInd=="-"){
        print_r('<input class="a input-general" type="checkbox" id="restosInd" value="restosInd" name="restosInd">
        <input class="a input-general" type="textarea" name="comentariosRestosInd"
            id="comentariosRestosInd" disabled>');   
        }else if($restosInd=="restosInd"){
            print_r('<input class="a input-general" type="checkbox" id="restosInd" checked value="restosInd" name="restosInd">
            <input class="a input-general" type="textarea" name="comentariosRestosInd"
                id="comentariosRestosInd">');   
        }else{
            print_r('<input class="a input-general" type="checkbox" id="restosInd" checked value="restosInd" name="restosInd">
            <input class="a input-general" type="textarea" value="'.$restosInd.'"name="comentariosRestosInd"
                id="comentariosRestosInd">');   
        }
    print_r('</div>
    </div>
    </div>' .   
        
           ' <h3 class="titulo-secundario margen-titulo">Esqueleto</h3>
            <hr class="hr-secundario margen-inf-hr">
            <div id="huesos" class="contenedor-dat-huesos">

        
                <!-- -----------CABEZA--------- -->

                <h4 class="titulo-tercero  margen-titulo-tercero">Cabeza</h4>
                <hr class="hr-secundario margen-inf-hr">

                <div class="contenedor-sec-esqueleto">
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="craneo">Cráneo</label>');
                        if($busqueda['craneo']==0){
                            print_r('<input class="a input-hueso" type="checkbox" name="craneo" id="craneo" value="craneo">');}else{
                            print_r('<input class="a input-hueso" type="checkbox" name="craneo" checked id="craneo" value="craneo">');   
                            }
                   print_r('</div>
                <div class="contenedor-hueso">
                    <label class="texto-input-hueso" for="mandibula">Mandíbula</label>');
                    if($busqueda['mandibula']==0){
                        print_r(' <input class="a input-hueso" type="checkbox" name="mandibula" id="mandibula" value="mandibula">');}else{
                        print_r(' <input class="a input-hueso" type="checkbox" name="mandibula" checked id="mandibula" value="mandibula">');   
                        }
                        
                    print_r('</div>
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="atlas">Atlas</label>');
                        if($busqueda['atlas']==0){
                            print_r('<input class="a input-hueso" type="checkbox" name="atlas" id="atlas" value="atlas">');}else{
                            print_r('<input class="a input-hueso" type="checkbox" name="atlas" checked id="atlas" value="atlas">');   
                            }   
                        
                    print_r('</div>
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="vCervic">Vértebras Cervicales</label>
                        <input class="a input-hueso" type="number" name="vCervic" id="vCervic" value="'.$busqueda['vCervicales'].'">
                    </div>
                </div>


                <!-- ------------TORSO------------- -->

                <h4 class="titulo-tercero  margen-titulo-tercero">Torso</h4>
                <hr class="hr-secundario margen-inf-hr">

                <div class="contenedor-sec-esqueleto">
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="vTorac">Vértebras Torácicas</label>
                        <input class="a input-hueso" type="number" name="vTorac" id="vTorac" value="'.$busqueda['vToracicas'].'">
                    </div>
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="claviculaDrch">Clavícula Derecha</label>');
                        if($busqueda['claviculaDrcha']==0){
                            print_r('<input class="a input-hueso" type="checkbox" name="claviculaDrcha" id="claviculaDrcha" value="claviculaDrch">');}else{
                            print_r('<input class="a input-hueso" type="checkbox" name="claviculaDrcha" checked id="claviculaDrcha" value="claviculaDrch">');   
                            }   
                       
                    print_r('</div>
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="claviculaIzqda">Clavícula Izquierda</label>');
                        if($busqueda['claviculaIzqda']==0){
                            print_r('<input class="a input-hueso" type="checkbox" name="claviculaIzqda" id="claviculaIzqda" value="claviculaIzqda">');}else{
                            print_r('<input class="a input-hueso" type="checkbox" name="claviculaIzqda" checked id="claviculaIzqda" value="claviculaIzqda">');   
                            }   
                    print_r('</div>
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="manubrio">Manubrio</label>');
                        if($busqueda['manubrio']==0){
                            print_r('<input class="a input-hueso" type="checkbox" name="manubrio" id="manubrio" value="manubrio">');}else{
                            print_r('<input class="a input-hueso" type="checkbox" name="manubrio" checked id="manubrio" value="manubrio">');   
                            }  
                        
                    print_r('</div>
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="escapulaIzqda">Escápula Izquierda</label>');
                        if($busqueda['escapulaIzqda']==0){
                            print_r('<input class="a input-hueso" type="checkbox" name="escapulaIzqda" id="escapulaIzqda" value="escapulaIzqda">');}else{
                            print_r('<input class="a input-hueso" type="checkbox" name="escapulaIzqda" checked id="escapulaIzqda" value="escapulaIzqda">');   
                            }  
                        
                    print_r('</div>
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="escapulaDrcha">Escápula Derecha</label>');
                        if($busqueda['escapulaIzqda']==0){
                            print_r('<input class="a input-hueso" type="checkbox" name="escapulaDrcha" id="escapulaDrcha" value="escapulaDrcha">
                            </div>');}else{
                            print_r('<input class="a input-hueso" type="checkbox" name="escapulaDrcha" id="escapulaDrcha" value="escapulaDrcha">
                            </div>');   
                            }  
                            
                    print_r('<div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="esternon">Esternón</label>');
                        if($busqueda['esternon']==0){
                            print_r('<input class="a input-hueso" type="checkbox" name="esternon" id="esternon" value="esternon">'
                            );}else{
                            print_r('<input class="a input-hueso" type="checkbox" name="esternon" checked id="esternon" value="esternon">'
                            );   
                            }  
                        
                    print_r('</div>
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="costillas">Costillas</label>
                        <input class="a input-hueso" type="number" name="costillas" id="costillas" value="'.$busqueda['costillas'].'">
                    </div>
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="vLumbar">Vértebras Lumbares</label>
                        <input class="a input-hueso" type="number" name="vLumbar" id="vLumbar" value="'.$busqueda['vLumbares'].'">
                    </div>
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="pelvis">Pelvis</label>');
                        if($busqueda['pelvis']==0){
                            print_r('<input class="a input-hueso" type="checkbox" name="pelvis" id="pelvis" value="pelvis">'
                            );}else{
                            print_r('<input class="a input-hueso" type="checkbox" name="pelvis" checked id="pelvis" value="pelvis">>'
                            );   
                            }  
                        
                    print_r('</div>
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="sacro">Sacro</label>');
                        if($busqueda['pelvis']==0){
                            print_r('<input class="a input-hueso" type="checkbox" name="sacro" id="sacro" value="sacro">'
                            );}else{
                            print_r('<input class="a input-hueso" type="checkbox" name="sacro" checked id="sacro" value="sacro">'
                            );   
                            }  
                        
                    print_r('</div>
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="coccix">Cóccix</label>');
                        if($busqueda['coccix']==0){
                            print_r('<input class="a input-hueso" type="checkbox" name="coccix" id="coccix" value="coccix">'
                            );}else{
                            print_r('<input class="a input-hueso" type="checkbox" name="coccix" checked id="coccix" value="coccix">>'
                            );   
                            } 
                        
                    print_r('</div>
                </div>
                <!-- --------------EXTREMIDADES SUPERIORES------------ -->

                <h4 class="titulo-tercero  margen-titulo-tercero">Extremedidades superiores</h4>
                <hr class="hr-secundario margen-inf-hr">
                <div class="contenedor-sec-esqueleto">
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="humeroDrcha">Húmero Derecha</label>');
                        if($busqueda['humeroDrcha']==0){
                            print_r('<input class="a input-hueso" type="checkbox" name="humeroDrcha" id="humeroDrcha"
                            value="humeroDrcha">'
                            );}else{
                            print_r('<input class="a input-hueso" type="checkbox" name="humeroDrcha" id="humeroDrcha"
                            value="humeroDrcha">'
                            );   
                            } 
                   print_r('</div>
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="humeroIzqda">Húmero Izquierda</label>');
                        if($busqueda['humeroIzqda']==0){
                            print_r('<input class="a input-hueso" type="checkbox" name="humeroIzqda" id="humeroIzqda"
                            value="humeroIzqda">'
                            );}else{
                            print_r('<input class="a input-hueso" type="checkbox" name="humeroIzqda" checked id="humeroIzqda"
                            value="humeroIzqda">'
                            );   
                            } 
                    print_r('</div>
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="cubitoDrcha">Cúbito Derecha</label>');
                        if($busqueda['cubitoDrcha']==0){
                            print_r('<input class="a input-hueso" type="checkbox" name="cubitoDrcha" id="cubitoDrcha"
                            value="cubitoDrcha">'
                            );}else{
                            print_r('<input class="a input-hueso" type="checkbox" name="cubitoDrcha" checked id="cubitoDrcha"
                            value="cubitoDrcha">>'
                            );   
                            } 
                        
                    print_r('</div>
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="cubitoIzqda">Cúbito Izquierda</label>');
                        if($busqueda['cubitoIzqda']==0){
                            print_r('<input class="a input-hueso" type="checkbox" name="cubitoIzqda" id="cubitoIzqda"
                            value="cubitoIzqda">'
                            );}else{
                            print_r('<input class="a input-hueso" type="checkbox" name="cubitoIzqda" checked id="cubitoIzqda"
                            value="cubitoIzqda">'
                            );   
                            } 
                        
                   print_r('</div>
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="radioDrcha">Radio Derecha</label>');
                        if($busqueda['radioDrcha']==0){
                            print_r('<input class="a input-hueso" type="checkbox" name="radioDrcha" id="radioDrcha" value="radioDrcha">'
                            );}else{
                            print_r('<input class="a input-hueso" type="checkbox" name="radioDrcha" checked id="radioDrcha" value="radioDrcha">'
                            );   
                            }  
                    print_r('</div>
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="radioIzqda">Radio Izquierda</label>');
                        if($busqueda['radioIzqda']==0){
                            print_r('<input class="a input-hueso" type="checkbox" name="radioIzqda" id="radioIzqda" value="radioIzqda">'
                            );}else{
                            print_r('<input class="a input-hueso" type="checkbox" name="radioIzqda" checked id="radioIzqda" value="radioIzqda">'
                            );   
                            }  
                        
                    print_r('</div>

                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="falMD">Falanges Mano Derecha</label>
                        <input class="a input-hueso" type="number" name="falMD" id="falMD" value="'.$busqueda['falangesDrchaManos'].'">
                    </div>
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="falMI">Falanges Mano Izquierda</label>
                        <input class="a input-hueso" type="number" name="falMI" id="falMI" value="'.$busqueda['falangesIzqdaManos'].'">
                    </div>

                </div>
                <!-- ----------------EXTREMIDADES INFERIORES-------------- -->

                <h4 class="titulo-tercero  margen-titulo-tercero">Extremidades inferiores</h4>
                <hr class="hr-secundario margen-inf-hr">
                <div class="contenedor-sec-esqueleto">
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="femurDrcha">Fémur Derecha</label>');
                        if($busqueda['femurDrcha']==0){
                            print_r('<input class="a input-hueso" type="checkbox" name="femurDrcha" id="femurDrcha" value="femurDrcha">'
                            );}else{
                            print_r('<input class="a input-hueso" type="checkbox" name="femurDrcha" checked id="femurDrcha" value="femurDrcha">'
                            );   
                            }  
                        print_r('</div>
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="femurIzqda">Fémur Izquierda</label>');
                        if($busqueda['femurIzqda']==0){
                            print_r('<input class="a input-hueso" type="checkbox" name="femurIzqda" id="femurIzqda" value="femurIzqda">'
                            );}else{
                            print_r('<input class="a input-hueso" type="checkbox" name="femurIzqda" checked id="femurIzqda" value="femurIzqda">'
                            );   
                            }  
                        
                    print_r('</div>
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="rotulaDrcha">Rótula Derecha</label>');
                        if($busqueda['rotulaDrcha']==0){
                            print_r('<input class="a input-hueso" type="checkbox" name="rotulaDrcha" id="rotulaDrcha" value="rotulaDrcha">'
                            );}else{
                            print_r('<input class="a input-hueso" type="checkbox" checked name="rotulaDrcha" id="rotulaDrcha" value="rotulaDrcha">'
                            );   
                            }  

                    print_r('</div>
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="rotulaIzqda">Rótula Izquierda</label>');
                        if($busqueda['rotulaIzqda']==0){
                            print_r('<input class="a input-hueso" type="checkbox" name="rotulaIzqda" id="rotulaIzqda"
                            value="rotulaIzqda">'
                            );}else{
                            print_r('<input class="a input-hueso" type="checkbox" name="rotulaIzqda" checked id="rotulaIzqda"
                            value="rotulaIzqda">'
                            );   
                            }  

                    print_r('</div>
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="tibiaDrcha">Tibia Derecha</label>');
                        if($busqueda['tibiaDrcha']==0){
                            print_r('<input class="a input-hueso" type="checkbox" name="tibiaDrcha" id="tibiaDrcha" value="tibiaDrcha">'
                            );}else{
                            print_r('<input class="a input-hueso" type="checkbox" name="tibiaDrcha" checked id="tibiaDrcha" value="tibiaDrcha">'
                            );   
                            }  

                    print_r('</div>
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="tibiaIzqda">Tibia Izquierda</label>');
                        if($busqueda['tibiaIzqda']==0){
                            print_r('<input class="a input-hueso" type="checkbox" name="tibiaIzqda" id="tibiaIzqda" value="tibiaIzqda">'
                            );}else{
                            print_r('<input class="a input-hueso" type="checkbox" name="tibiaIzqda" checked id="tibiaIzqda" value="tibiaIzqda">'
                            );   
                            }  

                    print_r('</div>
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="peroneDrcha">Peroné Derecha</label>');
                        if($busqueda['peroneDrcha']==0){
                            print_r('<input class="a input-hueso" type="checkbox" name="peroneDrcha" id="peroneDrcha"
                            value="peroneDrcha">'
                            );}else{
                            print_r('<input class="a input-hueso" type="checkbox" name="peroneDrcha" checked id="peroneDrcha"
                            value="peroneDrcha">'
                            );   
                            }  

                    print_r('</div>
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="peroneIzqda">Peroné Izquierda</label>');
                        if($busqueda['peroneIzqda']==0){
                            print_r('<input class="a input-hueso" type="checkbox" name="peroneIzqda" id="peroneIzqda"
                            value="peroneIzqda">'
                            );}else{
                            print_r('<input class="a input-hueso" type="checkbox" name="peroneIzqda" id="peroneIzqda"
                            value="peroneIzqda">'
                            );   
                            }  

                    print_r('</div>
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="falPD">Falanges Pie Derecho</label>
                        <input class="a input-hueso" type="checkbox" name="falPD" id="falPD" value="'.$busqueda['falangesDrchaPies'].'">
                    </div>
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="falPI">Falanges Pie Izquierdo</label>
                        <input class="a input-hueso" type="checkbox" name="falPI" id="falPI" value="'.$busqueda['falangesIzqdaPies'].'">
                    </div>
                </div>
                <h4 class="titulo-tercero  margen-titulo-tercero">Otros</h4>
                <hr class="hr-secundario margen-inf-hr">
                <div class="contenedor-sec-esqueleto">
                    <div class="contenedor-hueso">
                        <label class="texto-input-hueso" for="indeter">Indeterminado</label>
                        <input class="a input-hueso" type="number" name="indeter" id="indeter" value="'.$busqueda['indeterminado'].'">
                    </div>
                    <div class="contenedor-comentarios">
                        <label class="texto-input-hueso" for="comentarios">Comentarios</label>
                        <textarea class="input-hueso" id="comentarios" value="'.$busqueda['indeterminado'].'" name="comentarios" rows="4"></textarea>
                    </div>
                </div>
            ');}
           ?>  
            </div>
            <div id="nombreYaci">
            <input type="hidden" id="nombreYacimiento" name="nombreYacimiento">
            </div>
            
            <input class="btn btn-morado btn-margenes" name="actualizaD" type="submit" id="actualizaD" value="Actualizar datos" >
            <input class="btn btn-naranja" name="cancelE" type="button" id="cancelE" onclick="window.history.go(-1); return false;"
                value='Atrás'>
        </form>
        


    </div>
    <script>
        const queryString = window.location.search;
        let urlParams = new URLSearchParams(queryString);
       let a = urlParams.get('nombreY')
        document.getElementById('nombreYacimiento').setAttribute('value',a)
         let estado= $($("#estado")).val()
         console.log(estado)
         if(estado=="finalizado"){
         const inputs = document.querySelectorAll('input.a');
        inputs.forEach(input => input.disabled = true);
        const selects = document.querySelectorAll('select.a');
        selects.forEach(select => select.disabled = true);
        $("#actualizaD").attr("type","hidden")
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
