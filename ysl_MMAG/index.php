<?php // Inicia el código PHP.
// Inicia o recupera la sesión del usuario.
session_start();
// Carga el archivo necesario.
require "config.php";
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
    <title>YSL Collection | Inicio</title>
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

<!-- Ejecuta el código PHP dentro de la página. -->
<?php if (isset($_SESSION["usuario_id"], $_SESSION["nombre"])): ?>
    <!-- Agrupa elementos para organizar el diseño. -->
    <div class="bienvenida">
        <!-- Agrega contenido a la página. -->
        <span>¡Bienvenido, <?= htmlspecialchars($_SESSION["nombre"], ENT_QUOTES, "UTF-8") ?>!</span>
        <!-- Agrega un enlace a otra sección o página. -->
        <a href="logout.php" class="cerrar-sesion">Cerrar sesión</a>
    <!-- Cierra el elemento HTML anterior. -->
    </div>
<!-- Ejecuta el código PHP dentro de la página. -->
<?php endif; ?>

<!-- Agrupa una sección del contenido. -->
<section class="portada">
    <!-- Agrupa elementos para organizar el diseño. -->
    <div class="portada-texto">
        <!-- Muestra un texto en la página. -->
        <p class="mini-titulo">ELEGANCIA EN CADA DETALLE</p>
        <!-- Muestra un encabezado. -->
        <h1>Moda, Fragancias<br>y Accesorios.</h1>
        <!-- Muestra un texto en la página. -->
        <p>Bienvenida a la tienda en linea Yves Saint Laurent, una prestigiosa casa de moda de lujo francesa. Descubre nuestra selección exclusiva de calzados, perfumeria y bolsos.</p>
    <!-- Cierra el elemento HTML anterior. -->
    </div>
<!-- Cierra el elemento HTML anterior. -->
</section>

<!-- Inicia el contenido principal. -->
<main class="contenedor">
    <!-- Agrupa elementos para organizar el diseño. -->
    <div class="titulo-seccion">
        <!-- Muestra un texto en la página. -->
        <p class="mini-titulo">NUESTRAS COLECCIONES</p>
        <!-- Muestra un encabezado. -->
        <h2>Explora los Catálogos</h2>
        <!-- Muestra un texto en la página. -->
        <p>Selecciona la categoría que deseas consultar para ver sus 10 productos disponibles.</p>
    <!-- Cierra el elemento HTML anterior. -->
    </div>

    <!-- Ejecuta el código PHP dentro de la página. -->
    <?php if (isset($_GET["pedido"]) && $_GET["pedido"] === "ok"): ?>
        <!-- Muestra un texto en la página. -->
        <p class="mensaje-exito">¡Tu pedido se registró correctamente!</p>
    <!-- Ejecuta el código PHP dentro de la página. -->
    <?php endif; ?>

    <!-- Agrupa elementos para organizar el diseño. -->
    <div class="productos">
        <!-- Agrupa la información de un producto. -->
        <article class="tarjeta">
            <!-- Muestra la imagen del elemento. -->
            <img src="https://i.pinimg.com/736x/a4/7f/54/a47f54ff1302981c006a2ead35fb45b3.jpg" alt="Tacones">
            <!-- Agrupa elementos para organizar el diseño. -->
            <div class="tarjeta-info">
                <!-- Muestra un encabezado. -->
                <h3>Colección Tacones</h3>
                <!-- Muestra un texto en la página. -->
                <p>Diseños elegantes, stilettos y plataformas de alta costura.</p>
                <!-- Agrega un enlace a otra sección o página. -->
                <a class="boton" href="tacones.php">Ver Tacones</a>
            <!-- Cierra el elemento HTML anterior. -->
            </div>
        <!-- Cierra el elemento HTML anterior. -->
        </article>

        <!-- Agrupa la información de un producto. -->
        <article class="tarjeta">
            <!-- Muestra la imagen del elemento. -->
            <img src="https://media.vogue.mx/photos/6a67e9acbd87b11f5e6c6586/2:3/w_2560%2Cc_limit/ysl-perfume-sin-alcohol-3.jpg" alt="Perfumes">
            <!-- Agrupa elementos para organizar el diseño. -->
            <div class="tarjeta-info">
                <!-- Muestra un encabezado. -->
                <h3>Colección Perfumes</h3>
                <!-- Muestra un texto en la página. -->
                <p>Fragancias exclusivas con notas aromáticas sofisticadas.</p>
                <!-- Agrega un enlace a otra sección o página. -->
                <a class="boton" href="perfumes.php">Ver Perfumes</a>
            <!-- Cierra el elemento HTML anterior. -->
            </div>
        <!-- Cierra el elemento HTML anterior. -->
        </article>

        <!-- Agrupa la información de un producto. -->
        <article class="tarjeta">
            <!-- Muestra la imagen del elemento. -->
            <img src="https://i.pinimg.com/1200x/c0/33/43/c03343a330676e827c1495c0de56a14c.jpg" alt="Bolsos">
            <!-- Agrupa elementos para organizar el diseño. -->
            <div class="tarjeta-info">
                <!-- Muestra un encabezado. -->
                <h3>Colección Bolsos</h3>
                <!-- Muestra un texto en la página. -->
                <p>Bolsos de mano, bandoleras y clutches indispensables.</p>
                <!-- Agrega un enlace a otra sección o página. -->
                <a class="boton" href="bolsos.php">Ver Bolsos</a>
            <!-- Cierra el elemento HTML anterior. -->
            </div>
        <!-- Cierra el elemento HTML anterior. -->
        </article>
    <!-- Cierra el elemento HTML anterior. -->
    </div>
<!-- Cierra el elemento HTML anterior. -->
</main>

<!-- Inicia el pie de página. -->
<footer>
    <!-- Muestra un texto en la página. -->
    <p>0795. Tienda YSL Collection</p>
    <!-- Muestra un texto en la página. -->
    <p>MIA MARINA ARZAPALA GUERRERO 5°J</p>
<!-- Cierra el elemento HTML anterior. -->
</footer>
<!-- Cierra el contenido visible. -->
</body>
<!-- Termina la estructura de la página. -->
</html>
