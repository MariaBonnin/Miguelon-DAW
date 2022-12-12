
<?php
session_start();
// print_r(session_status());
//     if (session_status() == PHP_SESSION_ACTIVE) {
        // if(isset($_POST['mail'])){
        //     $_SESSION['mail']=$_POST['mail'];}
//    }else{
//        // $_SESSION["mail"];
//        print_r('entra');
//     conectamos(); 
    
//    }
  
    try{
        
        $usuario= htmlentities(addslashes($_POST['mail']));
       
        $cont= htmlentities(addslashes($_POST['cont']));
        global $conn;
        $contador=0;
        $conn= new PDO("mysql:host=localhost; dbname=miguelon", "root" , "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql= "SELECT ID, contacto, contr from participant where contacto= :usuario";
        $resultado = $conn->prepare($sql);
        $resultado->bindValue(":usuario", $usuario);
        $resultado->execute();
        while($busqueda= $resultado->fetch(PDO::FETCH_ASSOC)){
            if(password_verify($cont, $busqueda['contr'])){
               @session_start();
                $_SESSION['mail']=$busqueda['contacto'];
                $_SESSION['ID']=$busqueda['ID'];
            $contador++;
        }}
        print_r($contador);
        if($contador==0){  
            $mens = urlencode("El mail o la contraseña no son correctos. Por favor, inténtalo de nuevo.");
            header("Location:login.php?Message=".$mens);
           
           
        }else{
            print_r('ok');
            header("Location:menu.php");
        }

    }catch(Exception $e){
        die("Error: ". $e->getMessage());
    }
    
    
   
   
?>