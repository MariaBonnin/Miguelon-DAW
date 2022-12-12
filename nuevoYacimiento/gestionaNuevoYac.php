<?php
session_start();
 global $conn;
 $conn= new PDO("mysql:host=localhost; dbname=miguelon", "root" , "");
 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 try{
 //IMPORTANTE COMILLAS AGUDAS. 
 $sql= "INSERT INTO  yacimient (`emplazamiento` , `fecha_inicio` , `fecha_fin`, `nombre`, `estado` )
     VALUES ( :emplazamiento, :fecha_inicio ,:fecha_fin, :nombre, :estado)";
 
 $resultado = $conn->prepare($sql);
 
 $emplazam= htmlentities(addslashes($_POST["empY"]));
 $f_ini= htmlentities(addslashes($_POST["fechaI"]));
 $f_fin= htmlentities(addslashes($_POST["fechaF"]));
 $nombre= htmlentities(addslashes($_POST["nombreY"]));
$activo='activo';
 
 $resultado->bindValue(":emplazamiento", $emplazam); 
 $resultado->bindValue(":fecha_inicio", $f_ini); 
 $resultado->bindParam(":fecha_fin", $f_fin); 
 $resultado->bindValue(":nombre", $nombre); 
 $resultado->bindValue(":estado", $activo); 

 $resultado->execute();
 $busqueda= $resultado->rowCount();
 
 if($busqueda !=0){
    $resultado = $conn->prepare("SELECT ID from yacimient where nombre= :nombre");
        $resultado->bindValue(":nombre", $nombre);
        $resultado->execute();
        $IDYac;
        while($busqueda= $resultado->fetch(PDO::FETCH_ASSOC)){
            $IDYac=$busqueda['ID'];
        }
        print_r($IDYac);
    $resu = $conn->prepare("SELECT ID from participant where contacto= :mail");
    $resu->bindValue(":mail", $_SESSION['mail']);
    $resu->execute();
    $IDPar;
    while($busque= $resu->fetch(PDO::FETCH_ASSOC)){
        $IDPar=$busque['ID'];
    }
    print_r($IDPar);
    

        //IMPORTANTE COMILLAS AGUDAS. 
        $sql= "INSERT INTO  yacipart ( `ID_Yaci` , `ID_Parti` , `rol`)
            VALUES ( :idYaci, :idParti, :rol)";
        
        $resul = $conn->prepare($sql);
        
        $rol= 'admin';
        $resul->bindValue(":idParti", $IDPar); 
        $resul->bindValue(":idYaci", $IDYac); 
        $resul->bindParam(":rol", $rol); 
       
        $resul->execute();
        $busq= $resul->rowCount();
        if($busq !=0){
        $mens = urlencode("OK");
        header('Location:../menu.php?MessageNY="'.$mens);
        die;}else{
            $mensErr = urlencode("ERROR");
       header("Location:anadeExc.php?MessageNY=".$mensErr);
        die;    
        }
         }else{
            $mensErr = urlencode("ERROR");
        header("Location:anadeExc.php?MessageNY=".$mensErr);
        die;    
        }
    
    
}catch(Exception $e){
    die("Error: ". $e->getMessage());
}



?>