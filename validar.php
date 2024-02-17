<?php
    
    //Se utiliza POSt porque van dentro de un FORMS
    //Se utiliza GET cuando va por URL

    include ("./inc/config.php");

    $expediente = $_POST["user"];

    $contrasena = $_POST["pswd"];

    if(!empty($expediente || $contrasena)){
            $query = "SELECT * FROM alumnos WHERE expediente = $expediente AND contrasena = "  . "MD5(" . "'" . $contrasena . "'" . ");";

    $connection = mysqli_connect($HOST, $USER, $PSWD, $NAMEBD) or die("No me conecté");


    $resultado = mysqli_query($connection, $query) or die("No me conecté");

    $fila = mysqli_fetch_assoc($resultado);

    //la flechita del php es para acceder a los metodos de las cosas (seria como el "." en JAVA)

    if($resultado ->num_rows == 1 ){
        session_start();

        $_SESSION["validada"] = 1;

        $_SESSION["Nombre"] = $fila["nombre"] . " " . $fila["apellido_1"] . " " . $fila["apellido 2"];
        
        header("Location:menu.php");

    }else{
        header("Location:index.php?error=100");
    
    }


    mysqli_close($connection);
    
    }else{
        header("Location:index.php?error=200");
    }
