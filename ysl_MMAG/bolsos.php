<?php // Inicia el código PHP.
// Inicia o recupera la sesión del usuario.
session_start();
// Carga el archivo necesario.
require "config.php";

// Guarda o actualiza el dato que se utiliza.
$stmt = $pdo->prepare("SELECT * FROM productos WHERE categoria = 'bolsos' ORDER BY id");
// Guarda o actualiza el dato que se utiliza.
$stmt->execute();
// Guarda o actualiza el dato que se utiliza.
$productos = $stmt->fetchAll();
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
    <title>Bolsos | YSL Collection</title>
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
        <a href="cuenta.php">Cuenta</a>
    <!-- Ejecuta el código PHP dentro de la página. -->
    <?php endif; ?>
<!-- Cierra el elemento HTML anterior. -->
</nav>
<!-- Cierra la información de configuración. -->
</header>

<!-- Inicia el contenido principal. -->
<main class="contenedor">
    <!-- Agrupa elementos para organizar el diseño. -->
    <div class="titulo-seccion">
        <!-- Muestra un texto en la página. -->
        <p class="mini-titulo">SECCIÓN BOLSOS</p>
        <!-- Muestra un encabezado. -->
        <h2>Colección de Bolsos</h2>
        <!-- Muestra un texto en la página. -->
        <p>10 diseños de lujo para llevar tus esenciales.</p>
    <!-- Cierra el elemento HTML anterior. -->
    </div>

    <!-- Agrupa una sección del contenido. -->
    <section class="productos">
        <!-- Ejecuta el código PHP dentro de la página. -->
        <?php foreach ($productos as $producto): ?>
        <!-- Agrupa la información de un producto. -->
        <article class="tarjeta">
            <!-- Muestra la imagen del elemento. -->
            <img src="<?= htmlspecialchars($producto["imagen"], ENT_QUOTES, "UTF-8") ?>" alt="<?= htmlspecialchars($producto["nombre"], ENT_QUOTES, "UTF-8") ?>">
            <!-- Agrupa elementos para organizar el diseño. -->
            <div class="tarjeta-info">
                <!-- Muestra un encabezado. -->
                <h3><?= htmlspecialchars($producto["nombre"], ENT_QUOTES, "UTF-8") ?></h3>
                <!-- Muestra un texto en la página. -->
                <p><?= htmlspecialchars($producto["descripcion"], ENT_QUOTES, "UTF-8") ?></p>
                <!-- Agrega contenido a la página. -->
                <strong>$<?= number_format((float)$producto["precio"], 2) ?> MXN</strong>
                <!-- Agrega un enlace a otra sección o página. -->
                <a class="boton boton-chico" href="compra.php?id=<?= (int)$producto["id"] ?>">Comprar</a>
            <!-- Cierra el elemento HTML anterior. -->
            </div>
        <!-- Cierra el elemento HTML anterior. -->
        </article>
        <!-- Ejecuta el código PHP dentro de la página. -->
        <?php endforeach; ?>
    <!-- Cierra el elemento HTML anterior. -->
    </section>
<!-- Cierra el elemento HTML anterior. -->
</main>

<!-- Inicia el pie de página. -->
<footer>
    <!-- Muestra un texto en la página. -->
    <p>0795. Tienda de tacones YSL</p>
    <!-- Muestra un texto en la página. -->
    <p>MIA MARINA ARZAPALA GUERRERO 5°J</p>
<!-- Cierra el elemento HTML anterior. -->
</footer>
<!-- Cierra el contenido visible. -->
</body>
<!-- Termina la estructura de la página. -->
</html>
