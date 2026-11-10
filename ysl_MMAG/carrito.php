<?php // Inicia el código PHP.
// Inicia o recupera la sesión del usuario.
session_start();
// Carga el archivo necesario.
require "config.php";

// Lógica para borrar un producto o vaciar el carrito
// Comprueba una condición.
if (isset($_GET["accion"])) {
    // Comprueba una condición.
    if ($_GET["accion"] === "eliminar" && isset($_GET["key"])) {
        // Guarda o actualiza el dato que se utiliza.
        $key = $_GET["key"];
        // Elimina el dato indicado.
        unset($_SESSION["carrito"][$key]);
    // Comprueba una condición.
    } elseif ($_GET["accion"] === "vaciar") {
        // Elimina el dato indicado.
        unset($_SESSION["carrito"]);
    // Cierra el bloque de instrucciones.
    }
    // Redirige al usuario a otra página.
    header("Location: carrito.php");
    // Detiene la ejecución del archivo.
    exit;
// Cierra el bloque de instrucciones.
}

// Guarda o actualiza el dato que se utiliza.
$carrito = $_SESSION["carrito"] ?? [];
// Guarda o actualiza el dato que se utiliza.
$total = 0;
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
    <title>Carrito de Compras | YSL Collection</title>
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
<main class="contenedor">
    <!-- Agrupa elementos para organizar el diseño. -->
    <div class="titulo-seccion">
        <!-- Muestra un texto en la página. -->
        <p class="mini-titulo">TU SELECCIÓN</p>
        <!-- Muestra un encabezado. -->
        <h2>Carrito de Compras</h2>
    <!-- Cierra el elemento HTML anterior. -->
    </div>

    <!-- Ejecuta el código PHP dentro de la página. -->
    <?php if (empty($carrito)): ?>
        <!-- Muestra un texto en la página. -->
        <p style="text-align: center; margin: 40px 0;">Tu carrito está vacío. <a href="index.php" style="color: #c5a46d;">Explora el catálogo</a></p>
    <!-- Ejecuta el código PHP dentro de la página. -->
    <?php else: ?>
        <!-- Agrupa elementos para organizar el diseño. -->
        <div style="margin-bottom: 20px; text-align: right;">
            <!-- Agrega un enlace a otra sección o página. -->
            <a href="carrito.php?accion=vaciar" class="boton-chico" style="background: #900; color: #fff; text-decoration: none; padding: 6px 12px; border-radius: 4px;">Vaciar todo el carrito</a>
        <!-- Cierra el elemento HTML anterior. -->
        </div>

        <!-- Crea una tabla para mostrar información. -->
        <table border="0" style="width:100%; border-collapse: collapse; margin-bottom: 30px; text-align: left;">
            <!-- Muestra un dato dentro de la tabla. -->
            <thead>
                <!-- Agrega una fila a la tabla. -->
                <tr style="border-bottom: 1px solid #ddd; padding-bottom: 10px;">
                    <!-- Muestra un dato dentro de la tabla. -->
                    <th>Producto</th>
                    <!-- Muestra un dato dentro de la tabla. -->
                    <th>Opción / Talla</th>
                    <!-- Muestra un dato dentro de la tabla. -->
                    <th>Cantidad</th>
                    <!-- Muestra un dato dentro de la tabla. -->
                    <th>Precio</th>
                    <!-- Muestra un dato dentro de la tabla. -->
                    <th>Subtotal</th>
                    <!-- Muestra un dato dentro de la tabla. -->
                    <th>Acciones</th>
                <!-- Cierra el elemento HTML anterior. -->
                </tr>
            <!-- Cierra el elemento HTML anterior. -->
            </thead>
            <!-- Agrega contenido a la página. -->
            <tbody>
                <!-- Ejecuta el código PHP dentro de la página. -->
                <?php foreach ($carrito as $key => $item): 
                    // Guarda o actualiza el dato que se utiliza.
                    $subtotal = $item["precio"] * $item["cantidad"];
                    // Guarda o actualiza el dato que se utiliza.
                    $total += $subtotal;
                // Termina el bloque de PHP.
                ?>
                <!-- Agrega una fila a la tabla. -->
                <tr style="border-bottom: 1px solid #eee;">
                    <!-- Muestra un dato dentro de la tabla. -->
                    <td style="padding: 12px 0; display: flex; align-items: center; gap: 10px;">
                        <!-- Muestra la imagen del elemento. -->
                        <img src="<?= htmlspecialchars($item["imagen"], ENT_QUOTES, "UTF-8") ?>" alt="" style="width: 50px; height: 50px; object-fit: cover;">
                        <!-- Agrega contenido a la página. -->
                        <strong><?= htmlspecialchars($item["nombre"], ENT_QUOTES, "UTF-8") ?></strong>
                    <!-- Cierra el elemento HTML anterior. -->
                    </td>
                    <!-- Muestra un dato dentro de la tabla. -->
                    <td><?= htmlspecialchars($item["talla"], ENT_QUOTES, "UTF-8") ?></td>
                    <!-- Muestra un dato dentro de la tabla. -->
                    <td><?= (int)$item["cantidad"] ?></td>
                    <!-- Muestra un dato dentro de la tabla. -->
                    <td>$<?= number_format((float)$item["precio"], 2) ?> MXN</td>
                    <!-- Muestra un dato dentro de la tabla. -->
                    <td>$<?= number_format((float)$subtotal, 2) ?> MXN</td>
                    <!-- Muestra un dato dentro de la tabla. -->
                    <td>
                        <!-- Agrega un enlace a otra sección o página. -->
                        <a href="carrito.php?accion=eliminar&key=<?= urlencode($key) ?>" style="color: #d9534f; text-decoration: none; font-weight: bold;">Eliminar</a>
                    <!-- Cierra el elemento HTML anterior. -->
                    </td>
                <!-- Cierra el elemento HTML anterior. -->
                </tr>
                <!-- Ejecuta el código PHP dentro de la página. -->
                <?php endforeach; ?>
            <!-- Cierra el elemento HTML anterior. -->
            </tbody>
        <!-- Cierra el elemento HTML anterior. -->
        </table>

        <!-- Agrupa elementos para organizar el diseño. -->
        <div style="text-align: right; margin-top: 20px;">
            <!-- Muestra un encabezado. -->
            <h3>Total: <span style="color: #c5a46d;">$<?= number_format((float)$total, 2) ?> MXN</span></h3>
            <!-- Agrega contenido a la página. -->
            <br>
            <!-- Agrega un enlace a otra sección o página. -->
            <a href="checkout.php" class="boton" style="display: inline-block; text-decoration: none;">Proceder al Pago</a>
        <!-- Cierra el elemento HTML anterior. -->
        </div>
    <!-- Ejecuta el código PHP dentro de la página. -->
    <?php endif; ?>
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
