
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style> @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap'); </style>

    <link rel="stylesheet" href="./styles/comunesStyles.css">
    <link rel="stylesheet" href="./styles/registroLoginStyles.css">
</head>
</head>
<body>
<?php
     
    
     //era 'usuario'
     if(isset($_SESSION['mail'])){
        header("Location: menu.php"); 
         
     }
     if(isset($_GET['Message'])){
        echo $_GET['Message'];
    }
      if(isset($_POST['mail'])){
          global $conn;
         $conn= new PDO("mysql:host=localhost; dbname=miguelon", "root" , "");
         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         
         
         //IMPORTANTE COMILLAS AGUDAS. 
         //TODO:cambiar a update
         $sql= "INSERT INTO  participant (`nombre_ap` , `contacto` , `contr` , `entidad`, `codigo` )
             VALUES ( :nombreCo,  :mail, 
             :contCif ,:entidad, :codigo)";
         
         $resultado = $conn->prepare($sql);
         
         $nombreCo= htmlentities(addslashes($_POST["nomAp"]));
         $cont= htmlentities(addslashes($_POST["cont"]));
         $contCif= password_hash($cont, PASSWORD_DEFAULT);
         $email= htmlentities(addslashes($_POST["mail"]));
         $entidad= htmlentities(addslashes($_POST["org"]));
         $codigo= htmlentities(addslashes($_POST["cod"]));
        
         
         $resultado->bindParam(":nombreCo", $usuario);
         
         $resultado->bindValue(":nombreCo", $nombreCo); 
         $resultado->bindValue(":mail", $email); 
         $resultado->bindParam(":contCif", $contCif); 
         $resultado->bindValue(":entidad", $entidad); 
         $resultado->bindValue(":codigo", $codigo); 
        
         $resultado->execute();
         $busqueda= $resultado->rowCount();
         if($busqueda !=0){
             echo'Registro completado.Ahora inicia sesión';
              
         }else{
            
            header("Location: registro.php"); 
      }}
    
     ?>
     
     <div id="generalLogin" class="reg-login-contenedor-princip">
        <div id="logo-contenedor" class="logo-contenedor">
            <img src="./images/logo.png" alt="logo" id="logoImg" class="logo-img">
        </div>

        <form action="gestionaLogin.php" id="cuadrInt" method="POST"><br>
            <div class="reg-login-contenedor">
                <div class="input-contenedor">
                    <label class="reg-label">E-mail</label>
                    <input name="mail" type="text" class="login-input">
                </div>
                <div class="input-contenedor">
                    <label class="reg-label">Contraseña</label>
                    <input name="cont" type="password" class="login-input">
                </div>
                <div class="input-contenedor">
                    <p class="login-texto">¿Tienes un código? <a href="registro.html" class="login-link">Regístrate aquí</a></p>
                    <input type="submit" name="entrar" value="entrar" class="btn-principal-form">
                </div>
            </div>
        </form>


    </div>
   
</body>
</html>