<?php // Inicia el código PHP.
// Inicia o recupera la sesión del usuario.
session_start();
// Carga el archivo necesario.
require "config.php";

// Guarda o actualiza el dato que se utiliza.
$carrito = $_SESSION["carrito"] ?? [];
// Comprueba una condición.
if (empty($carrito)) {
    // Redirige al usuario a otra página.
    header("Location: carrito.php");
    // Detiene la ejecución del archivo.
    exit;
// Cierra el bloque de instrucciones.
}

// Guarda o actualiza el dato que se utiliza.
$total = 0;
// Recorre los elementos de la lista.
foreach ($carrito as $item) {
    // Guarda o actualiza el dato que se utiliza.
    $total += $item["precio"] * $item["cantidad"];
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
    <title>Finalizar Compra | YSL Collection</title>
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
        <a href="carrito.php">Carrito (<?= count($carrito) ?>)</a>
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
<main class="formulario-contenedor">
    <!-- Crea el formulario para capturar datos. -->
    <form class="formulario" action="procesar_pago.php" method="post">
        <!-- Muestra un texto en la página. -->
        <p class="mini-titulo">COMPLETAR PEDIDO</p>
        <!-- Muestra un encabezado. -->
        <h1>Datos de Envío y Pago</h1>
        
        <!-- Muestra el nombre del campo. -->
        <label for="nombre">Nombre completo</label>
        <!-- Agrega un campo para ingresar información. -->
        <input id="nombre" type="text" name="nombre" required maxlength="100" placeholder="Ej. María López">

        <!-- Muestra el nombre del campo. -->
        <label for="direccion">Lugar / Dirección de envío</label>
        <!-- Agrega contenido a la página. -->
        <textarea id="direccion" name="direccion" required rows="3" placeholder="Calle, número, colonia, ciudad, C.P."></textarea>

        <!-- Muestra el nombre del campo. -->
        <label for="numero_tarjeta">Número de Tarjeta (16 dígitos)</label>
        <!-- Agrega un campo para ingresar información. -->
        <input id="numero_tarjeta" type="text" name="numero_tarjeta" maxlength="16" minlength="16" pattern="\d{16}" required placeholder="1234567812345678">

        <!-- Agrupa elementos para organizar el diseño. -->
        <div style="display: flex; gap: 10px;">
            <!-- Agrupa elementos para organizar el diseño. -->
            <div style="flex: 1;">
            <!-- Muestra el nombre del campo. -->
            <label for="fecha_expiracion">Fecha Exp (MM/AA)</label>
            <!-- Agrega un campo para ingresar información. -->
            <input id="fecha_expiracion" type="text" name="fecha_expiracion" maxlength="5" pattern="(0[1-9]|1[0-2]|[1-9])\/[0-9]{2}" placeholder="04/28" required>
            <!-- Cierra el elemento HTML anterior. -->
            </div>
            <!-- Agrupa elementos para organizar el diseño. -->
            <div style="flex: 1;">
                <!-- Muestra el nombre del campo. -->
                <label for="cvv">CVV</label>
                <!-- Agrega un campo para ingresar información. -->
                <input id="cvv" type="password" name="cvv" maxlength="4" pattern="\d{3,4}" placeholder="123" required>
            <!-- Cierra el elemento HTML anterior. -->
            </div>
        <!-- Cierra el elemento HTML anterior. -->
        </div>

        <!-- Muestra un texto en la página. -->
        <p style="margin-top: 15px; font-weight: bold;">Total a Pagar: <span style="color: #c5a46d;">$<?= number_format((float)$total, 2) ?> MXN</span></p>

        <!-- Agrega el botón para enviar la información. -->
        <button class="boton" type="submit">Confirmar y Pagar</button>
    <!-- Cierra el elemento HTML anterior. -->
    </form>
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
