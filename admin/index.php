<?php 

    require '../includes/funciones.php';
    
    $autenticado = estaAutenticado();

    if(!$autenticado){
        header('Location: /');
    }

    //Incluye un template header
    incluirTemplate('header');

    //Importar la conexión
    require '../includes/config/database.php';
    $db = conectarDB();

    //Escribir el Query
    $query = "SELECT * FROM propiedades";

    //Consultar la BD
    $consulta = mysqli_query($db, $query);

     //Muestra un mensaje condicional
     $resultado = $_GET['resultado'] ?? null; // ?? null placeholder que busca el valor de resultado y si no existe entonces le asigna null

     if($_SERVER['REQUEST_METHOD']=== 'POST'){
         $id = $_POST['id'];
         $id = filter_var($id, FILTER_VALIDATE_INT);

         if($id){

            //Elimina el archivo
            $query = "SELECT imagen FROM propiedades WHERE id = ${id}";

            $resultado = mysqli_query($db, $query);
            $propiedad = mysqli_fetch_assoc($resultado);

            unlink('../imagenes/' . $propiedad['imagen']);

            //Elimina la propiedad
             $query = "DELETE  FROM propiedades WHERE id = ${id}";
             $resultado = mysqli_query($db, $query);

             if($resultado){
                 header('Location: /admin?resultado=3');
             }
         }
     }
?>

    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>
        <?php if($resultado == 1): ?>
            <p class="alerta exito">Propiedad Creada Correctamente</p>
            <?php elseif($resultado == 2): ?>
            <p class="alerta exito">Propiedad Actualizada Correctamente</p>
            <?php elseif($resultado == 3): ?>
            <p class="alerta exito">Propiedad Eliminada Correctamente</p>
        <?php endif ?>

        <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>

        <table class="propiedades">
            <thead>
                <tr>
                  <th>ID</th>
                  <th>Titulo</th>
                  <th>Imagen</th>
                  <th>Precio</th>
                  <th>Descripción</th>
                  <th>Acciones</th>  
                </tr>
            </thead>

            <tbody>
                <?php while($propiedad = mysqli_fetch_assoc($consulta)): ?>
                <tr>
                   <td> <?php echo $propiedad['id'] ?> </td>
                   <td><?php echo $propiedad['titulo'] ?></td>
                   <td> <img src="/imagenes/<?php echo $propiedad['imagen'] ?>" class="imagen-tabla"> </td>
                   <td><?php echo $propiedad['precio'] ?></td>
                   <td><?php echo $propiedad['descripcion'] ?></td>
                   <td>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $propiedad['id'] ?>" >
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        
                        <a href="propiedades/actualizar.php?id=<?php echo $propiedad['id'] ?>" class="boton-naranja-block">Actualizar</a>
                   </td> 
                </tr>
                <?php endwhile ?>
            </tbody>
        </table>

    </main>

<?php 

    //Cerrar la Conexión
    mysqli_close($db);           

     incluirTemplate('footer');
?>