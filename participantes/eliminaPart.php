<?php
session_start();
 global $conn;
 $conn= new PDO("mysql:host=localhost; dbname=miguelon", "root" , "");
 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
try{

    $sql= "DELETE from yacipart where ID_Yaci= :idYAci and ID_Parti=:idParti";
 $resultado = $conn->prepare($sql);
 $idY= htmlentities(addslashes($_POST['idYac']));
 if(isset($_POST['idUsu'])){
 $idU= htmlentities(addslashes($_POST['idUsu']));
 }else{
    $idU=$_SESSION['ID'];
 }
$resultado->bindValue(":idYAci", $idY); 
$resultado->bindValue(":idParti", $idU); 
 $resultado->execute();
 $cont=0;
 $busque= $resultado->rowCount();
     
     if($busque !=0){
        $mensaxe='OK'; 
        echo json_encode($mensaxe);
     }else{
        $mensaxe='ERROR'; 
        echo json_encode($mensaxe);
     }
 
}catch (PDOException $e) {
    $problema="Hubo un error: ". $e->getMessage();
    $erro['resultado']=$problema;
    echo json_encode($erro);
    }
?>