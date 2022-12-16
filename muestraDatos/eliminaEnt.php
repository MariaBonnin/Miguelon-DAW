<?php
session_start();
if (empty($_SESSION['mail'])) {
    # Lo redireccionamos al formulario de inicio de sesión
    header("Location: ../login.php");
    # Y salimos del script
    exit();
}
 global $conn;
 $conn= new PDO("mysql:host=localhost; dbname=miguelon", "root" , "");
 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
try{
    $sql= "DELETE EN, ES 
    FROM enterramiento AS EN 
    INNER JOIN esqueleto AS ES 
    ON EN.ID = ES.ID_Ent WHERE EN.ID = :idEnt";
 $resultado = $conn->prepare($sql);
 $idE= htmlentities(addslashes($_POST['idEnt']));
$resultado->bindValue(":idEnt", $idE); 
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