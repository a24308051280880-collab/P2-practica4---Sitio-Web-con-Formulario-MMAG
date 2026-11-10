<?php // Inicia el código PHP.
// Inicia o recupera la sesión del usuario.
session_start();
// Carga el archivo necesario.
require "config.php";
// Guarda o actualiza el dato que se utiliza.
$error = "";

// Comprueba una condición.
if (isset($_SESSION["usuario_id"])) {
    // Redirige al usuario a otra página.
    header("Location: index.php");
    // Detiene la ejecución del archivo.
    exit;
// Cierra el bloque de instrucciones.
}

// Comprueba una condición.
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Guarda o actualiza el dato que se utiliza.
    $nombre = trim($_POST["nombre"] ?? "");
    // Guarda o actualiza el dato que se utiliza.
    $correo = trim($_POST["correo"] ?? "");
    // Guarda o actualiza el dato que se utiliza.
    $password = $_POST["password"] ?? "";

    // Comprueba una condición.
    if ($nombre === "" || !filter_var($correo, FILTER_VALIDATE_EMAIL) || strlen($password) < 8) {
        // Guarda o actualiza el dato que se utiliza.
        $error = "Completa los datos. La contraseña debe tener al menos 8 caracteres.";
    // Cierra el bloque de instrucciones.
    } else {
        // Intenta ejecutar este proceso.
        try {
            // Guarda o actualiza el dato que se utiliza.
            $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, correo, password) VALUES (?, ?, ?)");
            // Guarda o actualiza el dato que se utiliza.
            $stmt->execute([$nombre, $correo, password_hash($password, PASSWORD_DEFAULT)]);
            // Ejecuta la instrucción correspondiente.
            session_regenerate_id(true);
            // Guarda o actualiza el dato que se utiliza.
            $_SESSION["usuario_id"] = $pdo->lastInsertId();
            // Guarda o actualiza el dato que se utiliza.
            $_SESSION["nombre"] = $nombre;
            // Redirige al usuario a otra página.
            header("Location: index.php");
            // Detiene la ejecución del archivo.
            exit;
        // Cierra el bloque de instrucciones.
        } catch (PDOException $e) {
            // Guarda o actualiza el dato que se utiliza.
            $error = "Ese correo ya está registrado. Intenta iniciar sesión.";
        // Cierra el bloque de instrucciones.
        }
    // Cierra el bloque de instrucciones.
    }
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
    <title>Crear cuenta | YSL Collection</title>
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
        <a href="login.php">Iniciar sesión</a>
        <!-- Agrega un enlace a otra sección o página. -->
        <a href="carrito.php">Carrito (<?= isset($_SESSION['carrito']) ? count($_SESSION['carrito']) : 0 ?>)</a>
    <!-- Cierra el elemento HTML anterior. -->
    </nav>
<!-- Cierra la información de configuración. -->
</header>

<!-- Inicia el contenido principal. -->
<main class="formulario-contenedor">
    <!-- Crea el formulario para capturar datos. -->
    <form class="formulario" method="post">
        <!-- Muestra un texto en la página. -->
        <p class="mini-titulo">BIENVENIDA</p>
        <!-- Muestra un encabezado. -->
        <h1>Crear una cuenta</h1>
        <!-- Muestra un texto en la página. -->
        <p>Regístrate para realizar un pedido.</p>
        <!-- Ejecuta el código PHP dentro de la página. -->
        <?php if ($error): ?><p class="mensaje-error"><?= htmlspecialchars($error, ENT_QUOTES, "UTF-8") ?></p><?php endif; ?>
        <!-- Muestra el nombre del campo. -->
        <label for="nombre">Nombre completo</label>
        <!-- Agrega un campo para ingresar información. -->
        <input id="nombre" type="text" name="nombre" required maxlength="100" autocomplete="name">
        <!-- Muestra el nombre del campo. -->
        <label for="correo">Correo electrónico</label>
        <!-- Agrega un campo para ingresar información. -->
        <input id="correo" type="email" name="correo" required maxlength="150" autocomplete="email">
        <!-- Muestra el nombre del campo. -->
        <label for="password">Contraseña (mínimo 8 caracteres)</label>
        <!-- Agrega un campo para ingresar información. -->
        <input id="password" type="password" name="password" required minlength="8" autocomplete="new-password">
        <!-- Agrega el botón para enviar la información. -->
        <button class="boton" type="submit">Registrarme</button>
        <!-- Muestra un texto en la página. -->
        <p class="nota">¿Ya tienes cuenta? <a href="login.php">Inicia sesión</a></p>
    <!-- Cierra el elemento HTML anterior. -->
    </form>
<!-- Cierra el elemento HTML anterior. -->
</main>
<!-- Cierra el contenido visible. -->
</body>
<!-- Termina la estructura de la página. -->
</html>
