<?php
session_start();
require dirname(__DIR__, 2) . "/vendor/autoload.php";


use Tienda\Articulos;


(new Articulos)->generarArticulos(150);
$stmt = (new Articulos)->readAll();

?>
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BootStrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- FONTAWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Articulos</title>
</head>

<body style="background-color:blue">
    <h3 class="text-center">Articulos</h3>
    <div class="container mt-2">
        <?php
            if(isset($_SESSION['mensaje'])){
                echo <<<TXT
                <div class="alert alert-primary" role="alert">
                {$_SESSION['mensaje']}
                </div>
                TXT;
                unset($_SESSION['mensaje']);
            }
        ?>
        <a href="carticulos.php" class="btn btn-primary mb-2"><i class="fas fa-book-medical"></i> Nuevo Libro</a>
        <table class="table table-info table-striped">
            <thead>
                <tr>
                    <th scope="col">nombre</th>
                    <th scope="col">precio</th>
                    
                    <th scope="col">Categoria ID</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($fila = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $item=$fila->isbn;
                    echo <<<TXT
                    <tr>
                    <th scope="row"><a href="darticulos.php?id={$fila->id}" ></a></th>
                    <td>{$fila->nombre}</td>
                    
                    <td>{$fila->categoria_id}</td>
                    <td>
                    <form name='s' action='barticulos.php' method='POST'>
                    <input type='hidden' name='id' value='{$fila->id}'>
                    <a href="uarticulos.php?id={$fila->id}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                    <button type="submit" class="btn btn-danger" onclick="return confirm('??Desea Borrar el Libro?')"><i class="fas fa-trash-alt"></i></button>
                    </form>
                    </td>
                </tr>
                TXT;
                }
                ?>
            </tbody>
        </table>

    </div>
</body>

</html>