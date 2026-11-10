<?php // Inicia el código PHP.
// datos de conexion local para MySQL en XAMPP.
// direccion del servidor de base de datos.
// Guarda o actualiza el dato que se utiliza.
$host = "localhost";
// nombre de la base de datos de la tienda.
// Guarda o actualiza el dato que se utiliza.
$dbname = "tienda_tacones";
// usuario de MySQL.
// Guarda o actualiza el dato que se utiliza.
$user = "root";
// contrasena de MySQL, vacia en la configuracion local usada.
// Guarda o actualiza el dato que se utiliza.
$password = "";

// intenta crear la conexion con la base de datos.
// Intenta ejecutar este proceso.
try {
    // guarda la conexion PDO en una variable para usarla en otros archivos.
    // Guarda o actualiza el dato que se utiliza.
    $pdo = new PDO(
        // configura el servidor, la base de datos y la codificacion.
        // Ejecuta la instrucción correspondiente.
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        // envia el usuario configurado.
        // Guarda o actualiza el dato que se utiliza.
        $user,
        // envia la contrasena configurada.
        // Guarda o actualiza el dato que se utiliza.
        $password,
        // define como PDO manejara consultas y resultados.
        // Ejecuta la instrucción correspondiente.
        [
            // hace que PDO lance una excepcion si ocurre un error.
            // Ejecuta la instrucción correspondiente.
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            // devuelve los resultados como arreglos asociativos.
            // Ejecuta la instrucción correspondiente.
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        // Ejecuta la instrucción correspondiente.
        ]
    // Ejecuta la instrucción correspondiente.
    );
// Cierra el bloque de instrucciones.
} catch (PDOException $e) {
    // muestra una indicacion si no se pudo conectar.
    // Muestra un mensaje y detiene el programa.
    die("No se pudo conectar con la base de datos. Revisa la configuración de MySQL y que hayas importado tienda.sql.");
// Cierra el bloque de instrucciones.
}
// Termina el bloque de PHP.
?>
