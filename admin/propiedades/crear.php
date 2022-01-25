<?php  
  //Base de Datos
  require '../../includes/config/database.php';
  $db = conectarDB();

  //Arreglo con mensajes de errores
  $errores = [];

  $titulo = '';
    $precio = '';
    $descripcion = '';
    $habitaciones = '';
    $baños = '';
    $cocheras = '';
    $vendedorId = '';

  if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $titulo = $_POST['titulo'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];
    $habitaciones = $_POST['habitaciones'];
    $baños = $_POST['wc'];
    $cocheras = $_POST['cocheras'];
    $vendedorId = $_POST['vendedorId'];

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

    //Revisar que el array de errores este vacio

    if(empty($errores)){
        //Insertar en la base de datos
        $query = "INSERT INTO propiedades (titulo, precio, descripcion, habitaciones, wc, cocheras, vendedorId) VALUES ('$titulo', 
        '$precio', '$descripcion', '$habitaciones', '$baños', '$cocheras', '$vendedorId')";

        $resultado = mysqli_query($db, $query); //para guardar el resultado en la base de datos

        if($resultado){
            echo "Insertado Correctamente";
        }
    } 

  }

  require '../../includes/funciones.php';
  incluirTemplate('header');

?>

    <main class="contenedor seccion">
        <h1>Crear</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
              <?php echo $error; ?>
            </div>
        <?php endforeach ?>

        <form class="formulario" method="POST" action="/admin/propiedades/crear.php">  
            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo; ?>">

                <label for="titulo">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" value="<?php echo $precio; ?>">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png">

                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" ><?php echo $descripcion; ?></textarea>
            </fieldset>

            <fieldset>
                <legend>Información Propiedad</legend>
                
                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej:3" min="1" value="<?php echo $habitaciones; ?>">

                <label for="wc">Baños:</label>
                <input type="number" id="wc" name="wc" placeholder="Ej:3" min="1" value="<?php echo $baños; ?>">

                <label for="cocheras">Cocheras:</label>
                <input type="number" id="cocheras" name="cocheras" placeholder="Ej:3" min="1" value="<?php echo $cocheras; ?>">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <select name="vendedorId">
                    <option value="">-- Seleccione --</option>
                    <option value="1">Santiago</option>
                    <option value="2">Karen</option>
                    <option value="3">Juan</option>
                </select>
            </fieldset>

            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>
    </main>

<?php 
     incluirTemplate('footer');
?>
