<?php
session_start();
 global $conn;
 $conn= new PDO("mysql:host=localhost; dbname=miguelon", "root" , "");
 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
try{

    $sql= "SELECT ID, contacto from participant";
 $resultado = $conn->prepare($sql);
 $resultado->execute();
 $cont=0;
 $idPa;
 while($busqueda= $resultado->fetch(PDO::FETCH_ASSOC)){

    if ($_POST['nuevoPart']==$busqueda['contacto']){
        $cont++;
        $idPa=$busqueda['ID'];
    }
}

 if($cont==0){
    $mensaxe='NO'; 
    echo json_encode($mensaxe);
 }else{
$quer= "SELECT ID from yacimient where nombre= :nombreYac";
$resu = $conn->prepare($quer);
$nombre= htmlentities(addslashes($_POST['yacAc']));
$resu->bindValue(":nombreYac", $nombre); 
$resu->execute();
 $idYac;
 while($busqueda= $resu->fetch(PDO::FETCH_ASSOC)){
      $idYac=$busqueda['ID'];
    }
 $sq= "INSERT INTO  yacipart (`ID_Yaci` , `ID_Parti` , `rol` )
         VALUES ( :idYaci, :idParti, :rol)";
    
     
     $result = $conn->prepare($sq);
    $usu='usu';
     $result->bindValue(":idYaci", $idYac); 
     $result->bindValue(":idParti", $idPa); 
     $result->bindValue(":rol", $usu); 
    
     $result->execute();
     $busque= $result->rowCount();
     
     if($busque !=0){
        $mensaxe='OK'; 
        echo json_encode($mensaxe);
     }else{
        $mensaxe='ERROR'; 
        echo json_encode($mensaxe);
     }

   
 }
}catch (PDOException $e) {
    $problema="Hubo un error: ". $e->getMessage();
    $erro['resultado']=$problema;
    echo json_encode($erro);
    }
?>