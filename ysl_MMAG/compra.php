<?php // Inicia el código PHP.
// Inicia o recupera la sesión del usuario.
session_start();
// Carga el archivo necesario.
require "config.php";

// Guarda o actualiza el dato que se utiliza.
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
// Guarda o actualiza el dato que se utiliza.
$stmt = $pdo->prepare("SELECT * FROM productos WHERE id = ?");
// Guarda o actualiza el dato que se utiliza.
$stmt->execute([$id]);
// Guarda o actualiza el dato que se utiliza.
$producto = $stmt->fetch();

// Comprueba una condición.
if (!$producto) {
    // Redirige al usuario a otra página.
    header("Location: index.php");
    // Detiene la ejecución del archivo.
    exit;
// Cierra el bloque de instrucciones.
}
// Termina el bloque de PHP.
?>
<!-- Indica que el documento usa HTML5. -->
<!DOCTYPE html>
<!-- Inicia la estructura de la página. -->
<html lang="es">
<!-- Inicia la información de configuración. -->
<head>
    <!-- Configura información del documento. -->
    <meta charset="UTF-8">
    <!-- Configura información del documento. -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Define el título de la pestaña. -->
    <title>Agregar al carrito | YSL Collection</title>
    <!-- Conecta la hoja de estilos. -->
    <link rel="stylesheet" href="css/estilos.css">
<!-- Cierra la información de configuración. -->
</head>
<!-- Inicia el contenido visible de la página. -->
<body>

<!-- Inicia la información de configuración. -->
<header class="encabezado">
    <!-- Agrega un enlace a otra sección o página. -->
    <a class="logo" href="index.php">YSL <span>COLLECTION</span></a>
    <!-- Inicia el menú de navegación. -->
    <nav>
        <!-- Agrega un enlace a otra sección o página. -->
        <a href="index.php">Inicio</a>
        <!-- Agrega un enlace a otra sección o página. -->
        <a href="tacones.php">Tacones</a>
        <!-- Agrega un enlace a otra sección o página. -->
        <a href="perfumes.php">Perfumes</a>
        <!-- Agrega un enlace a otra sección o página. -->
        <a href="bolsos.php">Bolsos</a>
        <!-- Agrega un enlace a otra sección o página. -->
        <a href="carrito.php">Carrito (<?= isset($_SESSION['carrito']) ? count($_SESSION['carrito']) : 0 ?>)</a>
        <!-- Ejecuta el código PHP dentro de la página. -->
        <?php if (isset($_SESSION["usuario_id"])): ?>
            <!-- Agrega un enlace a otra sección o página. -->
            <a href="logout.php">Cerrar sesión</a>
        <!-- Ejecuta el código PHP dentro de la página. -->
        <?php else: ?>
            <!-- Agrega un enlace a otra sección o página. -->
            <a href="login.php">Iniciar sesión</a>
        <!-- Ejecuta el código PHP dentro de la página. -->
        <?php endif; ?>
    <!-- Cierra el elemento HTML anterior. -->
    </nav>
<!-- Cierra la información de configuración. -->
</header>

<!-- Inicia el contenido principal. -->
<main class="formulario-contenedor">
    <!-- Crea el formulario para capturar datos. -->
    <form class="formulario" action="agregar_carrito.php" method="post">
        <!-- Agrega un campo para ingresar información. -->
        <input type="hidden" name="id" value="<?= (int)$producto["id"] ?>">
        
        <!-- Muestra un texto en la página. -->
        <p class="mini-titulo">SELECCIÓN</p>
        <!-- Muestra un encabezado. -->
        <h1>Agregar al carrito</h1>
        
        <!-- Agrupa elementos para organizar el diseño. -->
        <div class="producto-resumen">
            <!-- Muestra la imagen del elemento. -->
            <img src="<?= htmlspecialchars($producto["imagen"], ENT_QUOTES, "UTF-8") ?>" alt="">
            <!-- Agrupa elementos para organizar el diseño. -->
            <div>
                <!-- Agrega contenido a la página. -->
                <strong><?= htmlspecialchars($producto["nombre"], ENT_QUOTES, "UTF-8") ?></strong>
                <!-- Muestra un texto en la página. -->
                <p>$<?= number_format((float)$producto["precio"], 2) ?> MXN</p>
            <!-- Cierra el elemento HTML anterior. -->
            </div>
        <!-- Cierra el elemento HTML anterior. -->
        </div>

        <!-- Ejecuta el código PHP dentro de la página. -->
        <?php if ($producto["categoria"] === "tacones"): ?>
            <!-- Muestra el nombre del campo. -->
            <label for="talla">Talla (Calzado MX)</label>
            <!-- Agrega contenido a la página. -->
            <select id="talla" name="talla" required>
                <!-- Agrega contenido a la página. -->
                <option value="">Selecciona tu talla</option>
                <!-- Ejecuta el código PHP dentro de la página. -->
                <?php foreach (["22", "23", "24", "25", "26", "27"] as $t): ?>
                    <!-- Agrega contenido a la página. -->
                    <option value="<?= $t ?>"><?= $t ?> MX</option>
                <!-- Ejecuta el código PHP dentro de la página. -->
                <?php endforeach; ?>
            <!-- Cierra el elemento HTML anterior. -->
            </select>
        <!-- Ejecuta el código PHP dentro de la página. -->
        <?php elseif ($producto["categoria"] === "perfumes"): ?>
            <!-- Muestra el nombre del campo. -->
            <label for="talla">Presentación (ml)</label>
            <!-- Agrega contenido a la página. -->
            <select id="talla" name="talla" required>
                <!-- Agrega contenido a la página. -->
                <option value="">Selecciona la presentación</option>
                <!-- Agrega contenido a la página. -->
                <option value="50ml">50 ml</option>
                <!-- Agrega contenido a la página. -->
                <option value="90ml">90 ml</option>
                <!-- Agrega contenido a la página. -->
                <option value="100ml">100 ml</option>
            <!-- Cierra el elemento HTML anterior. -->
            </select>
        <!-- Ejecuta el código PHP dentro de la página. -->
        <?php else: ?>
            <!-- Muestra el nombre del campo. -->
            <label for="talla">Tamaño / Modelo</label>
            <!-- Agrega contenido a la página. -->
            <select id="talla" name="talla" required>
                <!-- Agrega contenido a la página. -->
                <option value="Estándar">Estándar / Único</option>
            <!-- Cierra el elemento HTML anterior. -->
            </select>
        <!-- Ejecuta el código PHP dentro de la página. -->
        <?php endif; ?>

        <!-- Muestra el nombre del campo. -->
        <label for="cantidad">Cantidad (máximo 5)</label>
        <!-- Agrega un campo para ingresar información. -->
        <input id="cantidad" type="number" name="cantidad" min="1" max="5" value="1" required>

        <!-- Agrega el botón para enviar la información. -->
        <button class="boton" type="submit">Agregar al carrito</button>
    <!-- Cierra el elemento HTML anterior. -->
    </form>
<!-- Cierra el elemento HTML anterior. -->
</main>
<!-- Cierra el contenido visible. -->
</body>
<!-- Termina la estructura de la página. -->
</html>
