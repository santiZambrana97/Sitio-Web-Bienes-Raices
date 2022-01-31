<?php  
    require 'includes/funciones.php';
    incluirTemplate('header');

    require 'includes/config/database.php';
    $db = conectarDB();

    $errores = [];

    //Autenticar el usuario
    if($_SERVER['REQUEST_METHOD'] === 'POST' ){  //Para poderleer los resultados de Post

        $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
        $password = mysqli_real_escape_string($db, $_POST['password'] );

        if(!$email){
            $errores [] = "El email es obligatorio o no es valido";
        }

        if(!$password){
            $errores [] = "El password es Obligatorio";
        }

        if(empty($errores)){
            //Revisar si el usuario existe

            $query = "SELECT * FROM usuarios WHERE email = '$email' ";
            $resultado = mysqli_query($db, $query);

            if($resultado -> num_rows){
                //Revisar si el password es correcto
                $usuario = mysqli_fetch_assoc($resultado);

                //Verificar si el usuario es correcto o no

                $autenticado = password_verify($password, $usuario['password']); //le pasamos el password que escribio el usuario y el password hasheado de la bd

                if($autenticado){
                    //El usuario esta autenticado
                    session_start();

                    //Llenar el arreglo de la sesion
                    $_SESSION['usuario'] = $usuario['email'];
                    $_SESSION['login'] = true;

                    header('Location: /admin');

                }else{
                    $errores [] = 'El password es incorrecto';
                }
            }else{
                $errores[] = "El Usuario no Existe";
            }
        }
        
        
    }                                      
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesión</h1>

        <?php foreach( $errores as $error) : ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach ?>

        <form method="POST" class="formulario">
            <fieldset>   <!-- se utiliza para agrupar campos relacionados -->
                <legend>Email y Password</legend>

                <label for="email">E-mail</label>
                <input type="email" name="email" placeholder="Tu Email" id="email">

                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Tu Password" id="password">

            </fieldset>

            <input type="submit" value="Iniciar Sesión" class="boton-verde">
        </form>
    </main>

    <?php 
     incluirTemplate('footer');
    ?>