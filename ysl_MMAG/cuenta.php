<?php // Inicia el código PHP.
// Inicia o recupera la sesión del usuario.
session_start();
// Carga el archivo necesario.
require "config.php";

// Guarda o actualiza el dato que se utiliza.
$error_login = "";
// Guarda o actualiza el dato que se utiliza.
$error_registro = "";

// Si ya hay sesión iniciada, redirige al inicio
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
    $accion = $_POST["accion"] ?? "";

    // Procesar Inicio de Sesión
    // Comprueba una condición.
    if ($accion === "login") {
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
            $error_login = "Correo o contraseña incorrectos.";
        // Cierra el bloque de instrucciones.
        }
    // Cierra el bloque de instrucciones.
    }

    // Procesar Registro de Cuenta
    // Comprueba una condición.
    if ($accion === "registro") {
        // Guarda o actualiza el dato que se utiliza.
        $nombre = trim($_POST["nombre"] ?? "");
        // Guarda o actualiza el dato que se utiliza.
        $correo = trim($_POST["correo"] ?? "");
        // Guarda o actualiza el dato que se utiliza.
        $password = $_POST["password"] ?? "";

        // Comprueba una condición.
        if ($nombre === "" || !filter_var($correo, FILTER_VALIDATE_EMAIL) || strlen($password) < 8) {
            // Guarda o actualiza el dato que se utiliza.
            $error_registro = "Completa los datos. La contraseña debe tener al menos 8 caracteres.";
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
                $error_registro = "Ese correo ya está registrado. Intenta iniciar sesión.";
            // Cierra el bloque de instrucciones.
            }
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
    <title>Mi Cuenta | YSL Collection</title>
    <!-- Conecta la hoja de estilos. -->
    <link rel="stylesheet" href="css/estilos.css">
    <!-- Agrega contenido a la página. -->
    <style>
        /* Define los estilos de este elemento. */
        .contenedor-cuenta {
            /* Configura una propiedad visual del elemento. */
            display: flex;
            /* Configura una propiedad visual del elemento. */
            gap: 30px;
            /* Configura una propiedad visual del elemento. */
            max-width: 900px;
            /* Configura una propiedad visual del elemento. */
            margin: 40px auto;
            /* Configura una propiedad visual del elemento. */
            flex-wrap: wrap;
        /* Cierra este bloque de estilos. */
        }
        /* Define los estilos de este elemento. */
        .contenedor-cuenta .formulario {
            /* Configura una propiedad visual del elemento. */
            flex: 1;
            /* Configura una propiedad visual del elemento. */
            min-width: 300px;
        /* Cierra este bloque de estilos. */
        }
    /* Continúa la regla de estilos. */
    </style>
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
        <a href="cuenta.php" style="color:#c5a46d;">Cuenta</a>
    <!-- Cierra el elemento HTML anterior. -->
    </nav>
<!-- Cierra la información de configuración. -->
</header>

<!-- Inicia el contenido principal. -->
<main class="contenedor">
    <!-- Agrupa elementos para organizar el diseño. -->
    <div class="titulo-seccion">
        <!-- Muestra un texto en la página. -->
        <p class="mini-titulo">BIENVENIDO</p>
        <!-- Muestra un encabezado. -->
        <h2>Acceso a tu Cuenta</h2>
    <!-- Cierra el elemento HTML anterior. -->
    </div>

    <!-- Agrupa elementos para organizar el diseño. -->
    <div class="contenedor-cuenta">
        <!-- FORMULARIO DE INICIO DE SESIÓN -->
        <!-- Crea el formulario para capturar datos. -->
        <form class="formulario" method="post">
            <!-- Agrega un campo para ingresar información. -->
            <input type="hidden" name="accion" value="login">
            <!-- Muestra un texto en la página. -->
            <p class="mini-titulo">¿YA TIENES CUENTA?</p>
            <!-- Muestra un encabezado. -->
            <h1>Iniciar sesión</h1>
            
            <!-- Ejecuta el código PHP dentro de la página. -->
            <?php if ($error_login): ?>
                <!-- Muestra un texto en la página. -->
                <p class="mensaje-error"><?= htmlspecialchars($error_login, ENT_QUOTES, "UTF-8") ?></p>
            <!-- Ejecuta el código PHP dentro de la página. -->
            <?php endif; ?>

            <!-- Muestra el nombre del campo. -->
            <label for="correo_login">Correo electrónico</label>
            <!-- Agrega un campo para ingresar información. -->
            <input id="correo_login" type="email" name="correo" required autocomplete="email">

            <!-- Muestra el nombre del campo. -->
            <label for="password_login">Contraseña</label>
            <!-- Agrega un campo para ingresar información. -->
            <input id="password_login" type="password" name="password" required autocomplete="current-password">

            <!-- Agrega el botón para enviar la información. -->
            <button class="boton" type="submit">Entrar</button>
        <!-- Cierra el elemento HTML anterior. -->
        </form>

        <!-- FORMULARIO DE REGISTRO -->
        <!-- Crea el formulario para capturar datos. -->
        <form class="formulario" method="post">
            <!-- Agrega un campo para ingresar información. -->
            <input type="hidden" name="accion" value="registro">
            <!-- Muestra un texto en la página. -->
            <p class="mini-titulo">¿ERES NUEVO?</p>
            <!-- Muestra un encabezado. -->
            <h1>Crear una cuenta</h1>

            <!-- Ejecuta el código PHP dentro de la página. -->
            <?php if ($error_registro): ?>
                <!-- Muestra un texto en la página. -->
                <p class="mensaje-error"><?= htmlspecialchars($error_registro, ENT_QUOTES, "UTF-8") ?></p>
            <!-- Ejecuta el código PHP dentro de la página. -->
            <?php endif; ?>

            <!-- Muestra el nombre del campo. -->
            <label for="nombre_reg">Nombre completo</label>
            <!-- Agrega un campo para ingresar información. -->
            <input id="nombre_reg" type="text" name="nombre" required maxlength="100" autocomplete="name">

            <!-- Muestra el nombre del campo. -->
            <label for="correo_reg">Correo electrónico</label>
            <!-- Agrega un campo para ingresar información. -->
            <input id="correo_reg" type="email" name="correo" required maxlength="150" autocomplete="email">

            <!-- Muestra el nombre del campo. -->
            <label for="password_reg">Contraseña (mínimo 8 caracteres)</label>
            <!-- Agrega un campo para ingresar información. -->
            <input id="password_reg" type="password" name="password" required minlength="8" autocomplete="new-password">

            <!-- Agrega el botón para enviar la información. -->
            <button class="boton" type="submit">Registrarme</button>
        <!-- Cierra el elemento HTML anterior. -->
        </form>
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
