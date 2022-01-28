<?php  

    //validar el id, evitando que el usuario quera modificarlo queriendo colocar otro tipo de dato
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header('Location: /admin');
    }


  //Base de Datos
  require '../../includes/config/database.php';
  $db = conectarDB();

  //Consultar los datos de la propiedad
  $consulta = "SELECT * FROM propiedades WHERE id = ${id}";
  $resultado = mysqli_query($db, $consulta);
  $propiedad = mysqli_fetch_assoc($resultado); //Retorna un array asociativo correspondiente a la fila obtenida o NULL si es que no hay más filas.

  //Consultar para obtener los vendedores
  $consulta = "SELECT * FROM vendedores";
  $resultado = mysqli_query($db, $consulta);

  //Arreglo con mensajes de errores
  $errores = [];

  $titulo = $propiedad['titulo'];
    $precio = $propiedad['precio'];
    $descripcion = $propiedad['descripcion'];
    $habitaciones = $propiedad['habitaciones'];
    $baños = $propiedad['wc'];
    $cocheras = $propiedad['cocheras'];
    $vendedorId = $propiedad['vendedorId'];
    $imagenPropiedad = $propiedad['imagen'];

  if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $titulo = mysqli_real_escape_string($db,  $_POST['titulo']); //funcion que evita que alguien haga una inyeccion de un codigo de sql que que pueda modificar, eliminar o exponer la base de datos
    $precio = mysqli_real_escape_string($db,  $_POST['precio']);
    $descripcion = mysqli_real_escape_string($db,  $_POST['descripcion']);
    $habitaciones = mysqli_real_escape_string($db,  $_POST['habitaciones']);
    $baños = mysqli_real_escape_string($db,  $_POST['wc']);
    $cocheras = mysqli_real_escape_string($db,  $_POST['cocheras']);
    $vendedorId = mysqli_real_escape_string($db,  $_POST['vendedorId']);
    $creado =  date('Y/m/d');

    //Asignar files a una variable
    $imagen = $_FILES['imagen'];

    if(!$titulo){
        $errores [] = "Debes añadir un titulo";
    }

    if(!$precio){
        $errores [] = "El precio es obligatorio";
    }

    if(strlen($descripcion) < 50 ){
        $errores [] = "La descripción es obligatoria y debe tener al menor 50 caracteres";
    }

    if(!$habitaciones){
        $errores [] = "El numero de habitaciones es obligatorio";
    }

    if(!$baños){
        $errores [] = "El numero de baños es obligatorio";
    }

    if(!$cocheras){
        $errores [] = "El numero de cocheras es obligatorio";
    }

    if(!$vendedorId){
        $errores [] = "Elige un vendedor";
    }

    //Validar por tamaño (1mb máximo)
    $medida = 1000 * 1000;

    if(!$imagen['size'] > $medida){
        $errores[] = 'La Imagen es muy Pesada';
    }

    //Revisar que el array de errores este vacio
    if(empty($errores)){

        //CREAR CARPETA
        $carpetaImagenes = '../../imagenes/';

        if(!is_dir($carpetaImagenes)){
            mkdir($carpetaImagenes);
        }

        /**SUBIDA DE  ARCHIVOS */

        $nombreImagen = '';

        if($imagen['name']){
            //Eliminar la imagen previa
            unlink($carpetaImagenes . $propiedad['imagen']);

            // Generar un nombre unico
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            // SUBIR IMAGENES
            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);
        }else{
            $nombreImagen = $propiedad['imagen'];
        }
        
        //Actualizar en la base de datos
        $query = "UPDATE propiedades SET titulo = '${titulo}', precio = '${precio}', imagen = '${nombreImagen}', descripcion = '${descripcion}', habitaciones = ${habitaciones}, 
        wc = ${baños}, cocheras = ${cocheras}, vendedorId = ${vendedorId} WHERE id = ${id}";

        // echo $query;

        $resultado = mysqli_query($db, $query); //para guardar el resultado en la base de datos

        if($resultado){
            //Redireccionar al usuario cuando se crea una propiedad
            header('Location: /admin?resultado=2');
        }
    } 

  }

  require '../../includes/funciones.php';
  incluirTemplate('header');

?>

    <main class="contenedor seccion">
        <h1>Actualizar Propiedad</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
              <?php echo $error; ?>
            </div>
        <?php endforeach ?>

        <form class="formulario" method="POST"  enctype="multipart/form-data">  
            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Titulo:</label>
                <input type="text" 
                       id="titulo" 
                       name="titulo" 
                       placeholder="Titulo Propiedad" 
                       value="<?php echo $titulo; ?>">

                <label for="titulo">Precio:</label>
                <input type="number" 
                       id="precio" 
                       name="precio" 
                       placeholder="Precio Propiedad" 
                       value="<?php echo $precio; ?>">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

                <img src="/imagenes/<?php echo $imagenPropiedad; ?>" class="small-imagen">

                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" ><?php echo $descripcion; ?></textarea>
            </fieldset>

            <fieldset>
                <legend>Información Propiedad</legend>
                
                <label for="habitaciones">Habitaciones:</label>
                <input type="number" 
                       id="habitaciones" 
                       name="habitaciones" 
                       placeholder="Ej:3" min="1" 
                       value="<?php echo $habitaciones; ?>">

                <label for="wc">Baños:</label>
                <input type="number" 
                       id="wc" name="wc" 
                       placeholder="Ej:3" 
                       min="1" 
                       value="<?php echo $baños; ?>">

                <label for="cocheras">Cocheras:</label>
                <input type="number" 
                       id="cocheras" 
                       name="cocheras" 
                       placeholder="Ej:3" 
                       min="1" value="<?php echo $cocheras; ?>">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <select name="vendedorId">
                    <option value="">-- Seleccione --</option>
                    <?php while($vendedor = mysqli_fetch_assoc($resultado)) : ?>
                        <option value="<?php echo $vendedor['id']; ?>"><?php echo $vendedor['nombre'] . " " . $vendedor['apellido']; ?></option>

                    <?php endwhile; ?>
                </select>
            </fieldset>

            <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
        </form>
    </main>

<?php 
     incluirTemplate('footer');
?>
