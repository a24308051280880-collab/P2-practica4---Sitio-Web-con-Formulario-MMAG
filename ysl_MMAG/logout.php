<?php // Inicia el código PHP.
// Inicia o recupera la sesión del usuario.
session_start();

// Vacía todas las variables de sesión
// Guarda o actualiza el dato que se utiliza.
$_SESSION = [];

// Destruye la sesión
// Ejecuta la instrucción correspondiente.
session_destroy();

// Redirige al inicio
// Redirige al usuario a otra página.
header("Location: index.php");
// Detiene la ejecución del archivo.
exit;
