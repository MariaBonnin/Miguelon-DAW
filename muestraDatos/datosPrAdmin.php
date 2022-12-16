
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
  if(isset($_GET['nombreY'])){
    $_SESSION['yacAc']=$_GET['nombreY'];
  }
  if(isset($_GET['estado'])){
    if($_GET['estado']=="finalizado"){
    $_SESSION['estado']="finalizado";
  }else{
    $_SESSION['estado']="activo";
  }}
  function filterData(&$str){ 
       $str = preg_replace("/\t/", "\\t", $str); 
      $str = preg_replace("/\r?\n/", "\\n", $str); 
       if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
    }


if(isset($_POST["cambiaExc"])) {
        $nEst;
  if($_SESSION['estado']=='activo'){
    $nEst='finalizado';
 }else{
    $nEst='activo';
 }
 $s='UPDATE yacimient
SET `estado` = :estado 
WHERE `nombre` = :nombre';
$resul = $conn->prepare($s);
$resul->bindValue(":estado", $nEst);
$resul->bindValue(":nombre", $_SESSION['yacAc']);
$resul->execute();
    $busque=$resul->rowCount();
    if($busque !=0){
        $_SESSION['estado']=$nEst;
        header("Location:datosPrAdmin.php");
         }else{
            $mens=urlencode('ERROR'); 
          print_r($mens);
        }}
  
       
        

  if(isset($_POST["exportData"])) {
    try{
        $s="SELECT * FROM enterramiento AS EN
                inner JOIN esqueleto AS ES
                ON EN.ID=ES.ID_Ent";
       $resultado = $conn->prepare($s);
       $resultado->execute();
       $datos=array();
       while($busqueda= $resultado->fetch(PDO::FETCH_ASSOC)){
                $datos[]=$busqueda;
            }
    }catch(Exception $e) {
        echo'Error:',$e->getMessage(),"\n";
        }

    $fileName ="codexworld_export_data-". date('Ymd') . ".csv"; 
 
// Headers for download 
header("Content-Disposition: attachment; filename=\"$fileName\""); 
header("Content-Type: application/vnd.ms-excel"); 
 
$flag = false; 
foreach($datos as $row) { 
    if(!$flag) { 
        // display column names as first row 
        echo implode("\t", array_keys($row)) . "\r\n"; 
        $flag = true; 
    } 
    // filter data 
    array_walk($row, 'filterData'); 
    echo implode("\t", array_values($row)) . "\r\n"; 
} 
 
exit;
    }
    
    
        

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="datosPrAdminGest.js"></script>
    <title>Datos Administrador</title>

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
    <div id="cuerpo">
        <div id="cuerpoDatos" class="titulo-datos">
            <h2 class="titulo-princip margen-izq-titulo">Datos de
                <?php print_r($_SESSION['yacAc'])?>
            </h2>
            <div class="titulo-btn">
                <form action=" <?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                    <button type="submit" id="exportData" name='exportData' value="Exportar a excel"
                    class="btn-margenes btn btn-morado btn-info">Exportar a Excel  <i class="fa-solid fa-file-excel"></i></button>

                </form> 
                <form method='POST'>
                <?php
                if($_SESSION['estado']=="activo"){
                   print_r('<button type="submit" name="cambiaExc" class="btn btn-morado-claro btn-margen-izq btn-margen-der">Finalizar excavación</button>');
                }else{
                    print_r('<button type="submit" name="cambiaExc" class="btn btn-morado-claro btn-margen-izq btn-margen-der">Reabrir excavación</button>');
                }
                ?>    
                </form>        
               
            </div>

        </div>
        <hr class="hr-principal margen-inf-hr">
        <div class="tabla">
            <div class='cabeceras'>
                <h3 class="cabecera ancho-peque">NUM.</h3>
                <h3 class="cabecera ancho-med">ALIAS</h3>
                <h3 class="cabecera ancho-med">FECHA</h3>
                <h3 class="cabecera ancho">EXCAVADOR</h3>
                <h3 class="cabecera ancho-peque">EDITAR</h3>
                <h3 class="cabecera ancho-peque">ELIMINAR</h3>

            </div>
            <hr class="hr-principal margen-hr">

        
            <?php
                $s="SELECT E.ID, E.ID_Yac , E.alias, E.ultModificacion, P.nombre_ap FROM enterramiento AS E
                inner JOIN participant AS P
                ON E.ID_Part=P.ID
                inner JOIN yacimient AS Y
                ON E.ID_Yac=Y.ID
                WHERE Y.nombre= :nombreYaci";
                $resultad = $conn->prepare($s);
                $nombreY= htmlentities(addslashes($_SESSION['yacAc']));
                $resultad->bindValue(":nombreYaci", $nombreY); 
                $resultad->execute();
                while($busqueda= $resultad->fetch(PDO::FETCH_ASSOC)){
                print_r('<div class="fila-datos">'.
                    '<div class="dato ancho-peque">'.
                        '<p class="dato-text">'. $busqueda['ID'] .'</p>'.
                    '</div>'.
                    '<div class="dato ancho-med">'.
                        '<p class="dato-text"> '. $busqueda['alias'] .'</p>'.
                    '</div>'.
                    '<div class="dato ancho-med">'.
                        '<p class="dato-text">'.$busqueda['ultModificacion'].'</p>'.
                    '</div>'.
                    '<div class="dato ancho">'.
                        '<p class="dato-text">'.$busqueda['nombre_ap'].'</p>'.
                    '</div>'.
                    '<div class="dato ancho-peque">'.
                        '<input type="hidden" name="IDYac" value="'.$busqueda['ID_Yac'].'">'.
                        '<button value="'.$busqueda['ID'].'" name="editaReg" onclick="editaReg(this)"
                            class="btn-dato btn-morado"><i class="fa-solid fa-pen"></i></button>'.
                    '</div>'.
                    '<div class="dato ancho-peque">'.
                        '<button value="'.$busqueda['ID'].'" name="eliminaReg" onclick="eliminaReg(this)"
                            class="btn-dato btn-naranja"><i class="fa-solid fa-trash-can"></i></button>'.
                    '</div>'.
                    
                '</div>'.
                '<hr class="hr-secundario margen-sup-hr">');
                
            }
 ?>
            <div>
                <button onclick="window.location='../menu.php'" class="btn btn-naranja btn-margenes">Volver a
                    menú</button>
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



