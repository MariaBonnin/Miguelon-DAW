<?php
session_start();
if (empty($_SESSION['mail'])) {
    # Lo redireccionamos al formulario de inicio de sesión
    header("Location: ../login.php");
    # Y salimos del script
    exit();
}
global $conn;
    $conn = new PDO("mysql:host=localhost; dbname=miguelon", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//Falta try catch
//consigue id yacimiento
       
//consigue id participante 
    $query= "SELECT ID from participant where contacto= :contacto";
    $res = $conn->prepare($query);
    $nombre= htmlentities(addslashes($_SESSION['mail']));
    $res->bindValue(":contacto", $nombre); 
    $res->execute();
    $idPart;
    $idYac=$_SESSION['idY'];
    while($busqueda= $res->fetch(PDO::FETCH_ASSOC)){
        $idPart=$busqueda['ID'];
        }
        print_r($idPart);
    
//introduce enterramiento
$usuAc=$_SESSION['mail'];

$sql= "UPDATE enterramiento SET `alias`=:alias , `posicion`=:posicion ,`orientacion`=:orientacion ,
`tamanoEnterramientoAncho`=:tEAncho,`tamanoEnterramientoLargo`=:tELargo,
`tamanoIndividuo`=:tInd ,`edadAprox`=:edad,`sexoEstimado`= :sexo,`tipoDescomposicion`= :tipoDesc ,
`causaMuerte`= :causaMuerte,`tipoEnterramiento`= :tipoEnt,`restosIndirectos`=:restosInd ,
 `Comentarios`=:comentarios,`ultModificacion`=NOW(),`excavadores` =:excavadores where `ID`=:id";
    
     $result = $conn->prepare($sql);
     if(isset($_POST['nombreE'])) 
     { 
     $alias=$_POST['nombreE'];   
 }else{
     $alias="-";
 }
     if(isset($_POST['posicion'])) { 
         $posicion=$_POST['posicion'];
     }else{
         $posicion="-";
     }
     if(isset($_POST['orientacion'])){
          $orientacion=$_POST['orientacion'];
         }else{
             $orientacion="-";
         }
      if(isset($_POST['tamanoEntLargo'])) {
             $tamanoEL=$_POST['tamanoEntLargo'];
         }else{
             $tamanoEL=0;
         }
         if(isset($_POST['tamanoEntAncho'])) {
            $tamanoEA=$_POST['tamanoEntAncho'];
        }else{
            $tamanoEA=0;
        }
      if(isset($_POST['tamanoInd'])) {
             $tamanoI=$_POST['tamanoInd'];
         }else{
                 $tamanoI=0;
             }
      if(isset($_POST['edad'])) {
             $edad=$_POST['edad'];
         }else{
             $edad="-";
         }
     if(isset($_POST['sexo'])) {
              $sexo=$_POST['sexo'];
             }else{
                 $sexo='-';
             }
      if(isset($_POST['tipoDesc'])) {
             $tipoDesc=$_POST['tipoDesc'];
         }else{
             $tipoDesc="-";
         }
     if(isset($_POST['causaMuerte'])) {
              $causaMuerte=$_POST['causaMuerte'];
             }else{
             $causaMuerte='-';
             }
      if(isset($_POST['tipoEnt'])) {
             $tipoEnt=$_POST['tipoEnt'];
         }else{
             $tipoEnt="-";
         }
         if(isset($_POST['comentarios'])) 
         {  $comentarios=$_POST['comentarios'];
         }else{
             $comentarios='-';
         }
     if(isset($_POST['restosInd'])) {
         if(isset($_POST['comentariosRestosInd'])){
             $restosInd=$_POST['comentariosRestosInd'];
         }else{
              $restosInd="restosInd";}
 
             }else{
             $restosInd="-";
             }
    $usuAc=$_SESSION['mail'];
     $result->bindValue(":id", $_SESSION['idEnt']);   
     $result->bindValue(":alias", $alias); 
    $result->bindValue(":posicion", $posicion);
     $result->bindValue(":orientacion", $orientacion);
     $result->bindValue(":tEAncho", $tamanoEA);
     $result->bindValue(":tELargo", $tamanoEL);
     $result->bindValue(":tInd", $tamanoI);
     $result->bindValue(":edad", $edad);
     $result->bindValue(":sexo", $sexo);
     $result->bindValue(":tipoDesc", $tipoDesc);
     $result->bindValue(":causaMuerte", $causaMuerte);
     $result->bindValue(":tipoEnt", $tipoEnt);
     $result->bindValue(":restosInd", $restosInd);
     $result->bindValue(":comentarios", $comentarios);
     $result->bindValue(":excavadores", $usuAc);
    
    $result->execute();
     
    

    
    //Esqueleto
    $s= "UPDATE  esqueleto SET `craneo`=:craneo ,`vCervicales`=:vCerv , 
    `mandibula`=:mandibula,`vToracicas`= :vTor,`claviculaDrcha`=:claviculaD,`claviculaIzqda`=:claviculaI,
    `manubrio`=:manubrio,`escapulaIzqda`=:escapulaI,`escapulaDrcha`=:escapulaD ,`esternon`=:esternon,
    `costillas`=:costillas,`humeroDrcha`=:humeroD,`humeroIzqda`=:humeroI, `vLumbares`=:vLumb,
    `cubitoDrcha`=:cubitoD,`cubitoIzqda`=:cubitoI,
    `radioDrcha`=:radioD,`radioIzqda`=:radioI, `pelvis`=:pelvis,`sacro`=:sacro,`coccix`=:coccix,
    `falangesDrchaManos`=:FDM,`falangesIzqdaManos`=:FIM, `atlas`=:atlas,`femurDrcha`=:femurD,
    `femurIzqda`=:femurI,`rotulaDrcha`=:rotulaD,`rotulaIzqda`=:rotulaI, `tibiaDrcha`=:tibiaD ,
    `tibiaIzqda`=:tibiaI,`peroneDrcha`=:peroneD,
    `peroneIzqda`=:peroneI,`falangesDrchaPies`=:FDP, `falangesIzqdaPies`=:FIP,`indeterminado`=:indeterminado 
     WHERE `ID_Ent`= :idEnt";

$resul = $conn->prepare($s);

   if(isset($_POST['craneo'])) 
    {  $craneo=1;
    }else{
        $craneo=0;
    }
   if(isset($_POST['mandibula'])) 
    {  $mandibula=1;
    }else{
        $mandibula=0;
    }
   if(isset($_POST['atlas'])) 
    {  $atlas=1;
    }else{
        $atlas=0;
    }
   if(isset($_POST['vCervic'])) 
    {  $vCerv=$_POST['vCervic'];
    }else{
        $vCerv=0;
    }
   if(isset($_POST['vTorac'])) 
    {  $vTor=$_POST['vTorac'];
    }else{
        $vTor=0;
    }
   if(isset($_POST['claviculaDrcha'])) 
    {  $claviculaDrcha=1;
    }else{
        $claviculaDrcha=0;
    }
   if(isset($_POST['claviculaIzqda'])) 
    {  $claviculaIzqda=1;
    }else{
        $claviculaIzqda=0;
    }
   if(isset($_POST['manubrio'])) 
    {  $manubrio=1;
    }else{
        $manubrio=0;
    }
   if(isset($_POST['escapulaIzqda'])) 
    {  $escapulaIzqda=1;
    }else{
        $escapulaIzqda=0;
    }
   if(isset($_POST['escapulaDrcha'])) 
    {  $escapulaDrcha=1;
    }else{
        $escapulaDrcha=0;
    }
   if(isset($_POST['esternon'])) 
    {  $esternon=1;
    }else{
        $esternon=0;
    }
   if(isset($_POST['costillas'])) 
    {  $costillas=$_POST['costillas'];
    }else{
        $costillas=0;
    }
   if(isset($_POST['vLumbar'])) 
    {  $vLumbar=$_POST['vLumbar'];
    }else{
        $vLumbar=0;
    }
   if(isset($_POST['pelvis'])) 
    {  $pelvis=1;
    }else{
        $pelvis=0;
    }
   if(isset($_POST['sacro'])) 
    {  $sacro=1;
    }else{
        $sacro=0;
    }
   if(isset($_POST['coccix'])) 
    {  $coccix=1;
    }else{
        $coccix=0;
    }
   if(isset($_POST['humeroDrcha'])) 
    {  $humeroDrcha=1;
    }else{
        $humeroDrcha=0;
    }
   if(isset($_POST['humeroIzqda'])) 
    {  $humeroIzqda=1;
    }else{
        $humeroIzqda=0;
    }
   if(isset($_POST['cubitoDrcha'])) 
    {  $cubitoDrcha=1;
    }else{
        $cubitoDrcha=0;
    }
   if(isset($_POST['cubitoIzqda'])) 
    {  $cubitoIzqda=1;
    }else{
        $cubitoIzqda=0;
    }
   if(isset($_POST['radioDrcha'])) 
    {  $radioDrcha=1;
    }else{
        $radioDrcha=0;
    }
   if(isset($_POST['radioIzqda'])) 
    {  $radioIzqda=1;
    }else{
        $radioIzqda=0;
    }
   if(isset($_POST['falMD'])) 
    {  $falMD=$_POST['falMD'];
    }else{
        $falMD=0;
    }
   if(isset($_POST['falMI'])) 
    {  $falMI=$_POST['falMI'];
    }else{
        $falMI=0;
    }
   if(isset($_POST['femurDrcha'])) 
    {  $femurDrcha=1;
    }else{
        $femurDrcha=0;
    }
   if(isset($_POST['femurIzqda'])) 
    {  $femurIzqda=1;
    }else{
        $femurIzqda=0;
    }
   if(isset($_POST['rotulaDrcha'])) 
    {  $rotulaDrcha=1;
    }else{
        $rotulaDrcha=0;
    }
   if(isset($_POST['rotulaIzqda'])) 
    {  $rotulaIzqda=1;
    }else{
        $rotulaIzqda=0;
    }
   if(isset($_POST['tibiaDrcha'])) 
    {  $tibiaDrcha=1;
    }else{
        $tibiaDrcha=0;
    }
   if(isset($_POST['tibiaIzqda'])) 
    {  $tibiaIzqda=1;
    }else{
        $tibiaIzqda=0;
    }
   if(isset($_POST['peroneDrcha'])) 
    {  $peroneDrcha=1;
    }else{
        $peroneDrcha=0;
    }
   if(isset($_POST['peroneIzqda'])) 
    {  $peroneIzqda=1;
    }else{
        $peroneIzqda=0;
    }
   if(isset($_POST['falPD'])) 
    {  $falPD=$_POST['falPD'];
    }else{
        $falPD=0;
    }
   if(isset($_POST['falPI'])) 
    {  $falPI=$_POST['falPI'];
    }else{
        $falPI=0;
    }
   if(isset($_POST['indeter'])) 
    {  $indeterminado=$_POST['indeter'];
    }else{
        $indeterminado=0;
    }

    $resul->bindValue(":idEnt", $_SESSION['idEnt']); 
    $resul->bindValue(":craneo", $craneo); 
    $resul->bindValue(":vCerv", $vCerv); 
    $resul->bindValue(":mandibula", $mandibula);
    $resul->bindValue(":vTor", $vTor);
    $resul->bindValue(":claviculaD", $claviculaDrcha);
    $resul->bindValue(":claviculaI", $claviculaIzqda);
    $resul->bindValue(":manubrio", $manubrio);
    $resul->bindValue(":escapulaI", $escapulaIzqda);
    $resul->bindValue(":escapulaD", $escapulaDrcha);
    $resul->bindValue(":esternon", $esternon);
    $resul->bindValue(":costillas", $costillas);
    $resul->bindValue(":humeroD", $humeroDrcha);
    $resul->bindValue(":humeroI", $humeroIzqda);
    $resul->bindValue(":vLumb", $vLumbar);
    $resul->bindValue(":cubitoD", $cubitoDrcha);
    $resul->bindValue(":cubitoI", $cubitoIzqda);
    $resul->bindValue(":radioD", $radioDrcha);
    $resul->bindValue(":radioI", $radioIzqda);
    $resul->bindValue(":pelvis", $pelvis);
    $resul->bindValue(":sacro", $sacro);
    $resul->bindValue(":coccix", $coccix);
    $resul->bindValue(":FDM", $falMD);
    $resul->bindValue(":FIM", $falMI);
    $resul->bindValue(":atlas", $atlas);
    $resul->bindValue(":femurD", $femurDrcha);
    $resul->bindValue(":femurI", $femurIzqda);
    $resul->bindValue(":rotulaD", $rotulaDrcha);
    $resul->bindValue(":rotulaI", $rotulaIzqda);
    $resul->bindValue(":tibiaD", $tibiaDrcha);
    $resul->bindValue(":tibiaI", $tibiaIzqda);
    $resul->bindValue(":peroneD", $peroneDrcha);
    $resul->bindValue(":peroneI", $peroneIzqda);
    $resul->bindValue(":FDP", $falPD);
    $resul->bindValue(":FIP", $falPI);
    $resul->bindValue(":indeterminado", $indeterminado);
    $resul->execute();
    $busque=$resul->rowCount();
   
    if($busque !=0){
            $mens=urlencode('OK'); 
            print_r($mens);
            header("Location:editaEnt.php?Message=".$mens);
            //die;
         }else{
            $mens=urlencode('ERROR'); 
            print_r($mens);
           header("Location:editaEnt.php?Message=".$mens);
           // die;
         }
        ?>