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
    $correo = trim($_POST["correo"] ?? "");
    // Guarda o actualiza el dato que se utiliza.
    $password = $_POST["password"] ?? "";

    // Guarda o actualiza el dato que se utiliza.
    $stmt = $pdo->prepare("SELECT id, nombre, password FROM usuarios WHERE correo = ?");
    // Guarda o actualiza el dato que se utiliza.
    $stmt->execute([$correo]);
    // Guarda o actualiza el dato que se utiliza.
    $usuario = $stmt->fetch();

    // Comprueba una condición.
    if ($usuario && password_verify($password, $usuario["password"])) {
        // Ejecuta la instrucción correspondiente.
        session_regenerate_id(true);
        // Guarda o actualiza el dato que se utiliza.
        $_SESSION["usuario_id"] = $usuario["id"];
        // Guarda o actualiza el dato que se utiliza.
        $_SESSION["nombre"] = $usuario["nombre"];
        // Redirige al usuario a otra página.
        header("Location: index.php");
        // Detiene la ejecución del archivo.
        exit;
    // Cierra el bloque de instrucciones.
    } else {
        // Guarda o actualiza el dato que se utiliza.
        $error = "Correo o contraseña incorrectos.";
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
    <title>Iniciar sesión | YSL Collection</title>
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
        <!-- Agrega un enlace a otra sección o página. -->
        <a href="registro.php">Crear cuenta</a>
    <!-- Cierra el elemento HTML anterior. -->
    </nav>
<!-- Cierra la información de configuración. -->
</header>

<!-- Inicia el contenido principal. -->
<main class="formulario-contenedor">
    <!-- Crea el formulario para capturar datos. -->
    <form class="formulario" method="post">
        <!-- Muestra un texto en la página. -->
        <p class="mini-titulo">QUÉ GUSTO VERTE</p>
        <!-- Muestra un encabezado. -->
        <h1>Iniciar sesión</h1>
        <!-- Muestra un texto en la página. -->
        <p>Ingresa a tu cuenta para continuar.</p>
        <!-- Ejecuta el código PHP dentro de la página. -->
        <?php if ($error): ?><p class="mensaje-error"><?= htmlspecialchars($error, ENT_QUOTES, "UTF-8") ?></p><?php endif; ?>
        <!-- Muestra el nombre del campo. -->
        <label for="correo">Correo electrónico</label>
        <!-- Agrega un campo para ingresar información. -->
        <input id="correo" type="email" name="correo" required autocomplete="email">
        <!-- Muestra el nombre del campo. -->
        <label for="password">Contraseña</label>
        <!-- Agrega un campo para ingresar información. -->
        <input id="password" type="password" name="password" required autocomplete="current-password">
        <!-- Agrega el botón para enviar la información. -->
        <button class="boton" type="submit">Entrar</button>
        <!-- Muestra un texto en la página. -->
        <p class="nota">¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a></p>
    <!-- Cierra el elemento HTML anterior. -->
    </form>
<!-- Cierra el elemento HTML anterior. -->
</main>
<!-- Cierra el contenido visible. -->
</body>
<!-- Termina la estructura de la página. -->
</html>
